<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;
use Hashids;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Customer extends Model
{
	use Sortable;
	use SoftDeletes;
    protected $revisionEnabled = true;
    protected $revisionCleanup = true; //Remove old revisions (works only when used with $historyLimit)
    protected $historyLimit = 500; 


    protected $table = 'customer_new';
    public $timestamps = false;
    protected $dates = ['date_of_birth'];
    public $sortable = ['id', 'fullname', 'created_at', 'updated_at','mobile_number','created_by','deleted_at'];

}
