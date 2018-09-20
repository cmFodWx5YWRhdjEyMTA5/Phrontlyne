<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;

class TreatyBordeux extends Model
{
   protected $table = 'reinsurance_treaty_new';
   public $timestamps = false;
   protected $dates = ['record_date'];
}
