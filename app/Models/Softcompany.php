<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Softcompany extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = ['name','address',];

    public function belongsToUser()
    {
        return $this->belongsToMany(User::class);
    }
}
