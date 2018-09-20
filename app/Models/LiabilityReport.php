<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiabilityReport extends Model
{
	use SoftDeletes;
    protected $table = 'claim_liabilty_report';
   	public $timestamps = false;
   	protected $dates = ['deleted_at'];

}
