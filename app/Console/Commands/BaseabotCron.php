<?php
namespace App\Console\Commands;

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
        return 0;
    }
}
