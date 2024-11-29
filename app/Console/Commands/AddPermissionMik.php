<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Models\User;

class AddPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mik:app:add-permission  {user_id : ID dell\'utente}
                                                {label : Etichetta del permesso}
                                                {pretty_label : Versione leggibile}
                                                {description? : Descrizione opzionale}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggiungere un permesso';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user_id = $this->argument('user_id');
        $label = $this->argument('label');
        $pretty_label = $this->argument('pretty_label');
        $description = $this->argument('description');

        $user = User::find($user_id);

        if (!$user) {
            $this->error('Utente non trovato.');
            return Command::FAILURE;
        }

        $permission = $user->permissions()->create([
            'label' => $label,
            'pretty_label' => $pretty_label,
            'description' => $description,
        ]);

        $this->info('Permesso aggiunto con successo: ' . $permission->label);
        return Command::SUCCESS;

    }

}
