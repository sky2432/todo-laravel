<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\StatisticsService;
use App\Services\StatisticsCountService;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function day(Request $request)
    {
        $id = $request->id;
        $today = Carbon::today();
        $end = $today->copy()->endOfDay();//23:59:59.999999
        $begin = $today->copy()->subdays(6);

        $data = StatisticsService::day($id, $begin, $end);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function backDay(Request $request)
    {
        // $id = 2;
        // $date = new Carbon("2021-04-23");
        $id = $request->id;
        $date = new Carbon($request->data);
        $end = $date->copy()->subDay()->endOfDay();//例：2020-04-22 23:59:59.0
        $begin = $date->copy()->subdays(7);

        $data = StatisticsService::day($id, $begin, $end);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function forwardDay(Request $request)
    {
        // $id = 2;
        // $date = new Carbon("2021-04-22");
        $id = $request->id;
        $date = new Carbon($request->data);
        $begin = $date->copy()->addDay();
        $end = $begin->copy()->adddays(6)->endOfDay();

        $data = StatisticsService::day($id, $begin, $end);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function week(Request $request)
    {
        // $id = 2;
        $id = $request->id;
        $today = Carbon::today();
        $end = $today->copy()->endOfDay();
        $begin = $end->copy()->subweeks(6)->startOfWeek();

        $data = StatisticsService::week($id, $begin, $end);

        // dd($data);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function backWeek(Request $request)
    {
        // $id = 2;
        // $date = new Carbon("2021-03-15");
        $id = $request->id;
        $date = new Carbon($request->data);
        $end = $date->copy()->subDay()->endOfDay();
        $begin = $end->copy()->subWeeks(6)->startOfWeek();

        // dd($begin);

        $data = StatisticsService::week($id, $begin, $end);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function forwardWeek(Request $request)
    {
        $id = $request->id;
        $date = new Carbon($request->data);
        // $id = 2;
        // $date = new Carbon("2021-03-08");

        $begin = $date->copy()->addWeek();
        $end = $begin->copy()->addWeeks(7)->subDay()->endOfDay();

        $data = StatisticsService::week($id, $begin, $end);

        // dd($data);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function month(Request $request)
    {
        // $id = 2;
        $id = $request->id;
        $today = Carbon::today();
        $end = $today->copy()->endOfDay();
        $begin = $today->copy()->subMonths(6)->day(1);

        $data = StatisticsService::month($id, $begin, $end);

        // dd($begin);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function backMonth(Request $request)
    {
        // $id = 2;
        // $date = new Carbon("2020-10");

        $id = $request->id;
        $date = new Carbon($request->data);//例: 2020-10
        $end = $date->copy()->subDay()->endOfDay();//例: 2020-9-30
        $begin = $date->copy()->subMonths(7);//例: 2020-3

        $data = StatisticsService::month($id, $begin, $end);

        // dd($data);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function forwardMonth(Request $request)
    {
        $id = $request->id;
        $date = new Carbon($request->data);//例: 2020-9
        $begin = $date->copy()->addMonth();//例: 2020-10-01
        $end = $begin->copy()->addMonths(7)->subDay()->endOfDay();//例: 2021-04-03 23:59:59.999999

        $data = StatisticsService::month($id, $begin, $end);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function allCountData(Request $request)
    {
        $id = $request->id;
        $data = [];

        $count = new StatisticsCountService;
        $data[] = $count->countDay($id);
        $data[] = $count->countAll($id);
        $data[] = $count->countMonth($id);
        $data[] = $count->averageDay($id);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function doneDate(Request $request)
    {
        $id = $request->id;

        $data = TodoList::where('user_id', $id)
        ->select(DB::raw('DATE_FORMAT(done_at, "%Y-%m-%d") as day'))
        ->groupBy('day')
        ->get();

        foreach ($data as $val) {
            $dbData[] = $val->day;
        }

        return response()->json([
            'data' => $dbData,
        ]);
    }

    public function continuous(Request $request)
    {
        $id = $request->id;
        $startDate = User::where('id', $id)->value('created_at');
        $begin = Carbon::create($startDate->year, $startDate->month, $startDate->day);

        $today = Carbon::today();
        $end = $today->copy()->endOfDay();

        $data = StatisticsService::day($id, $begin, $end);

        [$count, $highestCount] = StatisticsCountService::countContinuous($data);

        return response()->json([
            'current' => $count,
            'highest' => $highestCount,
        ]);
    }
}
