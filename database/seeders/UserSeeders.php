<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeders extends Seeder
{

    public function run()
    {
        // Membuat atau memperbarui pengguna admin
        $admin = User::where('email', 'admin@gmail.com')->first();

        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
        } else {
            // Perbarui nama dan password pengguna admin jika sudah ada
            $admin->update([
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]);
        }

        // Membuat peran admin jika belum ada
        $role = Role::updateOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Administrator']
        );

        // Mengaitkan peran dengan pengguna admin
        $admin->roles()->sync([$role->id]);
    }
}
