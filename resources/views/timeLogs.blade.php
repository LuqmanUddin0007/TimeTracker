<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div>
                <h1>
                    Time Tracker App
                </h1> 
            </div>
    
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
    
            <div class="text-right">
                <a class="btn btn-primary" id="logTimeBtn" href="{{ route('store.logView') }}">Log Time</a>
                <a class="btn btn-primary" id="logTimeBtn" href="{{ route('reports.view') }}">View Reports</a>
            </div>

            <div style="margin-top: 30px">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col">Total Work Hours</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (count($logs) > 0) 
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->started_at }}</td>
                                <td>{{ $log->stoped_at }}</td>   
                                <td>{{ $log->total_work_minutes }}</td>    
                                <td>
                                    <a href="{{ route('edit.logView', ['id' => $log->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('delete.log', ['id' => $log->id]) }}" class="btn btn-danger">Delete</a>
                                </td>                             
                            </tr>
                        @endforeach 
                      @else
                      <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                      </tr> 
                      @endif
                          
                    </tbody>
                </table>
            </div>
        </div>
    
    </body>