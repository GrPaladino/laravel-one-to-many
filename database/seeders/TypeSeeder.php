<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $type = new Type;
        $type->label = 'backend';
        $type->color = $faker->hexColor();
        $type->save();

        $type = new Type;
        $type->label = 'frontend';
        $type->color = $faker->hexColor();
        $type->save();

        $type = new Type;
        $type->label = 'fullstack';
        $type->color = $faker->hexColor();
        $type->save();
    }
}
