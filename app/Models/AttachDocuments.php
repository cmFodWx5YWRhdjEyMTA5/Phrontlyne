<?php

namespace Phrontlyne\Models;

use Illuminate\Database\Eloquent\Model;

class AttachDocuments extends Model
{
    public $timestamps = false;
	 protected $table = 'images';
	 protected $dates = ['created_on'];
   	 protected $fillable = [
        'owner_id',
        'filename',
        'image'
    ];

    public function fileowner() {
    return $this->belongsToMany('\Phrontlyne\Models\Customer');
}
}
