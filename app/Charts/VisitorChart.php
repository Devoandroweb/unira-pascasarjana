<?php

namespace App\Charts;

use App\Models\Visitor;
use marineusde\LarapexCharts\Charts\LineChart;
use marineusde\LarapexCharts\Options\XAxisOption;

class VisitorChart
{
    public function build(): LineChart
    {
        // Fetch visitor data grouped by month
        $visitors = Visitor::selectRaw('strftime("%m", created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y')) // Filter for the current year
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $counts = array_fill(0, 12, 0);

        foreach ($visitors as $visitor) {
            $counts[(int)$visitor->month - 1] = (int)$visitor->count;
        }

        return (new LineChart)
            ->addData('Visitors', $counts)
            ->setXAxisOption(
                (new XAxisOption([
                    __("January"),
                    __("February"),
                    __("March"),
                    __("April"),
                    __("May"),
                    __("June"),
                    __("July"),
                    __("August"),
                    __("September"),
                    __("October"),
                    __("November"),
                    __("December")
                ]))
            );
    }
}
