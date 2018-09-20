<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;

class BondDetails extends Model
{
   protected $table = 'bond_details_new';
   public $timestamps = false;


   public function getAnnualPremiumAttribute() 
   {
    return $this->bond_sum_insured * $this->bond_rate/100;
	}

}
