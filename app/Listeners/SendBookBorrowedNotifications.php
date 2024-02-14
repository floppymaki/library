<?php

namespace App\Listeners;

use App\Events\BookBorrowed;
use App\Models\User;
use App\Notifications\BorrowsBook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBookBorrowedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookBorrowed $event): void
    {
        // dd(User::find($event->borrow->user_id));
        User::find($event->borrow->user_id)->notify(new BorrowsBook($event->borrow));
    }
}
