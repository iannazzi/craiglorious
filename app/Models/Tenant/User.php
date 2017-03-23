<?php

namespace App\Models\Tenant;

use App\Models\BaseTenantModel;
use App\Models\Craiglorious\System;
use App\Models\Tenant\Role;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseTenantModel implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    //
    use Authenticatable, Authorizable, CanResetPassword;

    // = 'tenant'; //System::getConnectionName();
    /**
     * The database table used by the model.
     *
     * @var string
     */   //public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password', 'passcode', 'role_id', 'active', 'employee_id'];
    protected $hidden = ['password','passcode'];

    public function system()
    {
        //in myCheck I am assigning system to user so we can easily
        //retrieve it...
        //return $this->system;
        $system_id = session('system');

        return System::find($system_id);
    }

    public function setPasscodeAttribute($value)
    {
        if (empty($value))
        { // will check for empty string, null values, see php.net about it
            $this->attributes['passcode'] = null;
        } else
        {
            $this->attributes['passcode'] = $value;
        }
    }

    public function isAdmin()
    {
        return $this->role->isAdmin();
    }

    public function getOtherUsers()
    {
        $available_role_ids = $this->role->getRoleChildrenIds();

        return $this->whereIn('role_id', $available_role_ids);
    }

    public function selectableRoles($admin)
    {
        if ($admin)
        {
            return \App\Models\Tenant\Role::select('id AS value', 'name AS name')->get()->toArray();

        } else
        {
            return \App\Models\Tenant\Role::select('id AS value', 'name AS name')->where('id', '!=', '1')->get()->toArray();
        }
    }

    public function views()
    {
        return $this->role->userViews();
    }

    public function role()
    {
//        return Role::where('id','=',$this->role_id)->get();
        return $this->belongsTo('App\Models\Tenant\Role');
    }

    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
        // not supported
    }

    public function getRememberTokenName()
    {
        return null; // not supported
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if ( ! $isRememberTokenAttribute)
        {
            parent::setAttribute($key, $value);
        }
    }

    public function generatePasscode($length = 5)
    {
        $success = false;

        while ($success == false)
        {
            $success = true;
            $unique_number_attempt = $this->generateRandomString($length, '0123456789');
            //$unique_number_attempt = '1234567';
            $this->passcode = $unique_number_attempt;
            try
            {
                $this->save();
            } catch (\Exception $e)
            {
                //trigger_error('baaadddddd');
                $success = false;
            }


        }

        return $unique_number_attempt;
    }

    public function generateRandomString($length, $charset = '0123456789')
    {
        $key = '';
        for ($i = 0; $i < $length; $i ++)
        {
            $key .= $charset[ (mt_rand(0, (strlen($charset) - 1))) ];
        }

        return $key;
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->attributes['id'];
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    function UserIPAddressChange()
    {
        $md5 = md5($_SERVER['HTTP_USER_AGENT']);
        //$pos_user_id = $_SESSION['pos_user_id'];
        $ip_address = $_SERVER['REMOTE_ADDR'];
        if ($this->relogin_on_ip_address_change == 1)
        {
            $sql = "SELECT pos_user_id, ip_address FROM pos_users_logged_in WHERE ip_address = '$ip_address' AND http_user_agent = '$md5' AND pos_user_id = " . $this->id;
        } else
        {
            $sql = "SELECT user_id,ip_address FROM users_logged_in WHERE  http_user_agent = '$md5' AND user_id = $this->id";
        }
        $logged_in_data = \DB::select($sql);
        dd($logged_in_data);
        if (sizeof($logged_in_data) == 1)
        {
            //ip_address = '$ip_address' AND http_user_agent = '$md5' AND
            // the user_id, computer/browser and ip address is a match - good to go
            $address_change = false;
            if ($logged_in_data['ip_address'] != $ip_address)
            {
                $sql = "UPDATE pos_users_logged_in SET ip_address = '$ip_address' WHERE user_id = $this->id";
                \DB::update($sql);
            }

        } else
        {
            $address_change = true;
        }

        return $address_change;
    }

    public function canAccessFromIPAddress()
    {
        $ip_address_ok = true;
        $ip_address = $_SERVER['REMOTE_ADDR'];
        if ($this->ip_address_restrictions != '')
        {
            $ip_address_restrictions = explode(',', $this->ip_address_restrictions);
            if ( ! in_array($ip_address, $ip_address_restrictions))
            {
                $ip_address_ok = false;
            }
        }

        return $ip_address_ok;

    }

    public function terminalOnlyAccess()
    {
        return false;
    }
}
