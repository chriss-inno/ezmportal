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
        $us->password=bcrypt('admin');
        $us->save();

        //Populate user rights
        UserRight::truncate();
          for($i=1; $i<10; $i++)
          {
              $usr=new UserRight;
              $usr->user_id= $us->id;
              $usr->module= $i;
              $usr->viw= 1;
              $usr->edi=1;
              $usr->del= 1;
              $usr->inp= 1;
              $usr->aut= 1;
              $usr->save();
          }


    }
}
