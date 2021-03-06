<?php

namespace App\Services;

use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;

class StatisticsCountService
{
    public function countDay($id)
    {
        $now = Carbon::today();

        $data = TodoList::where('user_id', $id)
        ->whereDate('done_at', $now)
        ->count();

        return $data;
    }

    public function countAll($id)
    {
        $data = TodoList::where('user_id', $id)
        ->whereNotNull('done_at')
        ->count();

        return $data;
    }

    public function countMonth($id)
    {
        $now = Carbon::today();

        $data = TodoList::where('user_id', $id)
        ->whereYear('done_at', $now->year)
        ->whereMonth('done_at', $now->month)
        ->count();

        return $data;
    }

    public function averageDay($id)
    {
        $begin = User::where('id', $id)->value('created_at');
        $now = Carbon::today();

        $allDay = $now->copy()->diffInDays($begin) + 1;

        $data = TodoList::where('user_id', $id)
        ->whereNotNull('done_at')
        ->count();

        $avg = round($data / $allDay);

        return $avg;
    }

    public static function countContinuous($data)
    {
        $count = 0;
        $highestCount = 0;
        $today = Carbon::today();
        foreach ($data as $key => $value) {
            $dbDate = new Carbon($key);
            if ($dbDate->eq($today)) {
                if ($value !== 0) {
                    $count++;
                    if ($highestCount < $count) {
                        $highestCount = $count;
                    }
                }
                if ($value === 0) {
                    if ($highestCount < $count) {
                        $highestCount = $count;
                    }
                }
            } elseif ($value !== 0) {
                $count++;
            } elseif ($value === 0) {
                if ($highestCount < $count) {
                    $highestCount = $count;
                    $count = 0;
                }
                $count = 0;
            }
        }
        return [$count, $highestCount];
    }
}
