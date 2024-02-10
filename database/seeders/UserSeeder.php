<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; # Esto es por la importación de la clase 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Debemos importarlo como modelo de usuario (véase línea 5)
        User::create([
            'full_name' => 'Facundo Castro',
            'email' => 'facundo@correo.com',
            'password' => Hash::make('123456'),
        ])->assignRole('Administrator');

        User::create([
            'full_name' => 'Tommy Mendeleviev',
            'email' => 'mendeleviev@correo.com',
            'password' => Hash::make('123456789'),
        ])->assignRole('Author');

        # Para generar los registros. Entre paréntesis va el número de registros. El factory se encuentra
        # en el archivo UserFactory.php en la carpeta factories
        User::factory(10)->create(); 

    }
}
