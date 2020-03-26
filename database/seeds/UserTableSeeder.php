<?php

use Illuminate\Database\Seeder;
use App\role;
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
        $role_user = role::where('name','User')->first();
        $role_employee = role::where('name','Employee')->first();
        $role_admin = role::where('name','Admin')->first();
        $user = new User();
        $user->username ='kontra';

        $user->lastname ='Visitor';
        $user->email ='visitor@example.com';
        $user->password = bcrypt('visitor');
        $user->save();
        $user->roles()->attach($role_user);

        $admin = new User();
        $admin->username ='tham';
        $admin->lastname ='Admin';
        $admin->email ='admin@example.com';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $employee = new User();
        $employee->username ='Inlard';
        $employee->lastname ='Employee';
        $employee->email ='employee@example.com';
        $employee->password = bcrypt('employee');
        $employee->save();
        $employee->roles()->attach($role_employee);

    }
}
