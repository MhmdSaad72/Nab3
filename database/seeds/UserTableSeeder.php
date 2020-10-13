<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user =  [
      'name'=>'Admin',
      'email' => 'admin@admin.com',
      'email_verified_at' => now(),
      'password'=>123456789,

    ];
    return User::create([
      'name' => $user['name'],
      'email' => $user['email'],
      'email_verified_at' => $user['email_verified_at'],
      'password' =>Hash::make($user['password']),
      'remember_token' =>Str::random(10),
    ]);
    }
}
