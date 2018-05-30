<?php namespace App\Models\Tenant;

use App\Models\BaseModel;

class DocumentsBackup extends BaseModel {


	protected $fillable = [
		'document_id',
		'document_name',
		'document_date',
		'user_id',
		'document_text',
		'comments',
		'document_overview'
	    ];


}