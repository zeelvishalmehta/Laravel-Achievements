<?php

namespace App\Providers;

use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Events\AchievementUnlocked;
use App\Events\CommentUnlocked;
use App\Events\Badges;
use App\Events\NextBadges;
use App\Events\RemainingBadges;

use App\Listeners\UserLessonsWatched;
use App\Listeners\UserCommentWritten;
use App\Listeners\UserNextLessonWatched;
use App\Listeners\UserBadges;
use App\Listeners\UserNextCommentWritten;
use App\Listeners\UserNextBadges;
use App\Listeners\UserRemainingBadges;


use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        
        'App\Events\CommentWritten' => [
            'App\Listeners\UserCommentWritten',
        ], 
        'App\Events\LessonWatched' => [
            'App\Listeners\UserLessonsWatched',
        ],      
        'App\Events\AchievementUnlocked' => [
            'App\Listeners\UserNextLessonWatched',
        ],
        'App\Events\CommentUnlocked' => [
            'App\Listeners\UserNextCommentWritten',
        ],
        'App\Events\Badges' => [
            'App\Listeners\UserBadges',
        ],
        'App\Events\NextBadges' => [
            'App\Listeners\UserNextBadges',
        ],
        'App\Events\RemainingBadges' => [
            'App\Listeners\UserRemainingBadges',
        ],
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
      
    }
}
