<?php

namespace Database\Seeders;

use App\Models\Libro;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class PrestamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('libros')->insert([
            'libro_id' => $faker->randomElement(Libro::all()),
            'user_id' => $faker->randomElement(User::all()),
            'fecha_plazo' => $faker->date()
        ]);
    }
}
