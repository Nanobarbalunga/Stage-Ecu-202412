<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteUserSm extends Command
{
    protected $signature = 'SM:user:delete 
                            {user_identifier : ID o nome dell\'utente da eliminare}';

    protected $description = 'Elimina un utente specifico dal sistema usando ID o nome';

    public function handle()
    {
        $userIdentifier = $this->argument('user_identifier');

        // Cerca l'utente per ID o nome
        $user = is_numeric($userIdentifier)
            ? User::find($userIdentifier)
            : User::where('name', 'like', "%{$userIdentifier}%")->first();

        if (!$user) {
            $this->error("Utente non trovato con identificativo '{$userIdentifier}'.");
            return 1;
        }

        // Conferma prima di eliminare
        if (!$this->confirm("Sei sicuro di voler eliminare l'utente '{$user->name}' (ID: {$user->id})?")) {
            $this->info('Operazione annullata.');
            return 0;
        }

        // Elimina l'utente e i relativi permessi
        $user->permissions()->delete(); // Elimina i permessi associati
        $user->delete();

        $this->info("Utente '{$user->name}' (ID: {$user->id}) eliminato con successo.");
        return 0;
    }
}
