@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="{{ mix('js/chart.js') }}"></script>
    <script>
        let days = '{!! json_encode($weekAttendances->pluck('day')->toArray()) !!}';
        let attendance = '{!! json_encode($weekAttendances->pluck('hours')->toArray()) !!}';

        let barChartData = {
            datasets: [{
                backgroundColor: "blue",
                data: $.parseJSON(attendance).map(function (time) {
                    if (time == 0) {
                        return moment(`1970-02-01 00:00:00`).valueOf();
                    }

                    return moment(`1970-02-01 ${time}:00`).valueOf();
                }),
                borderWidth: 1
            }]
        };

        window.onload = function() {
            let ctx = document.getElementById("myChart").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    scales: {
                        xAxes: [{
                            type: 'category',
                            labels: $.parseJSON(days),
                            scaleLabel: {
                                display: true,
                                labelString: "Week Days",
                                fontColor: "red"
                            }
                        }],
                        yAxes: [
                            {
                                type: 'linear',
                                position: 'left',
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
    </script>
@endpush