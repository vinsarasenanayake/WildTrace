<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'vinsara@gmail.com'],
            [
                'name' => 'Vinsara',
                'password' => \Illuminate\Support\Facades\Hash::make('Vinsara2003'),
                'is_admin' => true,
                'contact_number' => '771234567',
                'address' => '123 Wild Trace Avenue',
                'city' => 'Colombo',
                'postal_code' => '10100',
                'country' => 'Sri Lanka',
            ]
        );

        $this->call([
            PhotographerSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
