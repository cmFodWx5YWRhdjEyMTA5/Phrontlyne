<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claim extends Model
{
  use SoftDeletes;
  protected $table = 'filed_claims_new';
  public $timestamps = false;
  protected $dates = ['deleted_at','loss_date','date_notified','date_transacted','date_settled','period_from','period_to','created_on'];
}
