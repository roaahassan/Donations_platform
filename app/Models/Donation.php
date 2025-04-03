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
        return $this->belongsTo(Need::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
