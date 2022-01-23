<?php

namespace App\Listeners;

use DB;
use App\Events\NextBadges;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserNextBadges
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
     * @param  \App\Events\NextBadges  $event
     * @return void
     */
    public function handle(NextBadges $event)
    {
        $watched = $event->watched;
        $get_badges = DB::select('select * from badges ');
        foreach($get_badges as $badges)
        {
            $achiev = $badges->achiements;
            if($watched > $achiev)
            {
                $name = $badges->name;
                $id = $badges->id;
            }
        }
        //get next badges
        $get_next_badges = DB::select('select name from badges where id > '.$id.' order by id asc limit 0,1 ');
        foreach($get_next_badges as $next_badges)
        {
            $name = $next_badges->name;
        }
        return $name;
    }
}
