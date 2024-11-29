<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Permission;
use App\Models\User;

class RemovePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mik:app:remove-permission {user_id : ID dell\'utente}
                            {label : Etichetta del permesso da rimuovere}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user_id = $this->argument('user_id');
        $label = $this->argument('label');

        $user = User::find($user_id);

        if (!$user) {
            $this->error('Utente non trovato.');
            return Command::FAILURE;
        }

        $permission = $user->permissions()->where('label', $label)->first();

        if (!$permission) {
            $this->error('Permesso non trovato.');
            return Command::FAILURE;
        }

        $permission->delete();
        $this->info('Permesso rimosso con successo: ' . $label);
        return Command::SUCCESS;
    }
}
