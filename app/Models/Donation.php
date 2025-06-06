<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = [
        'need_id',
        'user_id',
        'status',
        'amount',
        'receipt'
    ];
    public function need() {
        return $this->belongsTo(Need::class, 'need_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    // العلاقة مع الحساب البنكي
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'account_id');
    }
}
