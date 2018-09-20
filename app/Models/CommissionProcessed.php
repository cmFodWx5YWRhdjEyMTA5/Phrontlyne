<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionProcessed extends Model
{
    protected $table = 'commission_processed_new';
    public $timestamps = false;


     protected $fillable =['serial','transaction_type','branch','policy_product','exchange_rate','receipt_date','reference_number','collection_mode','insured_name','policy_number','invoice_number','agent_number','agent_name','currency','item','receipt_number','amount_payable','created_by','created_on','amount_paid','sticker_charge','commission_rate','gross_commission','tax','net_commission'];
}
