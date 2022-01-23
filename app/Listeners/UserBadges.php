<?php

namespace App\Listeners;

use DB;
use App\Events\Badges;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserBadges
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Badges  $event
     * @return void
     */
    public function handle(Badges $event)
    {
        $watched = $event->watched;
        $get_badges = DB::select('select * from badges ');
        foreach($get_badges as $badges)
        {
            $achiev = $badges->achiements;
            if($watched > $achiev)
            {
                $name = $badges->name;
            }
        }
        return $name;
    }
}
