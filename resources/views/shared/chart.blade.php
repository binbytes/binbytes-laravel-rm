@push('scripts')
    <script src="{{ mix('js/chart.js') }}"></script>
    <script>
        let day = '{!! json_encode($weekAttendances->pluck('day')->toArray()) !!}';
        let attendance = '{!! json_encode($weekAttendances->pluck('hours')->toArray()) !!}';

        let barChartData = {
            labels: $.parseJSON(day),
            datasets: [{
                backgroundColor: "blue",
                data: $.parseJSON(attendance),
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
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        };
    </script>
@endpush