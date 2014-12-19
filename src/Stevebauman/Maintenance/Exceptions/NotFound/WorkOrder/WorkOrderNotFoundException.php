<?php namespace Stevebauman\Maintenance\Exceptions;

use Illuminate\Support\Facades\App;
use Stevebauman\Maintenance\Exceptions\BaseException;

class WorkOrderNotFoundException extends BaseException {
    
    public function __construct(){
        $this->message = trans('maintenance::errors.not-found', array('resource'=>'Work Order'));
        $this->messageType = 'danger';
        $this->redirect = routeBack('maintenance.work-orders.index');
    }
    
}

App::error(function(WorkOrderNotFoundException $e, $code, $fromConsole){
    return $e->response();
});