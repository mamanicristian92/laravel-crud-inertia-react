<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;


use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $categories = Category::factory(5)->create();
        User::factory(5)
            ->has(Post::factory(3)
            ->hasComments(2)
            ->afterCreating(function ($post) use ($categories) {
                $post->categories()->attach(
                $categories->random(rand(1,3))->pluck('id')
                );
            })
            )
        ->create();
    }
}
