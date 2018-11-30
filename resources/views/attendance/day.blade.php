@extends('layouts.app', [
    'subTitle' => 'Attendance',
    'pageTitle' => 'View Daily Log'
])

@section('content')
    <div class="row">
        <div class="col-lg-10 col-md-12">
            <div class="row m-0 mb-2">
                <div class="input-daterange input-group input-date-range pl-0 col-6">
                    <input type="text" id="start_date" name="start_date" class="form-control input-date" placeholder="Start Date">
                    <input type="text" id="end_date" name="end_date" class="form-control input-date" placeholder="End Date">
                </div>
                <input type="hidden" id="user" value="{{ $user->id }}">
                <a id="go" href="" class="btn btn-primary">Go</a>
            </div>

            <div class="card card-small mb-3">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="m-0">
                        @if($user->avatar)
                            <img src="{{ $user->avatar_url }}" class="avatar">
                        @endif
                        <span>{{ $user->name }}</span>
                    </h6>
                    <div>
                        <span class="badge badge-secondary">
                            {{ $startDate }}
                        </span>
                        @if($startDate <> $endDate)
                            TO
                            <span class="badge badge-secondary">
                                {{  $endDate }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <span class="text-light ml-auto">Total Hours:</span>
                        <strong class="mr-3">{{ hoursFromSeconds($weekAttendances->sum('second')) }}</strong>
                    </div>

                    <canvas height="130" id="myChart" class="mt-1"></canvas>

                    <div class="row">
                        <a href="/dashboard" class="btn btn-link ml-auto mr-3">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="{{ mix('js/chart.js') }}"></script>
    <script>
        let date = '{!! $weekAttendances->pluck('date') !!}';
        let attendance = '{!! $weekAttendances->pluck('hours') !!}';

        let barChartData = {
            datasets: [{
                data: $.parseJSON(attendance).map(function (time) {
                    if (time == 0) {
                        return moment(`1970-02-01 00:00:00`).valueOf();
                    }

                    return moment(`1970-02-01 ${time}:00`).valueOf();
                }),
                backgroundColor: "blue",
                borderWidth: 1
            }]
        };

        let days = $.parseJSON(date).map(function (day) {
                    return moment(day, "YYYY-MM-DD").format("D/M(ddd)");
                })

        window.onload = function() {
            let ctx = document.getElementById("myChart").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    legend: { display: false },
                    scales: {
                        xAxes: [{
                            type: 'category',
                            labels: days,
                            scaleLabel: {
                                display: true,
                                labelString: "Days",
                                fontColor: "red"
                            }
                        }],
                        yAxes: [
                            {
                                type: 'linear',
                                position: 'left',
                                scaleLabel: {
                                    display: true,
                                    labelString: "Hours",
                                    fontColor: "red"
                                },
                                ticks: {
                                    min: moment('1970-02-01 00:00:00').valueOf(),
                                    max: moment('1970-02-01 12:59:59').valueOf(),
                                    stepSize: 3.6e+6,
                                    beginAtZero: false,
                                    callback: value => {
                                        let date = moment(value);
                                        if(date.diff(moment('1970-02-01 00:00:00'), 'minutes') === 0) {
                                            return 0;
                                        }
                                        if(date.diff(moment('1970-02-01 12:59:59'), 'minutes') === 0) {
                                            return null;
                                        }

                                        return date.format('h');
                                    }
                                }
                            }
                        ]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                if (label) {
                                    label += ': ';
                                }
                                label += moment(tooltipItem.yLabel).format("HH:mm");
                                return label;
                            }
                        }
                    }
                }
            });
        };


        $(function() {
            $('#go').click(function(){
                let startDate = $('#start_date').val()
                let endDate = $('#end_date').val()
                let user = $('#user').val()

                $('#go').attr('href', "/attendance/day/" + user + "/" + startDate + "/" + endDate)
            })
        })
    </script>
@endpush