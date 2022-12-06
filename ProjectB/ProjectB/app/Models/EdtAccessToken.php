<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EdtAccessToken extends Model
{
    use HasFactory;

    public $table = "edt_access_token";

    protected $fillable = [
        'code',
    ];
}

