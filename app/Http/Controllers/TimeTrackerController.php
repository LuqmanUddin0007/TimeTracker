<?php

namespace App\Http\Controllers;
use App\Models\TimeTracker;
use Carbon\Carbon;

use Illuminate\Http\Request;

class TimeTrackerController extends Controller
{
    private $timeTracker; 

    public function __construct(TimeTracker $timeTracker) {
        $this->timeTracker = $timeTracker;
    }

    public function index() {
        
        $logs = TimeTracker::where('uid', 1)->whereDate('started_at', '=', Carbon::today())->get();

        foreach($logs as $index => $log) {
            $logs[$index]->started_at = Carbon::parse($log->started_at)->format('D-M-Y H:i');
            $logs[$index]->stoped_at = Carbon::parse($log->stoped_at)->format('D-M-Y H:i');
            $logs[$index]->total_work_minutes = $this->getHourFromMinutes($log->total_work_minutes); 
        }
        
        
        return view('timeLogs')->with(compact("logs"));
    }


  public function getHourFromMinutes($minutes): string {
    $hours = floor($minutes / 60);
    $remainingMinutes = $minutes % 60;

    return $hours . " : " . $remainingMinutes;
  }
  
  private function getMinutesDiff($startTime, $endTime): int {
    return $endTime->diffInMinutes($startTime);
  }

  private function getParsedDate($date): Carbon {
    return carbon::parse($date);
  }

  private function getDuplicateLog(Carbon $startTime, Carbon $endTime) {
    return TimeTracker::whereTime('started_at', '>=', $startTime)->whereTime('stoped_at', '<=', $endTime)->count();
  }

  private function validateFormFields(Request $request) {
    $request->validate([
        'started_at' => 'required | date_format:H:i',
        'stoped_at' => 'required | date_format:H:i',
    ]);
  }

  private function checkWorkHourLimit(Carbon $startTime) {
    $minutes = TimeTracker::whereDate('started_at', $startTime)->sum("total_work_minutes");
    $hours = $minutes / 60;

    return $hours > 8 ? true: false;
  }

  public function storeLog(Request $request) {
    
    //validate form fields
    $this->validateFormFields($request);

    // get parsed date from manual user entry
    $startTime = $this->getParsedDate($request['started_at']);
    $endTime = $this->getParsedDate($request['stoped_at']);

    
    // a user can not log work hours more than eigth
    if ($this->checkWorkHourLimit($startTime)) {
       return redirect('/')->with('message', 'Work hour limit reached!');
    }
    
    // prevent duplicate entry for same time
    if($this->getDuplicateLog($startTime, $endTime) == 0) {
        
        $this->timeTracker->uid = 1;
        $this->timeTracker->started_at = $startTime;
        $this->timeTracker->stoped_at = $endTime;
        $this->timeTracker->total_work_minutes = $this->getMinutesDiff($startTime, $endTime);

        $this->timeTracker->save();

        return redirect("/")->with('message', 'Time Logged Successfully !');
    }

    return redirect("/")->with('message', 'Unable to log time that has already been recorded !');
  }
  
  public function editLog(Request $request) {

    //validate form fields
    $this->validateFormFields($request);
    
    // get parsed date from manual user entry
    $startTime = $this->getParsedDate($request['started_at']);
    $endTime = $this->getParsedDate($request['stoped_at']);

    // check if user has already reached the limit of hours
    if ($this->checkWorkHourLimit($startTime)) {
        return redirect('/')->with('message', 'Work hour limit reached !');
    }

    // below statement will update if there is no same time log exists
    if ($this->getDuplicateLog($startTime, $endTime) == 1) {
        
        $timeLog = $this->timeTracker->find($request['id']);
        $timeLog->started_at = $startTime;
        $timeLog->stoped_at = $endTime;
        $timeLog->total_work_minutes = $this->getMinutesDiff($startTime, $endTime);


        $timeLog->update();
      
        return redirect("/")->with('message', 'Time log updated successfully');
    }

    return redirect("/")->with('message', 'Unable to log time that has already been recorded !');

  }

  public function loadEditView($id) {

    $timelog = $this->timeTracker->find($id);

    if (is_null($timelog)) {

        return redirect()->back();

    } else {
    
        $timelog->started_at = Carbon::parse($timelog->started_at)->format("H:i");
        $timelog->stoped_at = Carbon::parse($timelog->stoped_at)->format("H:i");

        return view("editView")->with(compact("timelog"));
    }

  }

  public function destroyLog($id) {
    
    $timelog = $this->timeTracker->find($id);

    if (!is_null($timelog)) {
        $timelog->delete();
      }
      
    return redirect()->back()->with('message', 'Time log successfully deleted');

  }
}
