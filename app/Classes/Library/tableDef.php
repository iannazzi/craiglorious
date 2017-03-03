<?php
namespace App\Classes\Library;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

Class tableDef
{
/*

THIS IS ACTUALLY A COLUMN DEF

In addition to my old table def it looks like I should be able to do this:

the user model maps to the database table
I want it to also be able to create data?

faker => for example an id Model::all()->random(1); //would need to sepcify table creation order..
fillable, 
database column name, 
post name, 
search results name?

######################## Setting Table row clicks... ########################################
        
        create the function
        var rowclick = function(){customerSelect(this.rowIndex);};
        var rowclick1 = function(){alert(this.rowIndex);};
                    
        for the dynamic table:
        cust_table.setAllRowProps('onclick',rowclick );
        cust_table.setRowProp(0,'ondblclick', rowclick1);
        
        however for the default value use (when adding new rows...)
        cust_table.rdo('onclick',rowclick );
        
        for the search results table
        table_name.setAllSearchResultsRowProps('onclick',rowclick );
        table_name.setSearchResultsRowProp(0,'ondblclick', rowclick1);
        
        ######################## Setting Table row clicks... ########################################
        
        setting styles
        invoice_table.setRowProp(row,'className', '"return_row"');

        
        
        
        
        
        //row and cell properties:
        events
        http://help.dottoro.com/larrqqck.php
        properties
        https://developer.mozilla.org/en-US/docs/Web/API/Element/className
        styles
        http://www.quirksmode.org/dom/w3c_css.html
        
        
        
        create the html content for the table which includes the header and footer and return it. Attach it to the div elsewhere
        
        this is the column definition
        it needs to deal with creating the header, the spacing, and the columns. It sets the cells to receive the data

        it is created in php
        javascript needs this, and the data from php
        
        a dynamic column lets you adjust the column - brand size chart
            need a 'column_checkbox' and column number as well
            when you add a column the tdo needs to add a column
            so + the column and it will have to add a new column.... that can simply be an "array"
        then there is static dynamic column - size chart in the order form
            this probably is created by modifying the table def before loading it.
            then the data has to match the db_field name
        
        var column_def = 
            [{
            'db_field' : 'none','row_number' are reserved.  1D arrays should possible
            'type': 
                hidden, 
                row_checkbox, 
                input, 
                checkbox, 
                select, 
                tree_select, 
                individual_select, 
                textContent, 
                innerHTML,  
                row_number  
                none 
                date (dateSelect)
                
                link (which requires 'get_url_link' => "retail_sales_invoice.php?type=view",
                    // no url_caption then use the data 'url_caption' => 'View',
                    'get_id_link' => 'pos_customer_id')
                    
                button  should be used specifically to execute javascript code
                    use with 'button_caption' for caption       
            'round' :
            'total' :
            'search' : LIKE ANY (explode spaces and search each option) BETWEEN EXACT - used for building the search table BETWEEN is required for type date?
            'html' : for innerHtml?
            'footer': what to do about the footer?
            'valid_input' :
            'th_repeat' : repeat table header every x lines
            'select_values': array used for selects
            'select_names': array used for selects
            'select_array': used for tree select .. nested array
                                        $cat_array[$pos_category_id] = array(
                                            'name' => $cat_name,
                                            'children'=>$children
                                            );
            'td_tags' : [] array of tags in case we want to attach something to the td
            'properties': { //these are all javascript prooperties to attach to each element... again could be an array?
                            'size':
                            
                        
            
            
                            }
            'th_width': x px em %, a 1 d array should be allowed.
            'caption' :  //this can be a zero one or two dimensional array like size chart
            'col_span' : // not sure how this would be implemented or why?
            'row_span : //row span is need when a column has multiple rows, the others need rowspan.
            'default_value'
            'POST' : No ... need to limit post values as much as possible. max_input_vars
            'RETURN_DATA' : NO - do not return the data looked up....why -  data was needed just for search results....
                                or we just do this in the function call to get the data...
            'variable_get_url_link' : depending on a row result we need different links here
            
            
                        array(
            'row_result_lookup' => 'content_type',
            "CREDIT_CARD" => array(
                            'url' => POS_ENGINE_URL.'/sales/storeCreditCards/store_credits.php?type=view', 
                            'get_data' => array('pos_store_credit_id'=>'pos_store_credit_id')
                                        ),               
            "PRODUCT" =>  array(
                            'url' => POS_ENGINE_URL.'/products/ViewProduct/view_product.php',
                            'get_data' => array('pos_product_id' => 'pos_product_id')
                                        )
                                                    ),
                                                    
            
            'word_wrap'
            'array' : 0  //dynamic column generation db_field is modified db_field_1 etc...
            }],

    */
    /*
        the table def should define MANYYYYYY THings
        - The element type for view/add/edit
        - The element type for listing? 
        - the interface to the database
        

        other things that laravel is showing me
        - fillable (defaults to true)
        - Migration
        - The csv file import/ export

        - this might be a good example of a contract or interface
        - I might also want to extend eloquent to grab thier functionality....

        why?
        I have hundereds of models to create


		$table_def = array(
			array(
				'db_field'=> 'field_name',
				'db_spec' => array('integer', )
				'element_type' => 'tree_select'),
			array(),
		);

        $td = new tableDef($array);
        $td->createDBTable($table_name)

    */

      public function createDBTable($table_name){
	      	Schema::create($table_name, function(Blueprint $table)
			{
				foreach($table as $key=>$value)
				{

				}
			});
      }
}