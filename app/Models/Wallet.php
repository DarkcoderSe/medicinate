<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Wallet extends Model
{
    use HasFactory;

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
