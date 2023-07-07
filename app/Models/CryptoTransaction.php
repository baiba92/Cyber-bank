<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CryptoTransaction extends Model
{
    use HasFactory, Notifiable;

    protected $with = ['account'];

    protected $fillable = [
        'account_id',
        'crypto_id',
        'cryptocurrency',
        'currency',
        'price',
        'invest',
        'crypto_parts'
    ];

    public function account()
    {
        return $this->belongsTo(InvestmentAccount::class);
    }
}
