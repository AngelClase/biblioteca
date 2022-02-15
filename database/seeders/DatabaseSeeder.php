<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*for ($i=0; $i < 5; $i++) { 
            $this->call(CategoriaSeeder::class);
        }
        */

        for ($i=0; $i < 5; $i++) { 
            $this->call(LibroSeeder::class);
        }

        $this->call(PrestamoSeeder::class);
    }
}
