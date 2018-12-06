<?php

namespace App;

use App\Notifications\LeaveApproval;
use App\Notifications\LeaveRequested;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use NotificationHandler, AttendanceScope;

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

    /**
     * @return string
     */
    public function getApprovalStatusAttribute()
    {
        if($this->is_approved === true) {
            return 'Approved';
        } elseif ($this->is_approved === false) {
            return 'Declined';
        }
       return 'Pending';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
