<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','name','mobile','type','complaints'];
    protected $hidden=['created_at','updated_at'];
}
