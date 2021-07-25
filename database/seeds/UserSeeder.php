<?php

use App\User;
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
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->group = '1';
        $user->kode_upbjj = '24';
        $user->password = bcrypt('12345678'); 
        $user->save();
    }
}
