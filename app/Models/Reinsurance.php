<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reinsurance extends Model
{
	use SoftDeletes;
    protected $table = 'reinsurance_transactions_new';
     public $timestamps = false;
        protected $dates = ['record_date','deleted_at'];
}
