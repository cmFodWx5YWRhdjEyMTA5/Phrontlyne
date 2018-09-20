<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
     protected $table = 'payments';
     protected $dates = ['receipt_date','created_on'];
     public $timestamps = false;
}
