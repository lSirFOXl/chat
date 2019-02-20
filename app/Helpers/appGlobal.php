<?php
namespace App\Helpers;

use DB;

class appGlobal
{
    public static function bladeHelper($someValue)
    {
        return "increment $someValue";
    }

    public static function getChatsWithUser($mainUserId){
        $chats = DB::table('messages')
                        ->select('sender', 'recipient', DB::raw('count(*) as msgCount, sum(case when checked = false then 1 else 0 end) uncheckedCount , max(created_at) as lastmsg'))
                        ->where([
                            ['recipient', '=', $mainUserId]])
                        ->orWhere([
                            ['sender', '=', $mainUserId]])
                        ->groupBy('sender', 'recipient')->orderBy('lastmsg', 'desc')->get();
                        
                        //print_r($chats);
                        //print_r($chats2);
                        //print_r($chats3);
                    
        $usingid = array();
        $newChats = array();
        $userID = $mainUserId;
        foreach ($chats as $key => $value) {
            $canUse = TRUE;
            foreach ($usingid as $key2 => $value2) {
                if($value->sender != $userID && $value2 == $value->sender){
                    $canUse = false;
                }
                elseif($value->recipient != $userID && $value2 == $value->recipient){
                    $canUse = false;
                } 
            }
            if($canUse){
                 $newChats[] = $value;
                if($value->sender != $userID){
                    $usingid[] = $value->sender;
                }
                elseif($value->recipient != $userID){
                                $usingid[] = $value->recipient;
                } 
            }
        }
        return $newChats;
    }
}