<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicesRecords = [
            ['id'=>1,'nom_service'=>'IT','created_at'=>NULL,'updated_at'=>NULL],      
            ['id'=>2,'nom_service'=>'MARKETING','created_at'=>NULL,'updated_at'=>NULL],      
        ];

        Service::insert($servicesRecords);
    }
}
