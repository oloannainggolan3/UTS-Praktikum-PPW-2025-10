<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poll;
use App\Models\Option;

class PollSeeder extends Seeder
{
    public function run(): void
    {
        // Buat polling pertama
        $poll = Poll::create(['question' => 'Siapa Presiden Favoritmu?']);

        // Tambah opsi
        $options = ['Jokowi', 'Prabowo', 'Ganjar', 'Anies'];
        foreach ($options as $opt) {
            Option::create([
                'poll_id' => $poll->id,
                'option_text' => $opt,
                'votes' => 0
            ]);
        }
    }
}
