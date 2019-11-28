<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateQuestionCommand extends Command
{
    protected $signature = 'make:question';

    protected $description = 'Create a new question';

    public function handle(): void
    {
        $data = [
            'name'      => $this->ask('Vraag naam'),
            'position'  => $this->ask('Positie? (nummer)')
        ];

        $this->line('Gegevens:');
        $this->info("Vraag naam: {$data['name']}");
        $this->info("Vraag positie: {$data['position']}");

        if (!$this->confirm('Zijn bovenstaande gegevens correct?',1)) {
            exit;
        }

        DB::table('questions')->insert($data);
    }
}
