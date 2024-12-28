<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $user = new User();
        // $user->name = 'admin';
        // $user->email = 'admin@gmail.com';
        // $user->phone = '0379375645';
        // $user->password = bcrypt('admin');
        // $user->role = 'admin';
        // $user->save();

        $user = new User();
        $user->name = 'Phạm Quang Huy';
        $user->email = 'huypham140103@gmail.com';
        $user->phone = '0888881401';
        $user->password = bcrypt('Huy12345');
        $user->save();
    }
}
