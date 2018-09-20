<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
	use SoftDeletes;
	public $timestamps = false;
	protected $dates = ['created_on','deleted_at'];
	 protected $table = 'images';
   	 protected $fillable = [
        'accountnumber',
        'filename',
        'image'
    ];


}
