<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Device;
use App\Models\Company;

// Tables:
// User
// Device
// Company
class RelationshipController extends Controller
{
    public function showCurrentUserDeviceList() {
        $device = $this->getDevices();
        return $device;
    }  
    
    public function addDevices() {
        $user_id = Auth::id();
        // $user_id = 2;
        $device = new Device();
        $device->name = 'SFSD-190';
        $device->price = 3000;
        $device->user_id = $user_id;
        $device->save();
        if($device){
            return $device;
        }else{
            return "Something went wrong!";
        }        
    }
        
    // ONE TO ONE
    public function getDevice() { 
        $user_id = Auth::id(); 
        $device = User::find($user_id)->device; // return 1st entry
        if($device){
            return $device;
        }else{
            return "No device found!";
        }        
    }

    // ONE TO MANY
    public function getDevices() { 
        $user_id = Auth::id(); 
        $devices = User::find($user_id)->devices; // return all entries
        if($devices){
            return $devices;
        }else{
            return null;
        }        
    }

    // Get user by device id
    public function getUserByDeviceId($id) { 
        $user = Device::findOrFail($id)->user; 
        // $user = Device::find($id)->user; 
        if($user){
            return $user;
        }        
    }

    // ADD COMAPNY
    public function addCompany() {
        $device_id = 1;
        $company = new Company();
        $company->name = 'Abhu';
        $company->location = "India";
        $company->device_id = $device_id;    
        $company->save();
        if($company){
            return $company;
        }else{
            return "Something went wrong!";
        }        
    }

    // Get company by user id
    public function getCompanyByUserId($id) { 
        $company = User::find($id)->deviceCompany; 
        // dump($company);
        if($company){
            return $company;
        }else{
            return 'No company found, please enter valid user id!';
        }        
    }

    // Get all company by user id
    public function getAllCompaniesByUserId($id) { 
        $company = User::find($id)->devicesCompanies; 
        // dump($company);
        if($company){
            return $company;
        }else{
            return 'No company found, please enter valid user id!';
        }        
    }
    
    // Many to Many
    // Get all company by Device id
    public function belongsToManyCompanyByDevice($id) { 
        $company = Device::find($id)->belongsToManyCompany; 
        if(!empty($company)){
            foreach($company as $d){
                $test = [];
                $test['pivot_device_id'] = $d->pivot->device_id;
                $test['pivot_company_id'] = $d->pivot->company_id;
                $test['company_id'] = $d->id;
                $test['name'] = $d->name;
                $companies['company'][] = $test;
            }
            // return $companies;
            return $company;
        }else{
            return 'No company found, please enter valid device id!';
        }        
    }

    // Get all device by Company id
    public function belongsToManyDeviceByCompany($id) { 
        $device = Company::find($id)->belongsToManyDevice; 
        if(!empty($device)){
            foreach($device as $d){
                $test = [];
                $test['device_id'] = $d->id;
                $test['name'] = $d->name;
                $devices['device'][] = $test;
            }
            // return $devices;
            return $device;
        }else{
            return 'No device found, please enter valid company id!';
        }        
    }

    // Get all device by Company id
    public function belongsToManyDeviceByCompanyWithCondition($id) { 
        $device = Company::find($id)->belongsToManyDeviceWithCondition; 
        if(!empty($device)){
            return $device;
        }else{
            return 'No device found, please enter valid company id!';
        }        
    }

    // Get all device by Company id
    public function attachDeviceAndComany() { 
        $company = Company::find(4); 
        // $company->belongsToManyDevice()->attach([8]); // Add data
        $company->belongsToManyDevice()->sync([1,8]); // Update data
        return $company;
    }

        // $user->roles()->detach($roleId); // Detach a single role from the user
        // $user->roles()->detach(); // Detach all roles from the user
        // $company->belongsToManyDevice()->attach([8]); // Add data
        // $company->belongsToManyDevice()->sync([1,8]); // Update data
}
