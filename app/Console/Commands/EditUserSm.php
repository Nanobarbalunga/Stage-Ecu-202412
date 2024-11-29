<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class EditUser extends Command
{
    protected $signature = 'SM:user:edit 
                            {user_identifier : ID o nome dell\'utente da modificare} 
                            {--name= : Modifica il nome dell\'utente} 
                            {--email= : Modifica l\'email dell\'utente} 
                            {--password= : Modifica la password dell\'utente}';

    protected $description = 'Modifica i dati di un utente (nome, email, password)';

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

        $this->info("Modifica i dati dell'utente '{$user->name}' (ID: {$user->id}).");

        // Recupera i dati dalle opzioni
        $name = $this->option('name');
        $email = $this->option('email');
        $password = $this->option('password');

        // Aggiorna solo i campi forniti
        $updated = false;
        if ($name) {
            $user->name = $name;
            $updated = true;
        }

        if ($email) {
            // Controlla che l'email non sia già usata
            if (User::where('email', $email)->where('id', '!=', $user->id)->exists()) {
                $this->error("L'email '{$email}' è già in uso da un altro utente.");
                return 1;
            }
            $user->email = $email;
            $updated = true;
        }

        if ($password) {
            $user->password = bcrypt($password);
            $updated = true;
        }

        if ($updated) {
            $user->save();
            $this->info("Dati dell'utente aggiornati con successo!");
            $this->line("Nome: {$user->name}");
            $this->line("Email: {$user->email}");
        } else {
            $this->info("Nessun campo aggiornato. Specifica almeno un'opzione (--name, --email, --password).");
        }

        return 0;
    }
}
