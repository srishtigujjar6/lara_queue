<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Device extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function belongsToManyCompany()
    {
        return $this->belongsToMany(Company::class);
        // return $this->belongsToMany(Company::class)->orderByPivot('created_at', 'asc');
    }
}
