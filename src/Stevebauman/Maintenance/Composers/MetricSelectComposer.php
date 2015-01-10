<?php

namespace Stevebauman\Maintenance\Composers;

use Illuminate\View\View;
use Stevebauman\Maintenance\Services\MetricService;

/**
 * Class MetricSelectComposer
 * @package Stevebauman\Maintenance\Composers
 */
class MetricSelectComposer
{

    /**
     * @var MetricService
     */
    protected $metric;

    /**
     * @param MetricService $metric
     */
    public function __construct(MetricService $metric)
    {
        $this->metric = $metric;
    }

    /**
     * @param $view
     * @return mixed
     */
    public function compose(View $view)
    {
        $allMetrics = $this->metric->get()->lists('name', 'id');

        $allMetrics[NULL] = 'Select a Metric';

        return $view->with('allMetrics', $allMetrics);

    }

}
