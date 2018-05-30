<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class Document extends BaseModel {


	protected $fillable = [
		'user_id_for_entry_lock',
		'document_name',
		'document_date',
		'user_id',
		'document_text',
		'auto_save_document_text',
		'comments',
		'document_overview'
	    ];


}