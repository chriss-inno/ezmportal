<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserRight;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();

        $us=new User;
        $us->first_name="Portal";
        $us->last_name="Administrator";
        $us->designation="System Administrator";
        $us->username="admin";
        $us->department_id=1;
        $us->branch_id=1;
        $us->user_type='Administrator';
        $us->password=bcrypt('admin');
        $us->save();



    }
}
