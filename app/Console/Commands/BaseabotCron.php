<?php
namespace App\Console\Commands;

use App\Http\Controllers\TwitterController;
use App\Http\Controllers\WordController;
use Illuminate\Console\Command;

class BaseabotCron extends Command
{
    protected $signature = 'baseabot:cron';

    protected $description = 'Baseabot';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $twitter = new TwitterController();
        $words = new WordController();
        
        foreach($words->getWords() as $word){
            $this->log(0, "Palavra: $word");

            $list = $twitter->search($word)->statuses;

            foreach($list as $tweet){
                $this->log(1, "Tweet: $tweet->text");

                $id = $this->limpaId($tweet->id);
                
                $twitter->retweet($id);
            }
        }
    }

    private function limpaId($string){
        return preg_replace('/\D/', '', $string);
    }

    private function log($nivel, $msg){
        for($i = 0; $i < $nivel; $i++){
            echo "   "; 
        }
        
        echo "> $msg\r\n";
        // echo "> $msg<br>";
    }
}
