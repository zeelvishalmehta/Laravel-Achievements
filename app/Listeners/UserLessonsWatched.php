<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Events\StatementPrepared;

class UserLessonsWatched
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
     * @param  \App\Events\LessonWatched  $event
     * @return void
     */
    public function handle(LessonWatched $event)
    {
        $user = $event->user;
        $lesson = $event->lesson;
        
        $query_lessons = DB::select('SELECT title FROM  lessons  WHERE id = '.$lesson.'  ');
        foreach ($query_lessons as $query_lesson)
        {
            $title = $query_lesson->title;
        }
       return $title;
        
    }
}
