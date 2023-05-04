<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Device;
use App\Models\Company;
use App\Models\Softcompany;
use App\Models\UserMobileno;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function device()
    {
        return $this->hasOne(Device::class);
        // return $this->hasOne(Device::class)->ofMany('price', 'max');
        // return $this->hasOne(Device::class)->ofMany('price', 'min');
        // return $this->hasOne(Device::class)->latestOfMany();
        // return $this->hasOne(Device::class)->oldestOfMany();
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function deviceCompany()
    {
        return $this->hasOneThrough(Company::class,Device::class);
    }

    public function devicesCompanies()
    {
        return $this->hasManyThrough(Company::class,Device::class);
    }

    // Soft delete
    public function mobileno()
    {
        return $this->hasMany(UserMobileno::class);
    }
    
    public function softcompany()
    {
        return $this->belongsToMany(Softcompany::class);
    }

    // Soft delete child tables/models
    protected static function boot() {
        parent::boot();
        self::deleting(function (User $userins) {
            foreach ($userins->mobileno as $mobileno)
            {
                $mobileno->delete();
            }

            foreach ($userins->softcompany as $softcompany)
            {
                $softcompany->delete();
            }
        });
    }

}

// IF USE $userins->softcompany->delete(); ERROR BadMethodCallException
// Method Illuminate\Database\Eloquent\Collection::delete does not exist.