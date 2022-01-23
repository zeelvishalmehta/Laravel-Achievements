<?php

namespace App\Listeners;

use DB;
use App\Events\RemainingBadges;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserRemainingBadges
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
     * @param  \App\Events\RemainingBadges  $event
     * @return void
     */
    public function handle(RemainingBadges $event)
    {
        $watched = $event->watched;
        $get_badges = DB::select('select * from badges ');
        foreach($get_badges as $badges)
        {
            $achiev = $badges->achiements;
            if($watched > $achiev)
            {
               $id = $badges->id;
            }
        }
        //get next badges
        $get_next_badges = DB::select('select achiements from badges where id > '.$id.' order by id asc limit 0,1 ');
        foreach($get_next_badges as $next_badges)
        {
            $achiements = $next_badges->achiements;
        }
        $remaining_badges = $achiements - $watched; 
        return $remaining_badges;
    }
}
