<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Permission;

class ListPermessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mik:app:list-permessions
                            {user_id? : ID dell\'utente per filtrare i permessi (opzionale)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mostra la lista dei permessi.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user_id = $this->argument('user_id');

        if ($user_id) {
            // Se è specificato un ID utente, filtriamo i permessi
            $user = User::find($user_id);

            if (!$user) {
                $this->error('Utente non trovato.');
                return Command::FAILURE;
            }

            $permissions = $user->permissions;

            if ($permissions->isEmpty()) {
                $this->info('Nessun permesso trovato per l\'utente: ' . $user->name);
                return Command::SUCCESS;
            }

            $this->info('Permessi dell\'utente: ' . $user->name);
        } else {
            // Se non è specificato un ID utente, mostriamo tutti i permessi
            $permissions = Permission::all();

            if ($permissions->isEmpty()) {
                $this->info('Nessun permesso trovato nel sistema.');
                return Command::SUCCESS;
            }

            $this->info('Lista di tutti i permessi:');
        }

        // Mostra i permessi in una tabella
        $this->table(
            ['ID', 'User ID', 'Label', 'Pretty Label', 'Description'],
            $permissions->map(function ($permission) {
                return [
                    'ID' => $permission->id,
                    'User ID' => $permission->user_id,
                    'Label' => $permission->label,
                    'Pretty Label' => $permission->pretty_label,
                    'Description' => $permission->description,
                ];
            })->toArray()
        );

        return Command::SUCCESS;
    }
}
