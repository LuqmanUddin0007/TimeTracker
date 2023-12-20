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
                    Create Log
                </h1> 
            </div>
            <br />
            <div style="text-align: right">
                <a href="{{route('time.logs')}}" class="btn btn-primary">Back</a> 
            </div>
            <div>
                <small>
                    Kindly ensure that time entries are recorded in a 24-hour format. Thank you for your attention to this matter.
                </small>
            </div>
            <div style="margin-top: 30px">
                <form method="POST" action="{{ route('log.time') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                      <label>Start Time</label>
                      <input type="text" name="started_at" class="form-control" placeholder="Enter Start Time">
                      @error('started_at')
                       <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
                      @enderror
                    </div>
                    <div class="form-group" style="margin-top:20px">
                      <label>End time</label>
                      <input type="text" name="stoped_at" class="form-control" placeholder="Enter End time">
                     
                      @error('stoped_at')
                       <small id="emailHelp" class="form-text text-muted">{{$message}}</small>
                      @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="margin-top:20px">Submit</button>
                  </form>
            </div>
        </div>
    </body>
</html>