<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AdventDay1Part1 implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $input = trim(file_get_contents(storage_path('app/advent/day1.txt')));
        $rows = explode("\n", $input);

        $list1 = [];
        $list2 = [];
        foreach ($rows as $row) {
            $columns = array_values(array_filter(explode(' ', $row)));
            $list1[] = $columns[0];
            $list2[] = $columns[1];
        }

        sort($list1);
        sort($list2);

        $totalDistance = 0;
        for ($i = 0; $i < count($list1); $i++) {
            $totalDistance += abs($list1[$i] - $list2[$i]);
        }

        echo $totalDistance;
    }
}
