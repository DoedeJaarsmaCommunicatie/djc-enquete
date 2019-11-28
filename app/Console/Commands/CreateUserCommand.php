<?php

namespace App\Console\Commands;

use Ramsey\Uuid\Uuid;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateUserCommand extends Command
{
    protected $signature = 'make:user';

    protected $description = 'Create a new user record';

    public function handle(): void
    {
        try {
            $uuid = Uuid::uuid4()->toString();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            exit(1);
        }

        $data = [
            'firstName' => $this->ask('Voornaam?'),
            'lastName'  => $this->ask('Achternaam?'),
            'email'     => $this->ask('E-mail?'),
            'address'   => $this->ask('Adres?'),
            'uuid'      => $uuid,
        ];

        $this->line('Gegevens:');
        $this->info("Voornaam: {$data['firstName']}");
        $this->info("Achternaam: {$data['lastName']}");
        $this->info("E-mail: {$data['email']}");
        $this->info("Adres: {$data['address']}");
        $this->info("ID: {$data['uuid']}");

        if (!$this->confirm('Zijn bovenstaande gegevens correct?', 1)) {
            exit;
        }

        DB::table('users')->insert($data);
    }
}
