<?php

namespace App\Console\Commands;


use App\Models\Permission;
use App\Models\User;
use Illuminate\Console\Command;

class AddPermission extends Command
{
    protected $signature = 'SM:permission:add {user_id} {label} {pretty_label} {description?}';
    protected $description = 'Aggiunge un permesso a un utente';

    public function handle()
    {
        $userId = $this->argument('user_id');
        $label = $this->argument('label');
        $prettyLabel = $this->argument('pretty_label');
        $description = $this->argument('description') ?? '';

        $user = User::find($userId);

        if (!$user) {
            $this->error("Utente non trovato con ID {$userId}");
            return 1;
        }

        $permission = Permission::create([
            'user_id' => $user->id,
            'label' => $label,
            'pretty_label' => $prettyLabel,
            'description' => $description,
        ]);

        if (Permission::where('label', $label)->exists()) {
            $this->error("Il permesso con etichetta '{$label}' esiste già.");
            return 1;
        }

        $this->info("Permesso '{$prettyLabel}' aggiunto a utente ID {$userId}.");
        return 0;


    }


}
