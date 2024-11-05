<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $role = Role::Create(['name' => 'superadmin',]);
        $role = Role::Create(['name' => 'admin',]);
        $role = Role::Create(['name' => 'user',]);


        $user = User::create([
           'name' => 'Admin User',
           'email' => 'admin@example.com',
           'password' => bcrypt('password'),
        ]);

        $user->assignRole($role);
//         // User::factory(10)->create();

//         User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);
    }
}
