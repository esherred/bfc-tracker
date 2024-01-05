<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'type',
        'subject',
        'email',
        'url'
    ];
}
