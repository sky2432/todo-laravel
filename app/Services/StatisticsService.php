<?php

namespace App\Services;

use App\Models\TodoList;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;

class StatisticsService
{
    public static function day($id, $begin, $rangeEnd, $dbEnd)
    {
        $period = new DatePeriod($begin, new DateInterval('P1D'), $rangeEnd);//$begin以上$rangeEnd未満

        $dbData = [];
 
        foreach ($period as $date) {
            $range[$date->format("Y-m-d")] = 0;
        }

        $data = TodoList::where('user_id', $id)
        ->whereBetween('done_at', [$begin, $dbEnd])//$begin以上$dbEnd以下
        ->select(DB::raw('DATE_FORMAT(done_at, "%Y-%m-%d") as day'), DB::raw('count(done_at) as count'))
        ->groupBy('day')
        ->get();

        foreach ($data as $val) {
            $dbData[$val->day] = $val->count;
        }

        $data = array_replace($range, $dbData);

        return $data;
    }

    public static function week($id, $begin, $rangeEnd, $dbEnd)
    {
        $period = new DatePeriod($begin, new DateInterval('P1D'), $rangeEnd);

        foreach ($period as $date) {
            $range[$date->format('YW')] = 0;
        }

        $count53 = 0;
        foreach ($range as $key => $value) {
            if (substr($key, 4, 2) === "53" && $count53 === 1) {
                unset($range[$key]);
            }
            if (substr($key, 4, 2) === "53") {
                $count53++;
            }
        }

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
        ->whereBetween('done_at', [$begin, $dbEnd])
        ->select(DB::raw('YEARWEEK(done_at, 3) as week'), DB::raw('count(done_at) as count'))
        ->groupBy('week')
        ->get();

        $dbData = [];

        foreach ($data as $val) {
            $dbData[$val->week] = $val->count;
        }

        $data = array_replace($range, $dbData);

        $newData = [];

        foreach ($data as $key => $value) {
            $yaer = substr($key, 0, 4);
            $week = substr($key, 4, 2);
            $begin = new Carbon();
            $begin->setISODate($yaer, $week)->startOfWeek();
            $newData[$begin->format('Y-m-d')] = $value ;
        }

        return $newData;
    }

    public static function month($id, $begin, $rangeEnd, $dbEnd)
    {
        $period = new DatePeriod($begin, new DateInterval('P1D'), $rangeEnd);
        $dbData = [];
 
        foreach ($period as $date) {
            $range[$date->format("Y-m")] = 0;
        }

        $data = TodoList::where('user_id', $id)
        ->whereBetween('done_at', [$begin, $dbEnd])
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
