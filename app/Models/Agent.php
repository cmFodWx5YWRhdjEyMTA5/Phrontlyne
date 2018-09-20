<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{

	use SoftDeletes;
    protected $table = 'agents_new';
    public $timestamps = false;
     protected $dates = ['deleted_at','date_of_birth','license_date','appointment_date'];
}
