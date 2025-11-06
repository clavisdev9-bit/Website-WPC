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
                'image' => 'default.jpg',
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
                'image' => 'default.jpg',
                'is_published' => true,
                'published_at' => $now,
                'meta_title' => 'Company Milestone Achievement',
                'meta_description' => 'Info tentang milestone perusahaan',
            ],
             [
                'title' => 'New Partnership Strengthens Market Position',
                'author_id' => 1,
                'category_id' => 2, // Partnership
                'content' => 'Perusahaan mengumumkan kerja sama strategis dengan mitra baru untuk memperluas pasar global...',
                'excerpt' => 'Kolaborasi baru memperkuat posisi perusahaan di pasar.',
                'image' => 'default.jpg',
                'is_published' => true,
                'published_at' => $now,
                'meta_title' => 'Strategic Partnership Announcement',
                'meta_description' => 'Detail kerja sama baru perusahaan untuk memperluas pasar.',
            ],
            [
        'title' => 'CEO Shares Vision for the Future',
        'author_id' => 1,
        'category_id' => 1, // Leadership
        'content' => 'Dalam wawancara terbaru, CEO perusahaan membagikan visi dan rencana jangka panjang...',
        'excerpt' => 'Wawancara eksklusif dengan CEO tentang arah masa depan perusahaan.',
        'image' => 'default.jpg',
        'is_published' => true,
        'published_at' => $now,
        'meta_title' => 'CEO Vision for Company Future',
        'meta_description' => 'Wawasan CEO mengenai strategi dan inovasi ke depan.',
    ],
    [
        'title' => 'Company Expands to Southeast Asia',
        'author_id' => 1,
        'category_id' => 1, // Business Company
        'content' => 'Perusahaan resmi membuka cabang baru di Asia Tenggara untuk memperluas jangkauan operasional...',
        'excerpt' => 'Ekspansi perusahaan ke wilayah Asia Tenggara.',
        'image' => 'default.jpg',
        'is_published' => true,
        'published_at' => $now,
        'meta_title' => 'Company Expansion to Southeast Asia',
        'meta_description' => 'Perusahaan memperluas operasi ke Asia Tenggara.',
    ],
    [
        'title' => 'New Sustainability Program Announced',
        'author_id' => 1,
        'category_id' => 2, // Environment
        'content' => 'Program keberlanjutan baru diluncurkan untuk mengurangi jejak karbon dan mendukung ekosistem hijau...',
        'excerpt' => 'Inisiatif hijau perusahaan untuk masa depan berkelanjutan.',
        'image' => 'default.jpg',
        'is_published' => true,
        'published_at' => $now,
        'meta_title' => 'Sustainability Program Launch',
        'meta_description' => 'Perusahaan memperkenalkan program keberlanjutan baru.',
    ],
    [
        'title' => 'Employee Innovation Award 2025 Winners',
        'author_id' => 1,
        'category_id' => 2, // HR / Internal
        'content' => 'Perusahaan mengumumkan pemenang penghargaan inovasi tahunan untuk menghargai kreativitas karyawan...',
        'excerpt' => 'Daftar pemenang penghargaan inovasi 2025.',
        'image' => 'default.jpg',
        'is_published' => true,
        'published_at' => $now,
        'meta_title' => 'Innovation Award Winners 2025',
        'meta_description' => 'Pemenang penghargaan inovasi perusahaan tahun 2025 diumumkan.',
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
