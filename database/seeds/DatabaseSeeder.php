<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		// $this->call(UsersTableSeeder::class);

		// 新增十個資料內容
		// factory(App\User::class, 10)->create();

		// 透過 DB class 建立資料
		DB::table('users')->insert([
			// 'name' => Str::random(10),// 產生長度 10 的字串
			'name' => 'demo',
			// 'email' => Str::random(10) . '@gmail.com',
			'email' => 'demo@demo',
			// 'password' => bcrypt('secret'),// 產生亂數密碼
			'password' => Hash::make('demo'),
			'role' => 'root',
		]);
	}
}
