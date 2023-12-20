<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    </head>
    <body>
        <div class="container">
            <div>
                <h1>
                    Log Reports
                </h1> 
                <div style="text-align: right">
                    <a href="{{ route("time.logs") }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="row" style="margin-top:20px">
                <div class="col-sm-9">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Total Work Hours</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($logs as $log)
                          <tr>
                            <th>{{ date('D-m-Y H:i', strtotime($log->started_at)) }}</th>
                            <th>{{ date('D-m-Y H:i', strtotime($log->stoped_at)) }}</th>
                            <th>{{ floor($log->total_work_minutes / 60) . ":" .  $log->total_work_minutes % 60}}</th>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <a href="{{ route('reports.view', ['param' => 'daily']) }}" class="btn btn-primary">Daily Report</a>

                <a href="{{ route('reports.view', ['param' => 'weekly']) }}" class="btn btn-primary">Weekly Report</a>

                <a href="{{ route('reports.view', ['param' => 'monthly']) }}" class="btn btn-primary">Monthly Report</a>

            </div>

        </div>
    </body>
</html>