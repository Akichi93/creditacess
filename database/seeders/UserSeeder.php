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
            ['id'=>1,'name'=>'Admin','prenom'=>'admin','phone'=>'0758650487','image'=>NULL,'poste'=>'Administrateur','adresse'=>'ABIDJAN','civilite'=>'M.','actif'=>'0','email'=>'jeanphilippeakichi@gmail.com','email_verified_at'=> NULL,'password'=>'$2y$10$Y2niMCQWuigFfFn76gbWx.34lxgasyrNb27sB6yeTYvXVejuRYXN6','respo'=>'OUI','role'=>'ADMIN','date_debut_embauche'=>'2023-10-30','date_fin_embauche'=>'2024-10-30','service'=>'IT','rh'=>'NON','service_id'=>1,'remember_token'=>NULL,'created_at'=>NULL,'updated_at'=>NULL],
            ['id'=>2,'name'=>'KOUA','prenom'=>'ISABELLE','phone'=>'0102030405','image'=>NULL,'poste'=>'DRH','adresse'=>'ABIDJAN','civilite'=>'Mme','actif'=>'0','email'=>'jeanphilip.akichi@gmail.com','email_verified_at'=> NULL,'password'=>'$2y$10$Y2niMCQWuigFfFn76gbWx.34lxgasyrNb27sB6yeTYvXVejuRYXN6','respo'=>'OUI','role'=>'USER','date_debut_embauche'=>'2023-10-30','date_fin_embauche'=>'2024-10-30','service'=>'Rh','rh'=>'OUI','service_id'=>3,'remember_token'=>NULL,'created_at'=>NULL,'updated_at'=>NULL],
            ['id'=>3,'name'=>'NIOULE','prenom'=>'CHRIS','phone'=>'0151890303','image'=>NULL,'poste'=>'DG','adresse'=>'ABIDJAN','civilite'=>'M.','actif'=>'0','email'=>'billybillesakichi@outlook.fr','email_verified_at'=> NULL,'password'=>'$2y$10$Y2niMCQWuigFfFn76gbWx.34lxgasyrNb27sB6yeTYvXVejuRYXN6','respo'=>'NON','role'=>'DG','date_debut_embauche'=>'2023-10-30','date_fin_embauche'=>NULL,'service'=>NULL,'rh'=>'NON','service_id'=>NULL,'remember_token'=>NULL,'created_at'=>NULL,'updated_at'=>NULL],
        ];

        User::insert($usersRecords);
    }
}
