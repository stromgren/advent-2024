<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AdventDay1Part2 implements ShouldQueue
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

        $similarityScore = 0;
        foreach($list1 as $list1Item) {
            $apperances = 0;
            foreach($list2 as $list2Item) {
                if($list2Item == $list1Item) {
                    $apperances++;
                }
            }

            $similarityScore += $apperances * $list1Item;
        }

        echo $similarityScore;
    }
}
