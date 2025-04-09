<?php

namespace App\Models;

use App\Models\User;
use App\Models\DocType;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'doc_type_id',
        'marka',
        'tip',
        'varijanta',
        'filepdf',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function docType()
    {
        return $this->belongsTo(DocType::class, 'doc_type_id'); // Make sure this matches your column name
    }
}
