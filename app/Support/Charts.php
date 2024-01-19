<?php

namespace App\Support;

use Exception;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class Charts
{
    /**
     * To create a chart, you need to pass an array with the model, and any settings you want to override.
     * @param array $settings
     * @return LaravelChart
     * @throws Exception
     */
    public static function CreateLineChart(array $settings): LaravelChart

    {
        $default = [
            'model' => '',
            'chart_title' => 'x by dates',
            'report_type' => 'group_by_date',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'filter_period' => 'year',
            'aggregate_field' => 'amount',
            'chart_type' => 'line',
        ];

        $chart_settings = array_replace_recursive($default, $settings);
        return new LaravelChart($chart_settings);
    }
}
