<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
                        Model::unguard();

                        DB::table('users')->truncate();
                        Ognestraz\Admin\Models\User::create([
                            'act' => '1',
                            'role_id' => '1',
                            'email' => 'admin@mail.ru',
                            'name' => 'admin',
                            'password' =>Hash::make('nthvf8vg8akfq')
                        ]);
                        
                        Ognestraz\Admin\Models\User::create([
                            'act' => '1',
                            'role_id' => '2',
                            'email' => 'moderator@mail.ru',
                            'name' => 'moderator',
                            'password' =>Hash::make('moderator')
                        ]);
                        
                        Ognestraz\Admin\Models\User::create([
                            'act' => '1',
                            'role_id' => '3',
                            'email' => 'user1@mail.ru',
                            'name' => 'user1',
                            'password' =>Hash::make('user1')
                        ]);
                        
                        Ognestraz\Admin\Models\User::create([
                            'act' => '1',
                            'role_id' => '3',
                            'email' => 'user2@mail.ru',
                            'name' => 'user2',
                            'password' =>Hash::make('user2')
                        ]);                        
                        
	}

}
