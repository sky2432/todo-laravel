<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Todo_list;
use App\Models\Member;
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
        //期限を過ぎたら通知
        //期限の3時間前に通知
        $this->info('start');
        // Carbon::setTestNow(Carbon::parse('2021-04-01'));
        //完了しておらず、期日が設定されているリストを全件取得
        $items = Todo_list::where('status', 1)->whereNotNull('deadline')->get();
        $passedItems = [];
        //期日が過ぎているリストを取得
        foreach ($items as $item) {
            $now = new Carbon();
            $today = Carbon::create($now->year, $now->month, $now->day);
            $deadline = new Carbon($item->deadline);
            $todoDeadline = $deadline->addDays(1);
            if ($today->eq($todoDeadline)) {
                $passedItems[] = $item;
            };

            // echo $today;
            // echo "\n";

            // echo $todoDeadline;
            // echo "\n";

            // echo $deadline;
        };
        // foreach($passedItems as $passedItem) {
        //     echo $passedItem;
        //     echo "\n";
        // };

        //メール送信
        foreach ($passedItems as $passedItem) {
            $member = $passedItem->member;
            Mail::send(['text' => 'emails.RemindMail'], ['item' => $passedItem, 'member' => $member], function ($message) use ($member) {
                $message->to($member->email)
                ->from('todolist@test.com', 'Todoリスト')->subject('リマインドメール');
            });
        }
        $this->info('complete');
    }
}
