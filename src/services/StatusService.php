<?php

namespace Stevebauman\Maintenance\Services;

use Stevebauman\Maintenance\Services\SentryService;
use Stevebauman\Maintenance\Models\Status;
use Stevebauman\Maintenance\Services\AbstractModelService;

class StatusService extends AbstractModelService {
    
    public function __construct(Status $status, SentryService $sentry)
    {
        $this->model = $status;
        $this->sentry = $sentry;
    }
    
    public function create()
    {
        $insert = array(
            'user_id' => $this->sentry->getCurrentUserId(),
            'name' => $this->getInput('name'),
            'color' => $this->getInput('color'),
            'control' => $this->getInput('control')
        );
        
        return $this->model->create($insert);
    }
    
    public function update($id)
    {
        $insert = array(
            'name' => $this->getInput('name'),
            'color' => $this->getInput('color'),
            'control' => $this->getInput('control')
        );
        
        $record = $this->find($id);
        
        return $record->update($insert);
    }
    
}