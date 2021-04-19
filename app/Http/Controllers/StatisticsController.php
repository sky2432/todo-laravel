<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\StatisticsService;
use Illuminate\Support\Facades\DB;


class StatisticsController extends Controller
{
    public function day(Request $request)
    {
        $id = $request->id;
        $dbEnd = Carbon::today();
        $rangeEnd = $dbEnd->copy()->addDay();
        $begin = $dbEnd->copy()->subdays(6);

        $data = StatisticsService::day($id, $begin, $rangeEnd, $dbEnd);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function backDay(Request $request)
    {
        $id = $request->id;
        $rangeEnd = new Carbon($request->data);
        $dbEnd = $rangeEnd->copy()->subDay();
        $begin = $dbEnd->copy()->subdays(6);

        $data = StatisticsService::day($id, $begin, $rangeEnd, $dbEnd);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function forwardDay(Request $request)
    {
        $id = $request->id;
        $specificDay = new Carbon($request->data);
        $begin = $specificDay->copy()->addDay();
        $dbEnd = $begin->copy()->adddays(6);
        $rangeEnd = $dbEnd->copy()->addDay();

        $data = StatisticsService::day($id, $begin, $rangeEnd, $dbEnd);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function week(Request $request)
    {
        $id = $request->id;
        $dbEnd = Carbon::today();
        $rangeEnd = $dbEnd->copy()->addDay();
        $begin = $dbEnd->copy()->subweeks(6)->startOfWeek();

        $data = StatisticsService::week($id, $begin, $rangeEnd, $dbEnd);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function backWeek(Request $request)
    {
        $id = $request->id;
        $rangeEnd = new Carbon($request->data);
        $dbEnd = $rangeEnd->copy()->subDay();
        $begin = $dbEnd->copy()->subWeeks(6)->startOfWeek();

        $data = StatisticsService::week($id, $begin, $rangeEnd, $dbEnd);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function forwardWeek(Request $request)
    {
        $id = $request->id;
        $specificDay = new Carbon($request->data);
        $begin = $specificDay->copy()->addWeek();
        $rangeEnd = $begin->copy()->addWeeks(7);
        $dbEnd = $rangeEnd->copy()->subDay();

        $data = StatisticsService::week($id, $begin, $rangeEnd, $dbEnd);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function month(Request $request)
    {
        $id = $request->id;
        $dbEnd = Carbon::today();
        $rangeEnd = $dbEnd->copy()->addDay();
        $begin = $dbEnd->copy()->subMonths(6)->day(1);

        $data = StatisticsService::month($id, $begin, $rangeEnd, $dbEnd);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function backMonth(Request $request)
    {
        $id = $request->id;
        $rangeEnd = new Carbon($request->data);//例: 2020-10
        $dbEnd = $rangeEnd->copy()->subDay();//例: 2020-9-30
        $begin = $rangeEnd->copy()->subMonths(7);//例: 2020-3

        $data = StatisticsService::month($id, $begin, $rangeEnd, $dbEnd);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function forwardMonth(Request $request)
    {
        $id = $request->id;
        $specificDay = new Carbon($request->data);//例: 2020-9
        $begin = $specificDay->copy()->addMonth();//例: 2020-10
        $rangeEnd = $begin->copy()->addMonths(7);//例: 2021-5
        $dbEnd = $rangeEnd->copy()->subDay();//例: 2021-4-30

        $data = StatisticsService::month($id, $begin, $rangeEnd, $dbEnd);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function countAll(Request $request)
    {
        $id = $request->id;
        $data = TodoList::where('user_id', $id)
        ->whereNotNull('done_at')
        ->count();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function countDay(Request $request)
    {
        $now = Carbon::today();
        
        $id = $request->id;
        $data = TodoList::where('user_id', $id)
        ->whereDate('done_at', $now)
        ->count();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function countMonth(Request $request)
    {
        $now = Carbon::today();
        
        $id = $request->id;
        $data = TodoList::where('user_id', $id)
        ->whereYear('done_at', $now->year)
        ->whereMonth('done_at', $now->month)
        ->count();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function avarageDay(Request $request)
    {
        $begin = User::find(2)->value('created_at');
        $now = Carbon::today();

        $allDay = $now->copy()->diffInDays($begin) + 1;
        
        $id = $request->id;
        $data = TodoList::where('user_id', $id)
        ->whereNotNull('done_at')
        ->count();

        $avg = round($data / $allDay);


        return response()->json([
            'data' => $avg,
        ]);
    }
    
}
