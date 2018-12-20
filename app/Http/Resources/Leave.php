<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Leave extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->user->name,
            'subject' => $this->subject,
            'description' => $this->description,
            'startDate' => $this->start_date->format('Y-m-d'),
            'endDate' => $this->end_date->format('Y-m-d'),
            'start_date_partial_hours' => $this->start_date_partial_hours,
            'end_date_partial_hours' => $this->start_date_partial_hours,
            'isApproved' => $this->is_approved,
            'approvalStatus' => $this->approval_status,
            'approvedOn' => $this->approved_on,
            'approvedBy' => $this->approved_by,
            'can_edit' => \Gate::allows('update', $this->resource),
            'can_delete' => \Gate::allows('delete', $this->resource),
            'can_approve' => \Gate::allows('approval', $this->resource),
        ];
    }
}
