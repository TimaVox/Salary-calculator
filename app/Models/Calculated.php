<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculated extends Model
{
    protected $table = 'calculated';
    protected $guarded = [];
    protected $hidden = ['id','updated_at', 'created_at'];

}
