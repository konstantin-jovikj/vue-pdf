<?php

namespace App\Models;

use App\Models\Document;
use Illuminate\Database\Eloquent\Model;

class DocType extends Model
{
    protected $fillable = [
        'doc_type',
    ];

    public function documents(){
        return $this->hasMany(Document::class);
    }
}
