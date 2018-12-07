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
            'startDate' => $this->start_date->format('Y-m-d'),
            'endDate' => $this->end_date->format('Y-m-d'),
            'subject' => $this->subject,
            'description' => $this->description,
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
