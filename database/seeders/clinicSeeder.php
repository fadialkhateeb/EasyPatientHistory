<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Seeder;

class clinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            Clinic::create([
                'cli_name' => $faker->name,
                'cli_address' => $faker->address,
                'cli_PhoneNo' => $faker->phoneNumber,
            ]);
        }
    }

}
