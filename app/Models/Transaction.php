<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use HasFactory, Notifiable;

    protected $with = ['account'];

    protected $fillable = [
        'account_from_id',
        'account_to_id',
        'amount',
        'currency',
        'description'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
