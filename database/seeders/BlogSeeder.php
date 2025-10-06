<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Contoh blog/news
        $blogs = [
            [
                'title' => 'Company Launches New Product',
                'author_id' => 1, // pastikan user admin ada
                'category_id' => 2, // Business Company
                'content' => 'Detail tentang produk baru...',
                'excerpt' => 'Ringkasan produk baru',
                'image' => 'product_launch.jpg',
                'is_published' => true,
                'published_at' => $now,
                'meta_title' => 'Company New Product Launch',
                'meta_description' => 'Info tentang produk baru perusahaan',
            ],
            [
                'title' => 'Company Achieves Milestone',
                'author_id' => 1,
                'category_id' => 1, // News
                'content' => 'Detail tentang pencapaian milestone...',
                'excerpt' => 'Ringkasan milestone',
                'image' => 'milestone.jpg',
                'is_published' => true,
                'published_at' => $now,
                'meta_title' => 'Company Milestone Achievement',
                'meta_description' => 'Info tentang milestone perusahaan',
            ],
        ];

        foreach ($blogs as $blog) {
            DB::table('blogs')->insert(array_merge($blog, [
                'slug' => Str::slug($blog['title']),
                'views' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
