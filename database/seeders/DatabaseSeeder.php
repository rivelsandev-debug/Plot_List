<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Novel;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== AKUN ADMIN =====
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // ===== AKUN USER BIASA =====
        User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );

        // ===== NOVEL JEPANG (Light Novel & Novel) =====
        $novels = [
            [
                'title' => 'Overlord 1: The Undead King',
                'author' => 'Kugane Maruyama',
                'genre' => 'Fantasy,Horror,Isekai',
                'release_date' => '2012-07-30',
                'description' => 'Suzuki Satoru (Momonga) terjebak di dunia game YGGDRASIL setelah server ditutup. Sebagai Ainz Ooal Gown, ia memimpin Great Tomb of Nazarick dan berusaha menguasai dunia baru sambil mengungkap misteri di balik perpindahannya.',
                'cover_image' => null,
                'price' => 75000,
                'rating' => 4.8,
                'file_path' => null,
            ],
            [
                'title' => 'Re:Zero - Starting Life in Another World',
                'author' => 'Tappei Nagatsuki',
                'genre' => 'Fantasy,Isekai,Drama',
                'release_date' => '2014-01-24',
                'description' => 'Natsuki Subaru tiba-tiba dipindahkan ke dunia lain dan memperoleh kemampuan kembali ke masa lalu setiap kali ia meninggal. Ia harus menghadapi berbagai tragedi demi melindungi orang-orang yang ia sayangi.',
                'cover_image' => null,
                'price' => 69000,
                'rating' => 4.9,
                'file_path' => null,
            ],
            [
                'title' => 'Sword Art Online',
                'author' => 'Reki Kawahara',
                'genre' => 'Action,Fantasy,Romance',
                'release_date' => '2009-04-10',
                'description' => 'Kirito terjebak dalam game virtual Sword Art Online, di mana kematian di dalam game berarti kematian di dunia nyata. Ia berjuang menyelesaikan permainan demi kebebasan seluruh pemain.',
                'cover_image' => null,
                'price' => 72000,
                'rating' => 4.7,
                'file_path' => null,
            ],
            [
                'title' => 'No Game No Life',
                'author' => 'Yuu Kamiya',
                'genre' => 'Fantasy,Isekai,Shounen',
                'release_date' => '2012-04-25',
                'description' => 'Sora dan Shiro, kakak beradik jenius dalam permainan, dipanggil ke dunia yang seluruh konfliknya diselesaikan melalui permainan. Mereka bercita-cita mengalahkan dewa dunia tersebut.',
                'cover_image' => null,
                'price' => 70000,
                'rating' => 4.6,
                'file_path' => null,
            ],
            [
                'title' => 'The Rising of the Shield Hero',
                'author' => 'Aneko Yusagi',
                'genre' => 'Action,Fantasy,Isekai',
                'release_date' => '2013-08-22',
                'description' => 'Naofumi dipanggil sebagai Pahlawan Perisai, namun difitnah dan dijauhi. Ia memulai perjalanan untuk membuktikan dirinya sambil melindungi dunia dari gelombang kehancuran.',
                'cover_image' => null,
                'price' => 73000,
                'rating' => 4.7,
                'file_path' => null,
            ],
            [
                'title' => 'Another',
                'author' => 'Yukito Ayatsuji',
                'genre' => 'Horror,Mystery,Supernatural',
                'release_date' => '2009-10-29',
                'description' => 'Koichi Sakakibara memasuki kelas yang diselimuti kutukan misterius. Bersama Mei Misaki, ia berusaha mengungkap rahasia yang menyebabkan serangkaian kematian mengerikan.',
                'cover_image' => null,
                'price' => 68000,
                'rating' => 4.5,
                'file_path' => null,
            ],
            [
                'title' => 'Your Name',
                'author' => 'Makoto Shinkai',
                'genre' => 'Drama,Romance,Supernatural',
                'release_date' => '2016-06-18',
                'description' => 'Mitsuha dan Taki mengalami pertukaran tubuh secara misterius. Hubungan mereka berkembang saat berusaha menemukan satu sama lain dan mengubah takdir.',
                'cover_image' => null,
                'price' => 76000,
                'rating' => 4.9,
                'file_path' => null,
            ],
            [
                'title' => 'The Garden of Words',
                'author' => 'Makoto Shinkai',
                'genre' => 'Drama,Romance,Slice of Life',
                'release_date' => '2013-05-31',
                'description' => 'Seorang siswa yang bercita-cita menjadi pembuat sepatu bertemu wanita misterius di taman saat hujan. Pertemuan mereka perlahan mengubah kehidupan keduanya.',
                'cover_image' => null,
                'price' => 65000,
                'rating' => 4.6,
                'file_path' => null,
            ],
            [
                'title' => 'The Melancholy of Haruhi Suzumiya',
                'author' => 'Nagaru Tanigawa',
                'genre' => 'Mystery,Supernatural,Shounen',
                'release_date' => '2003-06-06',
                'description' => 'Kyon bergabung dengan klub yang dipimpin Haruhi Suzumiya, tanpa menyadari bahwa Haruhi memiliki kekuatan luar biasa yang mampu mengubah realitas.',
                'cover_image' => null,
                'price' => 71000,
                'rating' => 4.5,
                'file_path' => null,
            ],
            [
                'title' => 'Spice and Wolf',
                'author' => 'Isuna Hasekura',
                'genre' => 'Fantasy,Romance,Drama',
                'release_date' => '2006-02-10',
                'description' => 'Lawrence, seorang pedagang keliling, bertemu Holo sang dewi serigala. Bersama-sama mereka melakukan perjalanan penuh petualangan, perdagangan, dan kisah romansa.',
                'cover_image' => null,
                'price' => 74000,
                'rating' => 4.8,
                'file_path' => null,
            ],
        ];

        // Insert — firstOrCreate agar tidak duplikat jika dijalankan ulang
        foreach ($novels as $novel) {
            Novel::firstOrCreate(
                ['title' => $novel['title'], 'author' => $novel['author']],
                $novel
            );
        }
    }
}