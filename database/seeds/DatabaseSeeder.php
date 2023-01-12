<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 1
        ]);
        DB::table('category')->insert([
            'name' => 'Category 1',
        ]);
        DB::table('category')->insert([
            'name' => 'Category 2',
        ]);

        // DB::table('settings')->insert([
        //     'name' => 'background',
        //     'title' => 'Background',
        //     'text' => 'https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/rm309-adj-01.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=2204002a48c0d2dc60c1a27a4cc4fd97'
        // ]);

        // DB::table('settings')->insert([
        //     'name' => 'color_primary',
        //     'title' => 'Warna Primer',
        //     'text' => '#08044C'
        // ]);

        // DB::table('settings')->insert([
        //     'name' => 'color_secondary',
        //     'title' => 'Warna Sekunder',
        //     'text' => '#F78009'
        // ]);

        DB::table('settings')->insert([
            'name' => 'judul',
            'title' => 'Judul',
            'text' => 'PASAR NUSANTARA'
        ]);

        DB::table('settings')->insert([
            'name' => 'sub_judul',
            'title' => 'Sub Judul',
            'text' => 'SOLUSI MASALAH ANDA'
        ]);

        DB::table('settings')->insert([
            'name' => 'email',
            'title' => 'Email',
            'text' => 'email@gmail.com'
        ]);

        DB::table('settings')->insert([
            'name' => 'alamat',
            'title' => 'Alamat',
            'text' => 'Jauh Disana'
        ]);

        // DB::table('settings')->insert([
        //     'name' => 'navbar_kanan',
        //     'title' => 'Keterangan Navbar Kanan',
        //     'text' => 'Selamat berbelanja, Shopper!'
        // ]);

        DB::table('settings')->insert([
            'name' => 'facebook',
            'title' => 'Link Facebook',
            'text' => 'https://www.facebook.com/'
        ]);

        DB::table('settings')->insert([
            'name' => 'instagram',
            'title' => 'Link Instagram',
            'text' => 'https://www.instagram.com/'
        ]);

        DB::table('settings')->insert([
            'name' => 'gmail',
            'title' => 'Link Gmail',
            'text' => 'https://www.gmail.com/'
        ]);

        DB::table('settings')->insert([
            'name' => 'youtube',
            'title' => 'Link Youtube',
            'text' => 'https://www.youtube.com/'
        ]);

        DB::table('settings')->insert([
            'name' => 'whatsapp',
            'title' => 'No WhatsApp',
            'text' => '085702202129'
        ]);

        DB::table('settings')->insert([
            'name' => 'footer',
            'title' => 'Footer',
            'text' => 'Dibuat Oleh Pasar Nusantara'
        ]);

        DB::table('settings')->insert([
            'name' => 'about_us',
            'title' => 'About Us',
            'text' => 'Tentang Anda'
        ]);

        DB::table('settings')->insert([
            'name' => 'cara_order',
            'title' => 'Cara Order',
            'text' => 'Cara Order'
        ]);
    }
}
