<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Events\AchievementUnlocked;
use App\Events\CommentUnlocked;
use App\Events\Badges;
use App\Events\NextBadges;
use App\Events\RemainingBadges;

class AchievementsController extends Controller
{
    public $lesson;
    public $comment;
    public $watched;
    public $result_lesson;
    public $result_comment;
    public $result_next_lesson;

    public function index(User $user)
    {
        $user = $user->id;

        //check user exist or not
        $get_user = DB::select('SELECT count(*) as total FROM `users` WHERE id = '.$user.' ');
        foreach($get_user as $singleuser)
        {
            $total = $singleuser->total;
        }
        
        if($total > 0){

            //get lesson id
            $query_lessons = DB::select('SELECT l.id, u.watched FROM `lesson_user` as u, lessons as l WHERE u.`lesson_id` = l.id and u.`user_id` = '.$user.' ');
            foreach ($query_lessons as $query_lesson)
            {
                $lesson = $query_lesson->id;
                $watched = $query_lesson->watched;
            }

            //get comment
            $query_comments = DB::select('SELECT comment_id FROM `comment_user` WHERE `user_id` = '.$user.' ');
            foreach($query_comments as $query_comment)
            {
                $comment = $query_comment->comment_id;
            }

            //call event get current achievments and comments
            if(isset($lesson))
            {
              $result_lesson = event(new LessonWatched($lesson,$user));
            }
            if(isset($comment))
            {
             $result_comment = event(new CommentWritten($comment));
            }
            //call event get next achievements and comments
            $result_next_lesson = event(new AchievementUnlocked($user));

            if(isset($comment))
            {
             $result_next_comment = event(new CommentUnlocked($comment));
            }
            //call event to get badges
            if(isset($watched))
            {
                $result_badges = event(new Badges($watched));
            
                //call event get next badges
                $result_next_badges = event(new NextBadges($watched));

                //call event get remaining badges
                $result_remaining_badges = event(new RemainingBadges($watched));
            }
            return response()->json([
                'unlocked_achievements' => [array_filter($result_lesson),array_filter($result_comment)],
                'next_available_achievements' => [array_filter($result_next_lesson),array_filter($result_next_comment)],
                'current_badge' => array_filter($result_badges),
                'next_badge' => array_filter($result_next_badges),
                'remaing_to_unlock_next_badge' => $result_remaining_badges
            ]);
        }
    
    }
}
