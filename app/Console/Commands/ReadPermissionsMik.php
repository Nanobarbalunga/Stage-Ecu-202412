<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Permission;

class ReadPermissionsMik extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mik:app:read-permissions
                            {id : ID dell\'utente}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restituisce i permessi (label, pretty_label, description) di un utente dato il suo nome o ID.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user_identifier = $this->argument('id');

        // Cerca l'utente per ID o nome
        $user = is_numeric($user_identifier)
            ? User::find($user_identifier)
            : User::where('name', $user_identifier)->first();

        if (!$user) {
            $this->error('Utente non trovato.');
            return Command::FAILURE;
        }

        $permissions = $user->permissions;

        if ($permissions->isEmpty()) {
            $this->info('L\'utente non ha permessi associati.');
            return Command::SUCCESS;
        }

        $this->info('Permessi dell\'utente: ' . $user->name);
        $this->table(
            ['Label', 'Pretty Label', 'Description'],
            $permissions->map(function ($permission) {
                return [
                    'Label' => $permission->label,
                    'Pretty Label' => $permission->pretty_label,
                    'Description' => $permission->description,
                ];
            })->toArray()
        );

        return Command::SUCCESS;
    
    }
}
