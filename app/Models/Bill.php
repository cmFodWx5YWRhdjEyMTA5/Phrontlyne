<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
   protected $table = 'bills';
   public $timestamps = false;
   protected $dates = ['insurance_period_from','insurance_period_to'];


   


}
