<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'name' => "Myo Thant Kyaw",
            'email' => "mtk@a.com",
            'password' => Hash::make('password')
        ]);

        Category::create([
            'user_id' => 1,
            'name' => "သင်တန်း",
            'slug' =>  'teaching'
        ]);
        Category::create([
            'user_id' => 1,
            'name' => "Marketing",
            'slug' =>  'marketing'
        ]);
    }
}
