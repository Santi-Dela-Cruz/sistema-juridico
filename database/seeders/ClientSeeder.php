<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_ES');
        $usedEmails = [];
        $usedIDs = [];

        for ($i = 0; $i < 100; $i++) {
            $personType = $faker->randomElement(['natural', 'jurídica']);
            $identificationType = $faker->randomElement(['Cédula', 'RUC', 'Pasaporte']);

            // Generar identificación única
            do {
                $identification = match ($identificationType) {
                    'Cédula'    => $faker->unique()->numerify('##########'),
                    'RUC'       => $faker->unique()->numerify('#############'),
                    'Pasaporte' => Str::upper($faker->bothify('??#######')),
                };
            } while (in_array($identification, $usedIDs));
            $usedIDs[] = $identification;

            // Generar correo único
            do {
                $email = $faker->unique()->safeEmail;
            } while (in_array($email, $usedEmails));
            $usedEmails[] = $email;

            DB::table('clients')->insert([
                'full_name'             => $faker->name,
                'identification_type'   => $identificationType,
                'person_type'           => $personType,
                'identification_number' => $identification,
                'address'               => $faker->address,
                'phone_number'          => $faker->phoneNumber,
                'email'                 => $email,
                'is_active'             => $faker->boolean(90),
                'registered_at'         => $faker->dateTimeBetween('-2 years', 'now'),

                // Campos adicionales según el tipo de persona
                'marital_status'        => $personType === 'natural' ? $faker->randomElement(['Soltero', 'Casado', 'Divorciado', 'Viudo']) : null,
                'legal_representative'  => $personType === 'jurídica' ? $faker->name : null,
                'fiscal_address'        => $personType === 'jurídica' ? $faker->address : null,

                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }
    }
}
