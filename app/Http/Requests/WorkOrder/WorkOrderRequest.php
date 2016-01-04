<?php

namespace App\Http\Requests\WorkOrder;

use App\Http\Requests\Request;

class WorkOrderRequest extends Request
{
    /**
     * The work order validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category'      => 'exists:categories,id,belongs_to,work-orders',
            'location'      => 'exists:locations,id',
            'status'        => 'required|integer|exists:statuses,id',
            'priority'      => 'required|integer|exists:priorities,id',
            'subject'       => 'required|min:5|max:250',
            'description'   => 'min:5',

            'started_at_date' => '',
            'started_at_time' => '',

            'completed_at_date' => '',
            'completed_at_time' => '',
        ];
    }

    /**
     * Authorizes all users to create a work order.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
