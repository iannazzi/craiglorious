<?php

namespace App\Models\Craiglorious;

use App\Classes\Database\TenantDatabaseConnector;
use App\Models\BaseCraigloriousModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class System extends BaseCraigloriousModel implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;


    private $dbc;

    protected $fillable = ['company', 'name', 'email', 'password', 'phone', 'address'];
    protected $hidden = ['password'];

    public function dbc()
    {
        $this->dbc =  TenantDatabaseConnector::GetDBCPrefix()  . $this->id;
        return $this->dbc;
    }

    public function createTenantConnection()
    {
      return  TenantDatabaseConnector::createTenantConnection($this);
    }
    public function setDBC()
    {
        //might need to reset the default dbc....
        TenantDatabaseConnector::setDefaultDBC($this);
    }
    public function views()
    {
        //system_view table to limit per system
        return View::all();
    }



}
