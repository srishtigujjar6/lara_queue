<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['url',];

    // imp
    // $table->morphs('imageable');
    use HasFactory;

    public function imageable()
    {
        return $this->morphTo();
    }

    // OR 
    // public function anyName()
    // {
    //     return $this->morphTo('imageable');
    // }
}
