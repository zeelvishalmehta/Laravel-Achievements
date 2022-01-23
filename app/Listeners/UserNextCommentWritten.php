<?php

namespace App\Listeners;

use DB;
use App\Events\CommentUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserNextCommentWritten
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CommentUnlocked  $event
     * @return void
     */
    public function handle(CommentUnlocked $event)
    {
        $comment = $event->comment;
        $next_comment = DB::select('SELECT `body` FROM `comments` WHERE id > '.$comment.' order by id ASC limit 0,1');
        foreach($next_comment as $comment)
        {
            $comment = $comment->body;
        }
        return $comment;
    }  
}
