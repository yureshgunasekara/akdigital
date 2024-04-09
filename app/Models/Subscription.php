<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'method',
        'billing',
        'transaction_id',
        'subscription_plan_id',
        'total_price',
        'currency',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subscription_plan(){
        return $this->belongsTo(SubscriptionPlan::class);
    }
}
