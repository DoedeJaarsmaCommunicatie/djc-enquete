<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateOptionCommand extends Command
{
    protected $signature = 'make:option';

    protected $description = 'Create a new option';

    public function handle(): void
    {
        $question = $this->ask('Voor welke vraag is dit antwoord? (ID)');

        if (!DB::table('questions')->where('id', '=', $question)->exists()) {
            $this->error('Vraag bestaat niet');
            exit;
        }

        $data = [
            'name'          => $this->ask('Antwoord'),
            'image'         => $this->ask('Afbeelding url'),
            'question_id'   => $question
        ];

        $this->line('Gegevens:');
        $this->info("Antwoord: {$data['name']}");
        $this->info("Vraag ID: {$question}");

        if (!$this->confirm('Zijn bovenstaande gegevens correct?',1)) {
            exit;
        }

        DB::table('options')->insert($data);
    }
}
