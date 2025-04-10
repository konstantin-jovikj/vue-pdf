<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'user_role',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
