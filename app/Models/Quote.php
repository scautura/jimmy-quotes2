<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'added_by',
        'author_id',
        'author_name',
        'text'
    ];
}
