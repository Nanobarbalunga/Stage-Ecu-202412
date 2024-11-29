<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    protected $signature = 'SM:user:create 
                            {name : Il nome completo dell\'utente}
                            {email : L\'email dell\'utente}
                            {password : La password dell\'utente}';
    
    protected $description = 'Crea un nuovo utente con nome, email e password specificati';

    public function handle()
    {
        // Recupera i dati dal comando
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Controlla se l'email esiste già
        if (User::where('email', $email)->exists()) {
            $this->error("L'email {$email} è già in uso. Usa un'altra email.");
            return 1;
        }

        // Crea l'utente
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password), // Cripta la password
        ]);

        $this->info("Utente creato con successo!");
        $this->line("ID: {$user->id}");
        $this->line("Nome: {$user->name}");
        $this->line("Email: {$user->email}");

        return 0;
    }
}
