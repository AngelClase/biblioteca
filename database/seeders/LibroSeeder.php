<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('libros')->insert([
            'isbn' => $faker->numberBetween(100,999) ."-". $faker->numberBetween(1,9) ."-". $faker->numberBetween(100000,999999) ."-". $faker->numberBetween(10,99) ."-". $faker->numberBetween(1,9),
            'nombre' => $faker->name(),
            'categoria_id' => $faker->randomElement(Categoria::all()),
            'editorial' => $faker->name(),
            'imagen' => $faker->image(),
        ]);
    }
}
