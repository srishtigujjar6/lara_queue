<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function belongsToManyDevice()
    {
        return $this->belongsToMany(Device::class)->withTimestamps();
        // Customizing The pivot Attribute Name 
        // return $this->belongsToMany(Device::class)->as('pivot_name_change'); // SAME RESULT
        // return $this->belongsToMany(Device::class)->as('pivotNameChange')->orderByPivot('id', 'asc'); 
        return $this->belongsToMany(Device::class)->as('pivotNameChange')->orderByPivot('id', 'desc');
    }

    public function belongsToManyDeviceWithCondition()
    {
        return $this->belongsToMany(Device::class)->wherePivot('device_id',">",4);
    }
}
