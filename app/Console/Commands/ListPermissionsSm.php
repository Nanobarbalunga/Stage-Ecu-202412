<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Console\Command;

class ListPermissionsSm extends Command
{
    protected $signature = 'SM:permissions:list 
    {user_identifier? : ID o nome dell\'utente per mostrare i permessi} 
    {--all : Mostra tutti i permessi per tutti gli utenti}';

    protected $description = 'Mostra i permessi di un utente o tutti i permessi';

        public function handle()
    {
        $userIdentifier = $this->argument('user_identifier');
        $showAll = $this->option('all');

        // Se l'opzione --all è attiva, mostra tutti i permessi
        if ($showAll) {
            $permissions = Permission::with('user')->get();

            if ($permissions->isEmpty()) {
                $this->info('Nessun permesso trovato nel database.');
                return 0;
            }

            $this->info('Tutti i permessi nel database:');
            $this->table(
                ['Utente', 'ID Utente', 'Permesso', 'Etichetta', 'Descrizione'],
                $permissions->map(function ($permission) {
                    return [
                        $permission->user->name ?? 'Utente non disponibile',
                        $permission->user_id,
                        $permission->pretty_label,
                        $permission->label,
                        $permission->description,
                    ];
                })->toArray()
            );
            return 0;
        }

        // Se è specificato un user_identifier
        if ($userIdentifier) {
            // Cerca l'utente per ID o nome
            $user = is_numeric($userIdentifier)
                ? User::find($userIdentifier)
                : User::where('name', 'like', "%{$userIdentifier}%")->first();

            if (!$user) {
                $this->error("Utente non trovato con identificativo '{$userIdentifier}'.");
                return 1;
            }

            // Recupera i permessi dell'utente
            $permissions = $user->permissions;

            if ($permissions->isEmpty()) {
                $this->info("Nessun permesso trovato per l'utente '{$user->name}' (ID: {$user->id}).");
                return 0;
            }

            $this->info("Permessi per l'utente '{$user->name}' (ID: {$user->id}):");
            $this->table(
                ['Permesso', 'Etichetta', 'Descrizione'],
                $permissions->map(function ($permission) {
                    return [
                        $permission->pretty_label,
                        $permission->label,
                        $permission->description,
                    ];
                })->toArray()
            );
            return 0;
        }

        // Caso predefinito: né --all né user_identifier sono specificati
        $this->error('Devi specificare un identificativo utente (ID o nome) oppure usare l\'opzione --all.');
        return 1;
    }

}
