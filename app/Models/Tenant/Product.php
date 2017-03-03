<?php namespace App\Models\Tenant;

use App\Models\BaseTenantModel;

class Product extends BaseTenantModel
{


    protected $fillable = [
        'product_category_id',
        'brand_id',
        'sales_tax_category_id',
        'code',
        'name',
        'description',
        'active',
        'retail_price',
        'sale_price',
        'weight',
        'brand_size_id',
    ];

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }
    public function brand()
    {
        return $this->hasOne(Brand::class);
    }


    public function saveProductOption(ProductOption $option)
    {
        $product_option = ProductOption::where('product_id', $option->product_id)
            ->where('value', $option->value)
            ->where('product_attribute_id', $option->product_attribute_id);
        if ($product_option)
        {
            return $product_option;
        }

        return $option->save();

    }
    public function unitOfMeasure()
    {
        return array('Area', 'Count', 'Length', 'Time', 'Volumne', 'Weight');
    }
    public function saveOptionsArray($product_options)
    {
        /*
            $product_options = [
                ['name' => 1, 'value' =>'Pink'],
                ['name' => 'Color', 'value' =>'Yellow'],
                ['name' => 'Color', 'value' =>'Yellow'], //constraint violation
                ['name' => 'Size', 'value' =>'1'],
                ['name' => 'Size', 'value' =>'2'],
                ['name' => 'Size', 'value' =>'3'],
                ];
        */
        $options = [];
        foreach ($product_options as $product_option)
        {
            $option = new ProductOption();
            $option->product_attribute_id = $product_option['name'];
            $option->value = $product_option['value'];
            //$option = $option->checkBeforeSave();
            $options[] = $option;
        }

        return $this->options()->saveMany($options);

    }

    public function saveCondensedOptionsArray($product_options)
    {
        //array can be in the following formats:
        /*
        //multiple, condensed
         $product_options = [
            ['Color' => 'Red'],
            ['Color' => 'Blue'],
            ['Color' => 'Orange'],
            ['Size' => '32'],
            ['Size' => '34'],
            ['Size' => '36']
        ];

         //SKUS -----  multiple, condensed Options are Color: Red, Blue Size: S M L
        // Create 5 skus....
        $product_order_array = [
             ['Color' => 'Red', 'Size'=> 'S'],
             ['Color' => 'Red', 'Size'=> 'M'],
             ['Color' => 'Red', 'Size'=> 'L'],
             ['Color' => 'Blue', 'Size'=> 'S'],
             ['Color' => 'Blue', 'Size'=> 'M'],

         ];

        */
        $options = [];
        foreach ($product_options as $product_option)
        {
            $options = array_merge($options, $this->createCondensedProductOption($product_option));
        }
        $product_option_return_array = $this->options()->saveMany($options);
        $ids = [];
        foreach ($product_option_return_array as $option)
        {
            if ($option->id != null) $ids[] = $option->id;
        }

        return $ids;

    }

    public function createCondensedProductOption($product_option)
    {
        $options = [];
        foreach ($product_option as $name => $value)
        {
            $option = new ProductOption();
            $option->product_attribute_id = ProductAttribute::where('name', $name)->value('id');
            $option->value = $value;
            $options[] = $option;
        }

        return $options;
    }


    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    public function createSkus(array $product_order_array)
    {
        /* $product_order_array = [
             ['Color' => 'Red', 'Size'=> 'S'],
             ['Color' => 'Red', 'Size'=> 'M'],
             ['Color' => 'Red', 'Size'=> 'L'],
             ['Color' => 'Blue', 'Size'=> 'S'],
             ['Color' => 'Blue', 'Size'=> 'M'],

         ];*/
        $product_option_ids = $this->saveCondensedOptionsArray($product_order_array);

        foreach ($product_order_array as $product_option)
        {
            $product_sku = new ProductSku();
            //$product_sku->upc = '1234';
            $product_sku->product_id = $this->id;
            $product_sku->save();

            $product_sku->options()->attach($product_option_ids);

        }
    }


}