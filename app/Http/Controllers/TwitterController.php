<?php
namespace App\Http\Controllers;

use Exception;
use Twitter;

class TwitterController
{
    public function tweet($text){
        return Twitter::postTweet([
            'status' => $text,
            'format' => 'json'
        ]);
    }

    public function search($word){
        return Twitter::getSearch([
            'q' => '" ' . $word . '" -filter:retweets',
            'lang' => 'pt'
        ]);
    }

    public function retweet($id){
        try{
            return Twitter::postRt($id);
        }
        catch (Exception $e)
        {
            return false;
        }
    }
}