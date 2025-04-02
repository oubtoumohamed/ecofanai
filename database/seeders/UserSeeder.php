<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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

        $data = [
            [
                'firstname' => 'SUPER',
                'lastename' => 'ADMIN',
                'username' => 'superadmin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'ADMIN',
            ],
            [
                'firstname' => 'ALAMI',
                'lastename' => 'Ahmed',
                'username' => 'alamiahmed',
                'email' => 'alami@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'EMPLOYE',
            ],
        ];

        User::insert($data);
    }
}
