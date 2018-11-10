<?php

use Illuminate\Database\Seeder;
use News\User;

class DefaultAvatar extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('avatars')->insert([
            'name' => 'user.png',
            'user_id' => User::where('email', 'default')->first()->id
        ]);
    }
}
