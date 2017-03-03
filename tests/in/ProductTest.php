<?php


use App\Models\Craiglorious\System;
use App\Models\Tenant\Product;
use App\Models\Tenant\ProductAttribute;
use App\Models\Tenant\ProductOption;
use App\Models\Tenant\ProductSku;
use IannazziTestLibrary\Tests\ApiTester;

class ProductTest extends ApiTester
{

    /** @test */
    function a_product_attribute_can_be_obtained()
    {
        $this->writeMethod(__METHOD__);
        $system = $this->getSystem();
        $product_attribute = ProductAttribute::where('name', '=', 'Size')->firstOrFail();
        $this->assertEquals($product_attribute->name, 'Size');
        $product_attribute = ProductAttribute::where('name', '=', 'Cup')->firstOrFail();
        $this->assertEquals($product_attribute->name, 'Cup');
        $product_attribute = ProductAttribute::where('name', '=', 'Color')->firstOrFail();
        $this->assertEquals($product_attribute->name, 'Color');
        $product_attribute = ProductAttribute::where('name', '=', 'Shoe Width')->firstOrFail();
        $this->assertEquals($product_attribute->name, 'Shoe Width');
        $product_attribute = ProductAttribute::where('name', '=', 'Inseam')->firstOrFail();
        $this->assertEquals($product_attribute->name, 'Inseam');

        $product_attribute = ProductAttribute::where('name', '=', 'Reading Strength')->firstOrFail();
        $this->assertEquals($product_attribute->name, 'Reading Strength');


    }
    /** @test
     */
    function a_product_option_can_return_a_name()
    {
        $this->writeMethod(__METHOD__);

        $system = $this->getSystem();
        $product = factory(Product::class)->create();
        $product_option = new ProductOption();
        $product_option->product_attribute_id = 'Color';
        $product_option->value = "Green";
        $product_option->product_id = $product->id;
        //$product_option->product()->associate($product);
        $product_option->save();
        $this->assertEquals($product_option->name(), 'Color');
        $this->assertEquals($product_option->product_attribute_id, '1');
    }

    /** @test
     */
    function a_product_option_can_be_associated_to_a_product()
    {
        $this->writeMethod(__METHOD__);

        $system = $this->getSystem();
        $product = factory(Product::class)->create();
        $product_option = new ProductOption();
        $product_option->product_attribute_id = 1;
        $product_option->value = "Green";
        //$product_option->product_id = $product->id;
        $product_option->product()->associate($product);
        $product_option->save();

        $data = $product->options()->where('value', 'Green')->first();
        $this->assertEquals($data->value, 'Green');
    }

    /** @test
     */
    function a_product_can_save_many_product_options()
    {
        $this->writeMethod(__METHOD__);

        $system = $this->getSystem();
        $product = factory(Product::class)->create();
        $product_option1 = new ProductOption();
        $product_option1->product_attribute_id = 'Size';
        $product_option1->value = '34';

        $product_option2 = new ProductOption();
        $product_option2->product_attribute_id = 'Color';
        $product_option2->value = 'Red';


        $product->options()->saveMany([$product_option1, $product_option2]  );


        $this->assertEquals($product->options()->count(), '2');


    }


    /** @test */
    function product_options_can_be_added_from_an_array()
    {
        $this->writeMethod(__METHOD__);

        $system = $this->getSystem();
        $product = factory(Product::class)->create();
        $product_options = [
            ['name' => 1, 'value' =>'Pink'],
            ['name' => 'Color', 'value' =>'Yellow'],
            ['name' => 'Color', 'value' =>'Yellow'],
            ['name' => 'Size', 'value' =>'1'],
            ['name' => 'Size', 'value' =>'2'],
            ['name' => 'Size', 'value' =>'3'],
            ];

        $product->saveOptionsArray($product_options);
        $this->assertEquals($product->options()->count(), '5');


    }
    /** @test */
    function product_options_can_be_added_from_a_condensed_array()
    {
        $system = $this->getSystem();
        $product = factory(Product::class)->create();
        $product_options = [
            ['Color' => 'Red'],
            ['Color' => 'Blue'],
            ['Color' => 'Orange'],
            ['Color' => 'Orange'],
            ['Size' => '32'],
            ['Size' => '34'],
            ['Size' => '36']
        ];
        $product_option_ids = $product->saveCondensedOptionsArray($product_options);
        $this->assertEquals($product->options()->count(), '6');

    }
    /** @test */
    function a_product_option_value_cannot_exceed_a_certain_length()
    {

    }
    /** @test */
    function a_product_option_can_only_be_produced_once()
    {
        $this->writeMethod(__METHOD__);

        $system = $this->getSystem();
        $product = factory(Product::class)->create();
        $product_options = [
            ['Color' => 'a_product_option_can_only_be_produced_once'],
            ['Color' => 'a_product_option_can_only_be_produced_once'],
            ['Color' => 'a_product_option_can_only_be_produced_once'],
            ['Size' => '32_a_product_option_can_only_be_produced_once'],
            ['Size' => '32_a_product_option_can_only_be_produced_once'],
            ['Size' => '32_a_product_option_can_only_be_produced_once']
        ];
        $product->saveCondensedOptionsArray($product_options);
        $this->assertEquals($product->options()->count(), '2');
    }
    /** @test */
    function a_product_sku_can_be_created()
    {
        $this->writeMethod(__METHOD__);

        $system = $this->getSystem();
        $product = factory(Product::class)->create();
        $product_option1 = new ProductOption();
        $product_option1->product_attribute_id = 'Size';
        $product_option1->value = '32';

        $product_option2 = new ProductOption();
        $product_option2->product_attribute_id = 'Color';
        $product_option2->value = 'Green';

        $product_option3 = new ProductOption();
        $product_option3->product_attribute_id = 'Color';
        $product_option3->value = 'Green';

        $product->options()->saveMany([$product_option1, $product_option2, $product_option3]  );

        // product option 3 id is now null..... should it not be a dup of product option 2?
        // $product_option3->id);

        $product_sku  = new ProductSku();
        $product_sku->upc = '1234';
        $product_sku->product_id = $product->id;
        //or $product_sku->product()->associate($product);
        $product_sku->save();

        $product_sku->options()->attach([$product_option1->id,$product_option2->id] );


        $this->assertEquals($product_sku->options()->count(), '2');


    }
    /** @test */
    function product_skus_can_be_created_from_options_array()
    {
        $this->writeMethod(__METHOD__);

        $system = $this->getSystem();
        $product = factory(Product::class)->create();
        $product_order_array = [
            //['Color' => 'Fuscha Baby'],
            //['Color' => 'Fuscha Baby'],

            ['Color' => 'Fuscha Baby', 'Size'=> 'XS'],
            ['Color' => 'Fuscha Baby', 'Size'=> 'XM'],
            ['Color' => 'Fuscha Baby', 'Size'=> 'XL'],
            ['Color' => 'Baby Blue', 'Size'=> 'XS'],
            ['Color' => 'Baby Blue', 'Size'=> 'XM'],

        ];
        $product->createSkus($product_order_array); //creates red sml and blue sml
        $this->assertEquals($product->skus()->count(), '5');

    }
}