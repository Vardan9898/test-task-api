<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'active',
            'inactive',
            'blocked',
        ];

        foreach ($statuses as $status) {
            User::factory(7)->create([
                'status' => $status,
            ]);
        }
    }
}
