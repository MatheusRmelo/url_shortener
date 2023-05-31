<?php

namespace Database\Seeders\Tests;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('links')->insert([
            'id' => 1,
            'user_id' => 1,
            'title' => 'Teste',
            'slug' => 'teste',
            'url' => 'https://undraw.co/search',
            'hits' => 0
        ]);

        DB::table('links')->insert([
            'id' => 2,
            'user_id' => 1,
            'title' => 'Teste 2',
            'slug' => 'teste-2',
            'url' => 'https://undraw.co/search',
            'hits' => 0
        ]);

        DB::table('links')->insert([
            'id' => 3,
            'user_id' => 2,
            'title' => 'Teste 3',
            'slug' => 'teste-3',
            'url' => 'https://undraw.co/search',
            'hits' => 0
        ]);
    }
}
