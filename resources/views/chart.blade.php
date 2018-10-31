@extends('layouts.app', [
    'pageTitle' => 'Home'
])

@section('content')
    <div class="container pg-dashboard">
        <div class="row justify-content-center">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('js/chart.js') }}"></script>
<script>
    $(document).ready(function () {
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],

                    borderWidth: 1
                }]
            },
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
    })
</script>
@endpush