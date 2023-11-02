<?php

namespace Database\Seeders;

use App\Models\Contrat;
use Illuminate\Database\Seeder;

class ContratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ContratRecords = [
            ['id' => 1, 'user_id' => 1, 'date_debut' => '2023-11-02', 'date_fin' => NULL, 'duree' => NULL ,'type_contrat' => 'CDI', 'salaire' => 'NULL', 'created_at' => NULL, 'updated_at' => NULL],
        ];

        Contrat::insert($ContratRecords);
    }
}
