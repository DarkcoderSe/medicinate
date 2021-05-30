<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    public function medicines()
    {
        return $this->hasMany(DonationMedicine::class);
    }

    public function ngos()
    {
        return $this->belongsToMany(Ngo::class, 'donation_to_ngos', 'donation_id', 'ngo_id');
    }
}
