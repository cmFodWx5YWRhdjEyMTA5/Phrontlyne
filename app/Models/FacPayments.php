<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacPayments extends Model
{
   use SoftDeletes;
   protected $table 	 = 'fac_payments_new';
   protected $dates 	 = ['pv_date'];
   public    $timestamps = false;
}
