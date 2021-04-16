<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Notifications\SmsNotification;
use App\Notifications\LoginNotification;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'デバック用のコマンドです';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('start');

        $today = Carbon::today();
        $past = $today->copy()->subMonths(7);
        
        $begin = new DateTime($past);
        $end = new DateTime($today);

        echo $today;
        echo "\n";
        echo $past;
        echo "\n";
        // echo $begin;
        // echo "\n";
        // echo $end;


        $this->info('complete');
    }
}
