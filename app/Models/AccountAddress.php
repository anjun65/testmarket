<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'address1',
        'address2',
        'province',
        'city',
        'zip',
        'country',
        'mobile',
    ];
}
