<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claimant extends Model
{
  use SoftDeletes;
  protected $table = 'claimant';
  public $timestamps = false;
  protected $dates = ['deleted_at'];
}
