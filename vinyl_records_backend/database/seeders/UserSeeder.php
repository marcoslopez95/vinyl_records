<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $user_seed = [];
        $user_seed[] = [
            'first_name' => 'Usuario',
            'last_name' => 'Nomarl',
            'phone' => '5555555',
            'avatar' => '/storage/store.png',
            'rol_id' => 2,
            'confirmation_code' => null,
            'email' => 'usuario@vinylrecords.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
        $user_seed[] = [
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'phone' => '5555555',
            'avatar' => '/storage/store.png',
            'rol_id' => 1,
            'confirmation_code' => null,
            'email' => 'admin@vinylrecords.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
        foreach($user_seed as $u_s){
            User::create($u_s);
        }
        $users = User::all();
        $genres = Genre::all();
        foreach($users as $user){
            if($user->rol->id == 1){
                continue;
            }
            $cantidad = rand(1,4);
            $attch = $genres->random($cantidad);
            $user->tastes()->attach($attch->modelKeys());
        }
    }
}
