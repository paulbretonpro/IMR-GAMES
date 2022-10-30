<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UndercoverWordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('undercover_word')->insert([
            [
                'good' => 'word good 1',
                'fake' => 'word fake 1',
            ],
            [
                'good' => 'word good 2',
                'fake' => 'word fake 2',
            ],
            [
                'good' => 'word good 3',
                'fake' => 'word fake 3',
            ],
            [
                'good' => 'word good 4',
                'fake' => 'word fake 4',
            ],
            [
                'good' => 'word good 5',
                'fake' => 'word fake 5',
            ],
            [
                'good' => 'word good 6',
                'fake' => 'word fake 6',
            ],
        ]);
    }
}
