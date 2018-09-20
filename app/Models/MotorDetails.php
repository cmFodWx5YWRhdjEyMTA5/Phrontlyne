<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;
use \Kbs1\Abbreviations\HasAbbreviation;

class MotorDetails extends Model
{
    protected $table = 'motor_details_new';
    public $timestamps = false;
    protected $dates = ['period_from','period_to','vehicle_lta_upload','vehicle_lta_transmission','created_on'];


    

}
