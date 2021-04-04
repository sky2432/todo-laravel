<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TodoList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendRemindMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send_remind_mail';

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

        //完了しておらず、期日が設定されているリストを全件取得
        $items = TodoList::where('status', 1)->whereNotNull('deadline')->get();
        $passedItems = [];
        //期日が過ぎているリストを取得
        foreach ($items as $item) {
            $now = new Carbon();
            $today = Carbon::create($now->year, $now->month, $now->day);
            $deadline = new Carbon($item->deadline);
            $todoDeadline = $deadline->addDays(1);
            if ($today >= $todoDeadline) {
                $passedItems[] = $item;
            };
        };
        $this->info('sending email now');

        //メール送信
        foreach ($passedItems as $passedItem) {
            $user = $passedItem->user;
            Mail::send(['text' => 'emails.remind-mail'], ['item' => $passedItem, 'user' => $user], function ($message) use ($user) {
                $message->to($user->email)
                ->from('todolist@test.com', 'Todoリスト')->subject('リマインドメール');
            });
        }
        
        $this->info('complete');
    }
}
