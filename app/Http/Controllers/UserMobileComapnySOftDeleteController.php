<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMobileno;
use App\Models\Softcompany;

class UserMobileComapnySOftDeleteController extends Controller
{
    public function storeMobileCompanyData(){
        $user_id = 3;
        // $mobile = new UserMobileno();
        // $mobile->mobile = 9876543215;
        // $mobile->user_id = $user_id;
        // $mobile->save();

        // $company = new Softcompany();
        // $company->name = 'Ashriya info 2';
        // $company->address = 'Mohali';
        // $company->save();       
        $company = Softcompany::find(3);
        $company->belongsToUser()->sync($user_id);
        // return ['company'=>$company,'mobile'=> $mobile];
    }

    public function listAllMobileCompanyData(){
        $id = 1;
        $user = User::withTrashed()->find($id);
        $data['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];
        foreach($user->mobileno as $mobileno){
            $data['user']['mobile'][] = $mobileno->mobile; 
        }
        foreach($user->softcompany as $softcompany){
            $com['name'] = $softcompany->name; 
            $com['address'] = $softcompany->address; 
            $data['user']['softcompany'][] = $com;
        }
        dump($data);
    }

    public function allListMobileCompanyData(){
        
        // $users = User::onlyTrashed()->get();
        // dd($users);

        // $id = 1;
        $users = User::withTrashed()->get();
        foreach($users as $user){
            $data['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ];
            foreach($user->mobileno as $mobileno){
                $data['user']['mobile'][] = $mobileno->mobile; 
            }
            foreach($user->softcompany as $softcompany){
                $com['name'] = $softcompany->name; 
                $com['address'] = $softcompany->address; 
                $data['user']['softcompany'][] = $com;
            }
            $user_data[] =$data;
        }
        dump($user_data);
    }

    public function listMobileCompanyData(){
        $id = 1;
        $user = User::find($id);
        if($user){
            $data['user'] = $user;        
            $data['mobileno'] = $user->mobileno;
            $data['softcompany'] = $user->softcompany;
            dd($data);
        }else{
            return 'No user found';
        }
        
    }
    
    public function deleteUserData(){
        $id =1;
        $user = User::find($id);
        if($user){
            $res = $user->delete();
        }else{
            $res = 'No data found!';
        }
        dump($res);
    }
    
    public function restoreUserData(){
        $id =1;
        // User::withTrashed()->find($id)->restore();
        User::onlyTrashed()->restore();
        UserMobileno::onlyTrashed()->restore();
        Softcompany::onlyTrashed()->restore();
    }
}



// SOFT DELETE CHILD TABLES

// You can make use of the events provided by Laravel.
// <?php
// class Parent extends Model
// {
//     protected static function boot()
//     {
//         static::deleting(function ($instance) {
//             $instance->child->each->delete();
//         });
//         static::restoring(function ($instance) {
//             $instance->child->each->restore();
//         });
//     }
// }
// Then you do the same in your child class. When your $parent is soft deleted, it will soft delete all the child. Then the child will also soft delete all it's child.
// For more information: https://laravel.com/docs/5.7/eloquent#events