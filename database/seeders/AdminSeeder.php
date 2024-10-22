<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        // $user->is_admin = true;
        $user->password = Hash::make('password');
        $user->email = 'admin@xperts.my';
        $user->name = 'Admin';
        $user->save();

        $user->assignRole('super-admin');
        // $user->organization()->sync(1);
    }
}
