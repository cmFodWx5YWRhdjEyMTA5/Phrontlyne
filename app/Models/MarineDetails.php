<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;

class MarineDetails extends Model
{
   protected $table = 'marine_details_new';
   protected $dates = ['departure_date','voyage_date'];
   public $timestamps = false;
}
