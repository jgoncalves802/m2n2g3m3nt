<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([

            'name' => 'Junior Gonçalves',
            'email' => 'jgoncalves802@hotmail.com',
            'password' => bcrypt('djjuninho201212'),
        ]);
    }
}
