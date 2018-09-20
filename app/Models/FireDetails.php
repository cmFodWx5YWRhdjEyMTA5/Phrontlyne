<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;

class FireDetails extends Model
{
    protected $table = 'fire_details_new';
     public $timestamps = false;
     


     public function getTotalValueAttribute() 
   	{
    return $this->sum('item_value');
	}

	 public function getLongDiscountAttribute() 
   	{
    return $this->actual_premium * $this->long_term_discount/100;
	}

   public function getExtinguisherDiscountAttribute() 
    {
    return  $this->fire_extinguisher/100;
  }

  public function getHydrantDiscountAttribute() 
    {
    return  $this->fire_hydrant/100;
  }
}
