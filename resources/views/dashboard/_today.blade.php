<div class="col-md-4">
    <div class="card">
        <div class="card-header border-bottom pb-0 d-flex justify-content-between">
            <h6 class="font-weight-bold">Today</h6>
            <a href="#" aria-label="View">
                <i class="fa fa-edit"></i>
            </a>
        </div>
        <div class="card-body">
            <timer :initial-time="{{ auth()->user()->today_attendance->totaltime }}"></timer>
        </div>
    </div>
</div>