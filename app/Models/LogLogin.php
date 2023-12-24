<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogLogin extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'ip',
        'user_agent',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
    ];
}
