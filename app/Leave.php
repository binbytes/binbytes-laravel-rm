<?php

namespace App;

use App\Notifications\LeaveApproval;
use App\Notifications\LeaveRequested;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use NotificationHandler;

    /**
     * Notifications related to Leave
     * @var array
     */
    public static $notifications = [
        LeaveApproval::class,
        LeaveRequested::class
    ];

    public $dates = [
        'start_date', 'end_date'
    ];

    public $casts = [
        'is_approved' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'subject', 'description', 'start_date', 'start_date_partial_hours', 'end_date', 'end_date_partial_hours',
        'is_approved', 'approved_on', 'approved_by', 'approved_note'
    ];

    public function getApprovalStatusAttribute()
    {
        switch ($this->is_approved) {
            case true:
                return 'Approved';
            case false:
                return 'Declined';
        }

        return 'Pending';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
