<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;

class RemovePermission extends Command
{
    protected $signature = 'SM:permission:remove {permission_id}';
    protected $description = 'Rimuove un permesso specifico tramite ID';

    public function handle()
    {
        $permissionId = $this->argument('permission_id');
        $permission = Permission::find($permissionId);

        if (!$permission) {
            $this->error("Permesso non trovato con ID {$permissionId}");
            return 1;
        }

        $permission->delete();
        $this->info("Permesso ID {$permissionId} rimosso.");
        return 0;
    }
}
