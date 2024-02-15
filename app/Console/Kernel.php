<?php

namespace App\Console;

use App\Models\BookBorrow;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {        
        $schedule->call(function () {
            $booksToReturn = BookBorrow::whereNull('checked_in_at')
                ->whereDate('return_date', '=', Carbon::today()->addDays(3)->toDateString())
                ->get();

            foreach($booksToReturn as $book) {
                // info(User::find($book->user_id));
                $user = User::find($book->user_id);
                $user->sendBookReturnReminder($book);
            }

        })->daily();


    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
