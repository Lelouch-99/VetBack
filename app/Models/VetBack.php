<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VetBack extends Model
{
    use HasFactory;
    protected $table = 'vet_backs';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];
}
