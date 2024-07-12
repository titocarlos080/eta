<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();
    
        DB::table('usuarios')->insert([
            [
                'name' => 'titocarlos',
                'email' => 'titocarlos080@gmail.com',
                'password' => Hash::make('123'),
                'password_reset' => null,
                'rol_id' => 1, // Asegúrate de que este rol exista
                'tematica_id' => 1, // Asegúrate de que esta temática exista
                
            ],
            [
                'name' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('password123'),
                'password_reset' => null,
                'rol_id' => 2, // Asegúrate de que este rol exista
                'tematica_id' => 2, // Asegúrate de que esta temática exista
                
            ],
            [
                'name' => 'Veronica Antezana',
                'email' => 'vero@gmail.com',
                'password' => Hash::make('1234'),
                'password_reset' => null,
                'rol_id' => 1, // Asegúrate de que este rol exista
                'tematica_id' => 2, // Asegúrate de que esta temática exista
                
            ],
            // Agrega más usuarios según sea necesario
        ]);
     }

}
