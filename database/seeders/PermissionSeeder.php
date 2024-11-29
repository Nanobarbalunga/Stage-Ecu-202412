<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Creare 10 utenti con permessi casuali associati
        User::factory(10)->create()->each(function ($user) {
            Permission::factory(3)->create([
                'user_id' => $user->id, // Associa 3 permessi per utente
            ]);
        });
    }
}
