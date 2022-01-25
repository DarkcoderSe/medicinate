<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =[
        'name',
        'email',
        'cardNumber',
        'expirationMonth',
        'expirationYear',
        'amount',
        'transactionId',
    ];
    use HasFactory;


}
