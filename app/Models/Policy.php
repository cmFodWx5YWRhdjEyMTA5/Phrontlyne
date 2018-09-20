<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;

class Policy extends Model
{
	use SoftDeletes;
	use Sortable;
    protected $table = 'filed_policies_new';
    public $timestamps = false;


    protected $guarded = [];
    protected $dates = ['insurance_period_from','insurance_period_to','first_issue_date','transaction_date','acceptance_date','deleted_at'];
    public $sortable = ['id', 'fullname', 'created_at', 'updated_at','created_by'];



   
}





