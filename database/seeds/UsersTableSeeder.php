<?php

use App\Entities\User;
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
        for($i = 1; $i <= 20; $i++)
        {
            User::create([
                'name'            =>  'user'.$i,
                'email'           =>  'user'.$i.'@gmail.com',
                'password'        =>  bcrypt('user12345'),
            ]);
        }
    }
}
