<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AdventDay2Part1 implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $input = trim(file_get_contents(storage_path('app/advent/day2.txt')));
        $reports = explode("\n", $input);

        $safeReportCount = 0;

        foreach($reports as $report) {
            $levels = explode(' ', $report);

            $reportIsSafe = true;
            $isIncreasing = false;
            $isDecreasing = false;
            for($i = 0; $i < count($levels); $i++) {
                $currentLevel = $levels[$i];
                $nextLevel = $levels[$i + 1] ?? null;

                if($nextLevel !== null && $currentLevel === $nextLevel) {
                    $reportIsSafe = false;
                    break;
                }

                if($nextLevel !== null && $currentLevel < $nextLevel) {
                    $isIncreasing = true;
                }

                if($nextLevel !== null && $currentLevel > $nextLevel) {
                    $isDecreasing = true;
                }

                if($isIncreasing && $isDecreasing) {
                    $reportIsSafe = false;
                    break;
                }

                if($nextLevel !== null && abs($currentLevel - $nextLevel) > 3) {
                    $reportIsSafe = false;
                    break;
                }
            }

            if($reportIsSafe) {
                $safeReportCount++;
            }
        }

        echo $safeReportCount;
    }
}
