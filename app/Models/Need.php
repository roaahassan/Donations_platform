<?php

namespace App\Models;

use App\Models\User;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Need extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'amount',
        'collected_amount',
        'image_path',
        'supp_doc',
        'isUrgent',
        'rqst_date',
        'category',
    ];
    public function donations() {
        return $this->hasMany(Donation::class, 'need_id');
    }
    
    public function users() {
        return $this->belongsTo(User::class);
    }


}
