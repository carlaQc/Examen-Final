<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'rol_id' => 1,
            'name' => 'Ronald',
            'paternal'=>'Mollericona',
            'maternal'=>'Miranda',
            'gender'=>'1',
            'address'=>'Z/ Pedro Domingo Murillo C/ Gregorio garcia Lanza',
            'email'=>'roalmollericona@gmail.com',
            'ci' => '13408746',
            'phone'=>'78549821',
            'password'=>bcrypt(12345678)

        ]);
        User::create([
            'rol_id' => 1,
            'name' => 'Carla',
            'paternal'=>'Quenallata',
            'maternal'=>'Chejo',
            'gender'=>'2',
            'address'=>'Z/ Pedro Domingo Murillo C/ Pedro Leaño',
            'email'=>'CarQueChe@gmail.com',
            'ci' => '7034106',
            'phone'=>'61205818',
            'password'=>bcrypt(123465789)

        ]);
    }
}
