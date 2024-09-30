<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Element extends Model
{
    protected $table = 'users_elements';
    protected $fillable = [
        'ad_id',
        'user_id',
        'element_id',
    ];
}
