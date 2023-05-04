<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Device;

class CompanyDeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // foreach(Device::all() as $device){
        //     $company = Company::inRandomOrder()->take(rand(1,3))->plunk('id');
        //     $device->company()->attach($company);
        // }
    }
}
// php artisan migrate:fresh --seed --seeder=CompanyDeviceSeeder

