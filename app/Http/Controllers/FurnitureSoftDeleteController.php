<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Furniture;

class FurnitureSoftDeleteController extends Controller
{
    public function storeFurniture(){
        $furniture = new Furniture();
        $furniture->title = 'Sofa';
        $furniture->price = 2000;
        $furniture->save();
        return $furniture;
    }

    public function deleteFurniture(){

        // Furniture::withTrashed()->find($id)->restore();
        // Furniture::onlyTrashed()->restore();

        $data = Furniture::find(1);
        if($data){
            $res = $data->delete();
        }else{
            return 'No data found!';
        }        
    }
    
    public function listAllFurnitureWithTrashed(){
        $furniture =Furniture::withTrashed()->get();
        return $furniture;
    }

    public function listAllFurniture(){
        $furniture =Furniture::get();
        return $furniture;
    }  
    
}
