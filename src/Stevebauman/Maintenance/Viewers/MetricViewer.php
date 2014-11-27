<?php

namespace Stevebauman\Maintenance\Viewers;

use Stevebauman\Maintenance\Viewers\BaseViewer;

class MetricViewer extends BaseViewer {
    
    public function btnActions()
    {
        return view('maintenance::viewers.metric.buttons.actions', array('metric'=>$this->entity));
    }
    
}