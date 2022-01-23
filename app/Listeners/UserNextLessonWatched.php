<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Events\StatementPrepared;

class UserNextLessonWatched
{
    public $lid;
    public $next_title;

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
     * @param  \App\Events\AchievementUnlocked  $event
     * @return void
     */
    public function handle(AchievementUnlocked $event)
    {
        $user = $event->user;

        $query_current_lessons = DB::select('SELECT l.id FROM `lesson_user` as u, lessons as l WHERE u.`lesson_id` = l.id and u.`user_id` = '.$user.' ');
        foreach($query_current_lessons as $lesson_id)
        {
            $lid = $lesson_id->id;
        }
       
        //find next achievements
        if(isset($lid)){
            $query_next_lessons = DB::select('SELECT `title` FROM `lessons` WHERE `id` > '.$lid.' order by id asc LIMIT 0,1 ');
            foreach($query_next_lessons as $nextlesson)
            {
                $next_title = $nextlesson->title;
            }
        }
        if(isset($next_title)){
        return $next_title;}
    }
}
