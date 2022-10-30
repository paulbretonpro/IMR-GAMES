<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Mr WHITE',
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque voluptatem totam, architecto cupiditate officia rerum, error dignissimos praesentium libero ab nemo.',
                'games_id' => 1,
                'icon' => 'undercover_mrwhite.svg',
            ],
            [
                'name' => 'UNDERCOVER',
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque voluptatem totam, architecto cupiditate officia rerum, error dignissimos praesentium libero ab nemo.',
                'games_id' => 1,
                'icon' => 'undercover_undercover.svg',
            ],
            [
                'name' => 'CIVIL',
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque voluptatem totam, architecto cupiditate officia rerum, error dignissimos praesentium libero ab nemo.',
                'games_id' => 1,
                'icon' => 'undercover_civil.svg',
            ]
        ]);
    }
}
