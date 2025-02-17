<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(3)->create();

        $roles = ['admin', 'user'];

        foreach ($roles as $role) {
            Role::create(['name' => $role], ['created_at' => now()]);
        }

        User::create([
            'fullname' => 'Jahfal Mudrik Ramadhan',
            'username' => 'admin',
            'no_hp' => '0895383269891',
            'password' => bcrypt('adminjahfalrpltelyu'),
            'role_id' => 1,
            'created_at' => now()
        ]);
    }
}
