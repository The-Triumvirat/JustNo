<?php

namespace Database\Seeders;

use App\Models\NoReason;
use Illuminate\Database\Seeder;

class NoReasonSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'No. Absolutely not.',
            'My calendar has a strict no policy today.',
            'That sounds like a problem for tomorrow.',
            'I have already reached my daily quota of enthusiasm.',
            'My future self asked me to decline.',
            'The answer is no, but thank you for asking.',
            'I am keeping that time for doing nothing.',
            'That is outside my carefully limited capabilities.',
            'I would rather not turn this into a recurring commitment.',
            'A polite no is better than an unreliable yes.',
        ] as $reason) {
            NoReason::firstOrCreate(['reason' => $reason]);
        }
    }
}
