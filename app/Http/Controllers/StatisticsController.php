<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateInterval;
use DatePeriod;

class StatisticsController extends Controller
{
    public function day(Request $request)
    {
        $now = Carbon::today();
        $end = $now->copy()->modify('+1 day');
        $begin = $now->copy()->subdays(6);

        $period = new DatePeriod($begin, new DateInterval('P1D'), $end);
        $dbData = [];
 
        foreach ($period as $date) {
            $range[$date->format("Y-m-d")] = 0;
        }

        $data = TodoList::where('user_id', $request->id)
        ->whereBetween('done_at', [$begin, $end])
        ->select(DB::raw('DATE_FORMAT(done_at, "%Y-%m-%d") as date'), DB::raw('count(done_at) as count'))
        ->groupBy('date')
        ->get();

        foreach ($data as $val) {
            $dbData[$val->date] = $val->count;
        }

        $data = array_replace($range, $dbData);

        return response()->json([
            'data' => $data,
        ]);
       
    }

    public function month(Request $request)
    {
        $now = Carbon::now();
        // $now = Carbon::today();
        // $end = $now->copy()->modify('+1 day');
        $begin = $now->copy()->subMonths(6)->day(1);
        // $begin->day(1);
        // $today = Carbon::today();

        $period = new DatePeriod($begin, new DateInterval('P1M'), $now);
        $dbData = [];
 
        foreach ($period as $date) {
            $range[$date->format("Y-m")] = 0;
        }

        // $data = TodoList::whereBetween('done_at', [$begin, $now])
        // ->select(DB::raw('DATE_FORMAT(done_at, "%Y-%m") as date'), DB::raw('count(done_at) as count'))
        // ->groupBy('date')
        // ->get();

        $count = TodoList::where('user_id', 2)
        ->whereYear('done_at', 2020)
        ->whereMonth('done_at', 10)
        ->select(DB::raw('count(done_at) as count'))
        ->get();

        $data = TodoList::where('user_id', 2)
        ->whereBetween('done_at', [$begin, $now])
        ->select(DB::raw('DATE_FORMAT(done_at, "%Y-%m") as date'), DB::raw('count(done_at) as count'))
        ->groupBy('date')
        ->get();

        foreach ($data as $val) {
            $dbData[$val->date] = $val->count;
        }

        $data = array_replace($range, $dbData);

        return response()->json([
            'data' => $data,
        ]);
    }
}
