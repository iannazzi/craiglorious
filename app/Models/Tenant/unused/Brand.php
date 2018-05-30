<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;

class Brand extends BaseTenantModel
{
    /*
     * create an order for a brand
     * order from a vendor which is an A/P
     * order product skus from a vendor
     * I had an option to override the vendor email by having a brand
     * email.....
     * that sounds like a vendor issue....
     */

    protected $fillable = [
        'manufacturer_id',
        'name',
        'sales_rep_email',
        'sales_rep_name',
        'sales_rep_phone',
        'active',
        'comments'
    ];

    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}