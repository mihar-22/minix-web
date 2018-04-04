<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(\Minix\Auth\Models\User::class)->create([
            'email' => 'dev@minix.com',
        ]);
    }
}
