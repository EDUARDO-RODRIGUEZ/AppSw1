<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('cliente')->insert([
            [

                'imagen'=>'',
                'nombres'=>'eduardo',
                'apellidos'=>'rodriguez',
                'telefono'=>'71234567',
                'fechanacimiento'=>'2000-06-15',
                'sexo'=>1,
                'email'=>'ed@ed.com',
                'password'=>Hash::make('12345678'),
                'estado'=>1,
                'verificado'=>1,
                'token'=>''
            ]
            ]);

    }
}
