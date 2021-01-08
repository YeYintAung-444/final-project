<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=['admin','sales_staff','delivery'];
        
        foreach ($roles as $rolename){
        	$role=new Role;
        	$role->name=$rolename;
        	$role->save();
		}
    }
}
