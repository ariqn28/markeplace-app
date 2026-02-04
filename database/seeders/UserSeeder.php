<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Akun Admin
        // Gunakan firstOrCreate: Jika akun sudah ada, biarkan (jangan reset password)
        $admin = User::firstOrCreate(['email' => 'admin@gmail.com'], [
            'name'              => 'Admin Marketplace',
            'password'          => Hash::make('Ariqnaufal-28'),
            'is_admin'          => true,
            'role'              => 'admin',
            'email_verified_at' => now(),
        ]);
        
        // Pastikan hak akses admin tetap aktif (jika akun lama statusnya masih user biasa)
        if (!$admin->is_admin) {
            $admin->is_admin = true;
            $admin->save();
        }

        // 2. Akun User Biasa
        User::firstOrCreate(['email' => 'ariqnaufalsyachroni57@gmail.com'], [
            'name'              => 'Ariq Naufal',
            'password'          => Hash::make('Ariqnaufal-28'),
            'is_admin'          => false,
            'role'              => 'user',
            'email_verified_at' => now(),
        ]);
    }
}