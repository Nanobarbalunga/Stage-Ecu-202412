<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class AddUser extends Command
{

    protected $signature = 'mik:app:add-user {name : Nome dell\'utente} 
                            {email : Email dell\'utente} 
                            {password : Password dell\'utente}';


    protected $description = 'Aggiunge un nuovo utente al sistema.';


    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        if(User::where('email', $email)->exists()){
            $this->error("Utente già esistente");
            return Command::FAILURE;
        }

         // Crea l'utente
         $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $this->info('Utente creato con successo: ' . $user->name . ' (' . $user->email . ')');
        return Command::SUCCESS;
    }
}
