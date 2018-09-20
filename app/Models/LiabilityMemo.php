<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiabilityMemo extends Model
{
    use SoftDeletes;
    protected $table = 'claim_memo';
   	public $timestamps = false;
   	protected $dates = ['deleted_at'];

}

