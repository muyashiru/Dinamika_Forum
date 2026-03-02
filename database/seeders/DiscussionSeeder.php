<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $tags = Tag::all();

        // Create sample discussions
        $discussions = [
            [
                'title' => 'Rekomendasi Framework JavaScript untuk Pemula',
                'content' => "Halo teman-teman!\n\nSaya baru mulai belajar JavaScript dan ingin mulai menggunakan framework. Kira-kira framework mana yang paling cocok untuk pemula ya?\n\nSaya sudah dengar tentang React, Vue, dan Angular. Tapi masih bingung mau mulai dari mana.\n\nTerima kasih!",
                'tags' => ['Pemrograman Web'],
            ],
            [
                'title' => 'Cara Optimasi Query Database MySQL',
                'content' => "Ada yang bisa kasih tips untuk optimasi query di MySQL?\n\nDatabase saya sudah mulai lambat dengan 100k+ records. Query yang biasanya 1 detik sekarang jadi 10 detik.\n\n```sql\nSELECT * FROM users \nJOIN orders ON users.id = orders.user_id \nWHERE orders.created_at > '2024-01-01'\n```\n\nAda saran?",
                'tags' => ['Basis Data'],
            ],
            [
                'title' => 'Implementasi Binary Search Tree di Python',
                'content' => "Guys, ada yang bisa bantu implementasi BST di Python?\n\nSaya lagi buat tugas kuliah tentang struktur data. Sudah coba tapi masih error pas delete node.",
                'tags' => ['Algoritma'],
            ],
        ];

        foreach ($discussions as $data) {
            $discussion = Discussion::create([
                'user_id' => $users->random()->id,
                'title' => $data['title'],
                'content' => $data['content'],
                'views' => rand(10, 500),
            ]);

            // Attach tags
            $tagIds = Tag::whereIn('name', $data['tags'])->pluck('id');
            $discussion->tags()->attach($tagIds);

            // Add some comments
            $commentCount = rand(1, 5);
            for ($i = 0; $i < $commentCount; $i++) {
                Comment::create([
                    'user_id' => $users->random()->id,
                    'discussion_id' => $discussion->id,
                    'content' => "Ini adalah komentar contoh #" . ($i + 1),
                ]);
            }
        }

        // Create more random discussions
        Discussion::factory(20)->create()->each(function ($discussion) use ($tags, $users) {
            // Attach random tags
            $discussion->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')
            );

            // Add random comments
            $commentCount = rand(0, 8);
            for ($i = 0; $i < $commentCount; $i++) {
                Comment::create([
                    'user_id' => $users->random()->id,
                    'discussion_id' => $discussion->id,
                    'content' => fake()->paragraph(),
                ]);
            }
        });
    }
}
