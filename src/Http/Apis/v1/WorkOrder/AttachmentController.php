<?php

namespace Http\Apis\v1\WorkOrder;

use Stevebauman\Maintenance\Models\Attachment;
use Stevebauman\Maintenance\Repositories\WorkOrder\Repository as WorkOrderRepository;
use Stevebauman\Maintenance\Http\Controllers\Controller as BaseController;

class AttachmentController extends BaseController
{
    /**
     * @var WorkOrderRepository
     */
    protected $workOrder;

    /**
     * Constructor.
     *
     * @param WorkOrderRepository $workOrder
     */
    public function __construct(WorkOrderRepository $workOrder)
    {
        $this->workOrder = $workOrder;
    }

    /**
     * Returns a new grid instance of all available work order attachments.
     *
     * @param int|string $id
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function grid($id)
    {
        $columns = [
            'id',
            'created_at',
            'user_id',
            'name',
            'color',
        ];

        $settings = [
            'sort' => 'created_at',
            'direction' => 'desc',
            'threshold' => 10,
            'throttle' => 10,
        ];

        $transformer = function(Attachment $attachment) use ($id)
        {
            return [
                'id' => $attachment->id,
                'user' => ($attachment->user ? $attachment->user->full_name : '<em>System</em>'),
                'name' => $attachment->name,
                'file_name' => $attachment->file_name,
                'created_at' => $attachment->created_at,
                'view_url' => route('maintenance.work-orders.attachments.show', [$id, $attachment->id]),
            ];
        };

        return $this->workOrder->gridAttachments($id, $columns, $settings, $transformer);
    }
}
