<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Veronica Antezana',
            'email' => 'vero@gmail.com',
            'password' => Hash::make('1234'), // Asegúrate de usar Hash para encriptar la contraseña
        ]);
    }
}
