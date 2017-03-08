<?php

namespace App\Models\Craiglorious;

use App\Classes\Database\TenantDatabaseConnector;
use App\Models\BaseCraigloriousModel;


class System extends BaseCraigloriousModel
{
    private $dbc;

    protected $guarded = ['id'];
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
