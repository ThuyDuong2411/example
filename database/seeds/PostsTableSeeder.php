<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 100; $i++)
        {
            \App\Entities\Post::create([
                'title'            =>  'title'.$i,
                'content'          =>  'content'.$i,
                'user_id'          =>  random_int(1,20),
            ]);
        }
    }
}
