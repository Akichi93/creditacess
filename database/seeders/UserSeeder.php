<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersRecords = [
            ['id'=>1,'name'=>'Admin','prenom'=>'admin','phone'=>'0758650487','image'=>NULL,'poste'=>'Administrateur','adresse'=>'ABIDJAN','civilite'=>'M.','actif'=>'0','email'=>'jean@gmail.com','email_verified_at'=> NULL,'password'=>'$2y$10$Y2niMCQWuigFfFn76gbWx.34lxgasyrNb27sB6yeTYvXVejuRYXN6','respo'=>'OUI','role'=>'ADMIN','date_debut_embauche'=>'2023-10-30','date_fin_embauche'=>'2024-10-30','service'=>'IT','rh'=>'NON','service_id'=>1,'remember_token'=>NULL,'created_at'=>NULL,'updated_at'=>NULL],
        ];

        User::insert($usersRecords);
    }
}
