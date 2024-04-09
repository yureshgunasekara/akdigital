<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Laravel\Paddle\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    // use CashierBillable {
    //     newSubscription as protected newStripeSubscription;
    // }
    // use PaddleBillable {
    //     newSubscription as protected newPaddleSubscription;
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'subscription_plan_id',
        'status',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function billing(){
        return $this->belongsTo(Billing::class);
    }

    public function subscription_plan(){
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    // prompts related
    public function generated_prompts(){
        return $this->hasMany(GeneratedPrompt::class);
    }

    public function documents_save(){
        return $this->hasMany(SavedDocument::class);
    }

    public function most_used_templates(){
        return $this->belongsTo(MostUsedTemplate::class);
    }

    public function support_request(){
        return $this->hasMany(Support::class);
    }

    //paddle related
    public function paddle_user(){
        return $this->hasOne(PaddleUser::class);
    }

    //subscriber related
    public function subscriber(){
        return $this->hasMany(Subscribers::class);
    }
}
