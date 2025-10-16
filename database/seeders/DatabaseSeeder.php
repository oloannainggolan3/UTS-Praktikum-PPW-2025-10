<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan semua seeder di sini.
     */
   public function run(): void
{
    $this->call(PollSeeder::class);
}
}
