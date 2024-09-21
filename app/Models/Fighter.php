<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fighter extends Model
{
    use HasFactory;

    protected $fillable = [
        'm_card',
        'p_visa',
        'p_visa',
        'fname',
        'email',
        'phone',
        'fightname',
        'nationality',
        'birthday',
        'emergency',
        'sta_date',
        'exp_date',
        'type_training',
        'comment',
        'accom',
        'image',
    ];
}
