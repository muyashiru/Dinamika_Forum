<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Pemrograman Web', 'color' => '#3B82F6', 'description' => 'Diskusi seputar pemrograman web'],
            ['name' => 'Basis Data', 'color' => '#10B981', 'description' => 'Database, SQL, NoSQL, dan lainnya'],
            ['name' => 'Algoritma', 'color' => '#F59E0B', 'description' => 'Algoritma dan struktur data'],
            ['name' => 'Mobile Development', 'color' => '#8B5CF6', 'description' => 'Android, iOS, Flutter, React Native'],
            ['name' => 'Machine Learning', 'color' => '#EC4899', 'description' => 'AI, ML, Deep Learning'],
            ['name' => 'Jaringan Komputer', 'color' => '#6366F1', 'description' => 'Networking, protokol, keamanan jaringan'],
            ['name' => 'Sistem Operasi', 'color' => '#14B8A6', 'description' => 'Windows, Linux, MacOS'],
            ['name' => 'Keamanan Siber', 'color' => '#EF4444', 'description' => 'Cybersecurity, penetration testing'],
            ['name' => 'Cloud Computing', 'color' => '#06B6D4', 'description' => 'AWS, Azure, Google Cloud'],
            ['name' => 'DevOps', 'color' => '#F97316', 'description' => 'CI/CD, Docker, Kubernetes'],
            ['name' => 'UI/UX Design', 'color' => '#A855F7', 'description' => 'Desain antarmuka dan pengalaman pengguna'],
            ['name' => 'Skripsi', 'color' => '#84CC16', 'description' => 'Diskusi seputar tugas akhir'],
            ['name' => 'Mata Kuliah', 'color' => '#64748B', 'description' => 'Diskusi mata kuliah umum'],
            ['name' => 'Organisasi', 'color' => '#0EA5E9', 'description' => 'Informasi organisasi kampus'],
            ['name' => 'Lainnya', 'color' => '#94A3B8', 'description' => 'Topik lainnya'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
