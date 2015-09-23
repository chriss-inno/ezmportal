<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserRight;
use App\Right;

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
        //Enter user right
        Right::trancate();
        $right=new Right;
        $right->status='enabled';
        $right->description='Normal User';
        $right->right_name='Normal User';
        $right->input_by='System';
        $right->save();

        UserRight::trancate();
        $modules=array('Reports','Photo Galley','Downloads','Queries and Task');
        $count=0;
        foreach($modules as $module)
        {
            $count++;
            $userRight =new UserRight;
            $userRight->right_id=$right->id;
            $userRight->module=$count;
            $userRight->viw=1;
            $userRight->edi=1;
            $userRight->del=1;
            $userRight->inp=1;
            $userRight->aut=0;
            $userRight->save();
        }

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
