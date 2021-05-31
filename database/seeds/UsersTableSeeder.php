<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=10;$i++)
        {
            DB::table('users')->insert(
                [
                    'name'=>'Bin_'.$i,
                    'email'=>'Bin_'.$i.'@bin.com',
                    'password'=> bcrypt('123456'),
                    'level'=> 0,
	            	'created_at' => new DateTime(),
                ]
                );
        }
    }
}
