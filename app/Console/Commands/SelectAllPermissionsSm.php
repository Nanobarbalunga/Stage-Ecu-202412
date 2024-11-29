<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;

class SelectAllPermissions extends Command
{
    protected $signature = 'SM:permissions:select_all';
    protected $description = 'Mostra tutti i permessi di tutti gli utenti nel sistema';

    public function handle()
    {
        $permissions = Permission::with('user')->get();

        if ($permissions->isEmpty()) {
            $this->info('Nessun permesso trovato nel database.');
            return 0;
        }

        $this->info('Tutti i permessi nel database:');

        // Mostrare i permessi come una tabella
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
}
