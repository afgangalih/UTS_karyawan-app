<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Admin Kedua',
                'username' => 'admin2',
                'password' => '12345',
                'level_id' => 1, // admin
            ],
            [
                'nama' => 'Budi Santoso',
                'username' => 'budi123',
                'password' => '12345',
                'level_id' => 3, // pegawai
            ],
            [
                'nama' => 'Siti Rahayu',
                'username' => 'siti456',
                'password' => '12345',
                'level_id' => 3, // pegawai
            ],
            [
                'nama' => 'Agus Wijaya',
                'username' => 'agus789',
                'password' => '12345',
                'level_id' => 3, // pegawai
            ],
            [
                'nama' => 'Dewi Lestari',
                'username' => 'dewi101',
                'password' => '12345',
                'level_id' => 3, // pegawai
            ]
        ];

        foreach ($users as $user) {
            DB::table('m_user')->insert([
                'nama' => $user['nama'],
                'username' => $user['username'],
                'password' => Hash::make($user['password']),
                'level_id' => $user['level_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}