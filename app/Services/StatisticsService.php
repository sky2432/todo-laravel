<?php

namespace App\Services;

use App\Models\TodoList;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;

class StatisticsService
{
    public static function day($id, $begin, $end)
    {
        $period = new DatePeriod($begin, new DateInterval('P1D'), $end);//$begin以上$rangeEnd未満

        $dbData = [];

        foreach ($period as $date) {
            $range[$date->format("Y-m-d")] = 0;
        }

        $data = TodoList::where('user_id', $id)
        ->whereBetween('done_at', [$begin, $end])//$begin以上$dbEnd以下
        ->select(DB::raw('DATE_FORMAT(done_at, "%Y-%m-%d") as day'), DB::raw('count(done_at) as count'))
        ->groupBy('day')
        ->get();

        foreach ($data as $val) {
            $dbData[$val->day] = $val->count;
        }

        $data = array_replace($range, $dbData);

        return $data;
    }

    public static function week($id, $begin, $end)
    {
        $period = new DatePeriod($begin, new DateInterval('P1D'), $end);

        foreach ($period as $date) {
            $range[$date->format('YW')] = 0;
        }

        //2つ目の53周目を削除
        $count53 = 0;
        foreach ($range as $key => $value) {
            if (substr($key, 4, 2) === "53" && $count53 === 1) {
                unset($range[$key]);
            }
            if (substr($key, 4, 2) === "53") {
                $count53++;
            }
        }

        // 1つ目の1週目を削除
        $deleteKey = "";
        foreach ($range as $key => $value) {
            if (substr($key, 4, 2) === "01" && $deleteKey !== "") {
                unset($range[$deleteKey]);
            }
            if (substr($key, 4, 2) === "01") {
                $deleteKey = $key;
            }
        }

        $data = TodoList::where('user_id', $id)
        ->whereBetween('done_at', [$begin, $end])
        ->select(DB::raw('YEARWEEK(done_at, 3) as week'), DB::raw('count(done_at) as count'))
        ->groupBy('week')
        ->get();

        $dbData = [];

        foreach ($data as $val) {
            $dbData[$val->week] = $val->count;
        }

        $data = array_replace($range, $dbData);

        $newData = [];

        //配列のキーを週の初めの日付に変換
        foreach ($data as $key => $value) {
            $year = substr($key, 0, 4);
            $week = substr($key, 4, 2);
            $begin = new Carbon();
            $begin->setISODate($year, $week)->startOfWeek();
            $newData[$begin->format('Y-m-d')] = $value ;
        }

        return $newData;
    }

    public static function month($id, $begin, $end)
    {
        $period = new DatePeriod($begin, new DateInterval('P1M'), $end);
        $dbData = [];

        foreach ($period as $date) {
            $range[$date->format("Y-m")] = 0;
        }

        $data = TodoList::where('user_id', $id)
        ->whereBetween('done_at', [$begin, $end])
        ->select(DB::raw('DATE_FORMAT(done_at, "%Y-%m") as month'), DB::raw('count(done_at) as count'))
        ->groupBy('month')
        ->get();

        foreach ($data as $val) {
            $dbData[$val->month] = $val->count;
        }

        $data = array_replace($range, $dbData);

        return $data;
    }
}
