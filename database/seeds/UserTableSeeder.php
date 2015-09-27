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
        Right::truncate();
        $right=new Right;
        $right->status='enabled';
        $right->description='Portal Administrator';
        $right->right_name='Administrator';
        $right->input_by='System';
        $right->save();

        $right1=new Right;
        $right1->status='enabled';
        $right1->description='Normal User';
        $right1->right_name='Normal User';
        $right1->input_by='System';
        $right1->save();

        UserRight::truncate();
        $modules=array('Reports','Photo Galley','Downloads','Queries and Task');
        $count=0;
        foreach($modules as $module)
        {
            $count++;
            $userRight =new UserRight;
            $userRight->right_id=$right1->id;
            $userRight->module=$count;
            $userRight->viw=1;
            $userRight->edi=1;
            $userRight->del=1;
            $userRight->inp=1;
            $userRight->aut=0;
            $userRight->save();
        }

        $modules1=array('Reports','Photo Galley','Downloads','COPS Issues Tracking','CMF Reports','Money Msafiri','Human Resource','Queries and Task','System service status','Portal Administration');
        $count=1;
        foreach($modules1 as $module)
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
     for($i=1 ;$i<10; $i++)
     {


        $us=new User;
        $us->first_name="Portal".$i;
        $us->last_name="Administrator".$i;
        $us->designation="System Administrator";
        $us->username="admin".$i;
        $us->department_id=1;
        $us->branch_id=1;
        $us->user_type='Administrator';
        $us->password=bcrypt('admin');
        $us->status='Active';
        $us->phone=$i.$i.$i.$i.$i.$i.$i.$i.$i;
        $us->email='administrator'.$i.'@bankm.com';
        $us->right_id=1;
        $us->save();
     }



    }
}
