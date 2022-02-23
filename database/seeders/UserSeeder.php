<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'ADMIN',
            'username' => 'admin',
            'role'=>2,
            'email'=>'admin@gmail.com',
            'password'=>'$2y$10$IYEDYnBubRcDSCocnlVGB.emLQi318gagURUsmds3AV95tuIRxUY6'
            /*12345678*/
        ]);
    }
}
