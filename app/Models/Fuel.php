<?php

namespace App\Models;

use App\Models\Document;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $fillable = [
        'fuel',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
