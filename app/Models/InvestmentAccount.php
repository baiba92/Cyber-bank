<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class InvestmentAccount extends Model
{
    use HasFactory, Notifiable;

    protected $with = ['user'];

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'number',
        'bank',
        'currency',
        'deposit',
        'balance',
        'withdrawal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()//: HasMany
    {
        return $this->hasMany(CryptoTransaction::class, );
    }
}
