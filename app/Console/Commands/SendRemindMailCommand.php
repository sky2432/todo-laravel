<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TodoList;
use Carbon\Carbon;
use App\Notifications\RemindNotification;

class SendRemindMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:remind_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'リマインドメールを送ります';

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

        // Carbon::setTestNow('2021-04-17 12:00:00');

        $now = Carbon::now()->format('Y-m-d H:i:00');

        $items = TodoList::where('status', 1)->whereNotNull('remind_day')->get();
        foreach ($items as $item) {
            $remind = new Carbon($item->deadline . $item->remind_time);
            if ($item->remind_day === 0) {
                if ($remind->eq($now)) {
                    $this->info('sending email now');

                    $user = $item->user;
                    $user->notify(new RemindNotification($item));
                }
            }
            if ($item->remind_day === 1) {
                $remind->subDay();
                if ($remind->eq($now)) {
                    $this->info('sending email now');

                    $user = $item->user;
                    $user->notify(new RemindNotification($item));
                }
            }
            if ($item->remind_day === 2) {
                $remind->subDays(2);
                if ($remind->eq($now)) {
                    $this->info('sending email now');

                    $user = $item->user;
                    $user->notify(new RemindNotification($item));
                }
            }
        }

        $this->info('complete');
    }
}
