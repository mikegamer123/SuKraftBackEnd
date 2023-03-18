<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Media;
use App\Models\Post;
use App\Models\Seller;
use App\Models\User;
use Database\Factories\CommentFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Media::factory(5)->create();
        User::factory(5)->create();
        Seller::factory(5)->create();
        Post::factory(3)->create();
        Like::factory(3)->create();
        Comment::factory(3)->create();
    }
}
