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
        $users = [
            [
                'name' => 'Автор неизвестен',
                'email' => 'ivan.ivanov@gmail.com',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Автор',
                'email' => 'avtor@ya.ru',
                'password' => bcrypt('12345')
            ]
        ];
        DB::table('users')->insert($users);
    }
}
