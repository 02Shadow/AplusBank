<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory; 
    protected $fillable = [
        'account_id',
        'account_number',
        'cc',
        'cc_number',
        'cc_cvv',
        'cc_end',
        'balance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function outgoingTransaction()
    {
        return $this->hasMany(
            Transaction::class,
            'sender_name',
            'sender_id'
        );
    }

    public function incomingTransaction()
    {
        return $this->hasMany(
            Transaction::class,
            'recipient_name',
            'recipient_id'
        );
    }
}
