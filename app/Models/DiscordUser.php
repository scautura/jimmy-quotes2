<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscordUser extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable=['id','name'];
    protected $connection='sqlite';
}
