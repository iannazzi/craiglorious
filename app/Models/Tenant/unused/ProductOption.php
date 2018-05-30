<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;
use DB;

class ProductOption extends BaseTenantModel
{

    protected $fillable = [
        'id',
        'product_attribute_id',
        'product_id',
        'value',
        //'option_code',
        //'sort_index',
        //'price_adjustment',
        //'unique_web_product',
        //'extra_tags',
        //'active',
        //'comments'
    ];

    public function save(array $options = [])
    {
        // before save code - Check for a unique value....
        // before check for unique, the value will truncate causing another issue...

        $product_option = ProductOption::where('product_id', $this->product_id)
            ->where('value' ,$this->truncateString('value'))
            ->where('product_attribute_id',$this->product_attribute_id)
            ->first()
        ;
        if($product_option)
        {
            return false;
        }

        parent::save();
        // after save code
    }
    public function name()
    {
        //select name from product_attributes where id=$this->product_attribute_id
        return $this->product_attribute->name;
    }

    public function product_skus()
    {
        return $this->belongsToMany(ProductSku::class);
    }

    public function product_attribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }



    public function setProductAttributeIdAttribute($name)
    {
        if ( ! is_int($name))
        {
            $product_attribute = ProductAttribute::where('name', $name)->firstOrFail();
            $this->attributes['product_attribute_id'] = $product_attribute->id;
        }
        else
        {
            $this->attributes['product_attribute_id'] = $name;
        }

    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}