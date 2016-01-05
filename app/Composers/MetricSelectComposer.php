<?php

namespace App\Composers;

use App\Repositories\MetricRepository;
use Illuminate\View\View;

class MetricSelectComposer
{
    /**
     * @var MetricRepository
     */
    protected $metric;

    /**
     * @param MetricRepository $metric
     */
    public function __construct(MetricRepository $metric)
    {
        $this->metric = $metric;
    }

    /**
     * @param $view
     *
     * @return mixed
     */
    public function compose(View $view)
    {
        $allMetrics = $this->metric->all()->lists('name', 'id')->toArray();

        $allMetrics[null] = 'Select a Metric';

        return $view->with('allMetrics', $allMetrics);
    }
}
