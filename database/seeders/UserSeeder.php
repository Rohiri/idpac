<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'tecnologia',
            'email'=> 'tecnologia@participacionbogota.gov.co',
            'password' => Hash::make('secret'),
        ]);

        User::create([
            'name' => 'jairo',
            'email'=> 'jgrajales@participacionbogota.gov.co',
            'password' => Hash::make('secret2'),
        ]);

        User::create([
            'name' => 'andres grajales',
            'email'=> 'ingandresgrajales@gmail.com',
            'password' => Hash::make('secret3'),
        ]);
    }
}
