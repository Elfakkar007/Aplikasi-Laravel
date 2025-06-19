@extends('layouts.main')

@section('title')
    <title>{{ config('app.name') }} - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('container')

    <div class="container">
        <h2 class="mt-4 mb-2 text-dark">Presentase Aktivitas Kendaraan</h2>
    </div>
    <hr>

    <div id="grafikKendaraan" style="min-width: 310px; height: 400px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 1rem;"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        var dataGrafik = {!! $dataGrafik !!};

        Highcharts.chart('grafikKendaraan', {
            chart: {
                type: 'column',
                backgroundColor: '#f4f6f9',
                style: {
                    fontFamily: 'Segoe UI, sans-serif'
                }
            },
            title: {
                text: 'Grafik Pemakaian Kendaraan',
                style: {
                    color: '#343a40',
                    fontSize: '20px'
                }
            },
            xAxis: {
                categories: dataGrafik.jenis,
                title: {
                    text: 'Jenis Kendaraan',
                    style: { color: '#6c757d' }
                },
                labels: {
                    style: { color: '#495057' }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah',
                    style: { color: '#6c757d' }
                },
                labels: {
                    style: { color: '#495057' }
                }
            },
            legend: {
                itemStyle: {
                    color: '#343a40'
                }
            },
            series: [{
                name: 'Jumlah',
                data: dataGrafik.jumlah,
                color: '#0d6efd' // Aksen biru
            }]
        });
    </script>

@endsection
