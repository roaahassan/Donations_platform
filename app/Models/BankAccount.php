<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    // اسم الجدول المرتبط بالموديل
    protected $table = 'bank_accounts';

    // الحقول القابلة للتعبئة
    protected $fillable = [
        'bank_name',
        'account_no',
    ];

    // العلاقة مع التبرعات
    public function donations()
    {
        return $this->hasMany(Donation::class, 'account_id');
    }
}
