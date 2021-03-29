<?php

use Illuminate\Database\Seeder;
use App\UserModel;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserModel::create([
            'username' => 'demo',
            'password' => Hash::make('demo')
        ]);
    }
}
