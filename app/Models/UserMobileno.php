<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMobileno extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = ['mobile',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
