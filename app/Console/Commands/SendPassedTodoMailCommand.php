<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TodoList;
use Carbon\Carbon;
use App\Notifications\PassedNotification;

class SendPassedTodoMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:passed_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '期限超過メールを送ります';

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

        //完了しておらず、期日が設定されているリストを全件取得
        $items = TodoList::where('status', 1)->whereNotNull('deadline')->get();
        $passedItems = [];
        //期日が過ぎているリストを取得
        foreach ($items as $item) {
            $today = Carbon::now()->format('Y-m-d 00:00:00');
            $deadline = new Carbon($item->deadline);
            $todoDeadline = $deadline->addDays(1);
            if ($today >= $todoDeadline) {
                $passedItems[] = $item;
            };
        };

        // メール送信
        foreach ($passedItems as $passedItem) {
            $this->info('sending email now');
            $user = $passedItem->user;
            $user->notify(new PassedNotification($passedItem));
        }
        
        $this->info('complete');
    }
}
