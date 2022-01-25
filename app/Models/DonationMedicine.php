<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationMedicine extends Model
{
    use HasFactory;
    protected $fillable = [
        'donation_id',
        'name',
        'ndc',
        'expire_date',
        'quantity',
        'quantity_type',
        'nhs_id',
    ];
    public  function nhs(){
        return $this->belongsTo(Nhs::class);
    }
}
