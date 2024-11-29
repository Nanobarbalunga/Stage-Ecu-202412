<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        \App\Console\Commands\SelectAllPermissionsSm::class,
         \App\Console\Commands\CreateUserSm::class,
         \App\Console\Commands\DeleteUserSm::class,
         \App\Console\Commands\EditUserSm::class,
         \App\Console\Commands\ListPermessionsMik::class,
         \App\Console\Commands\AddUserMik::class,
    ];


    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
