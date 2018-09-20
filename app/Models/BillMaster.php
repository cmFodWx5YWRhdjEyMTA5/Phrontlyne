<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;

class BillMaster extends Model
{
     protected $table = 'billsmaster';



     public function payments()
    {
        return $this->hasMany('Phrontlyne\Models\Payments', 'invoice_number', 'invoice_number');
    }
}
