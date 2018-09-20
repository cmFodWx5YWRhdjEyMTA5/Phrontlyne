<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;

class MotorRenewal extends Model
{
   protected $table = 'masterquoteview';
    public $timestamps = false;
    protected $dates = ['INSURANCE_END_DATE'];
}
