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

        $noww = now();
        $now = Carbon::now();
        $today = Carbon::today();
        $past = $today->copy()->subMonths(6);

        echo $noww;
        echo "\n";
        echo $now;
        echo "\n";
        echo $today;
        echo "\n";
        echo $past;
        echo "\n";

        $this->info('complete');
    }
}
