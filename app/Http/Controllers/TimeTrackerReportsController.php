<?php

namespace App\Http\Controllers;

use App\Models\TimeTracker;
use Carbon\Carbon;

class TimeTrackerReportsController extends Controller
{
    public function index($param = "daily") {

        switch($param) {
          case "monthly":
           $logs = $this->getMonthlyLogs();
           break;
          
          case "weekly":
            $logs = $this->getWeeklyLogs();
            break;
          
          default:
            $logs = $this->getDailyLogs();
            break;  
        }

        return view ('/reports')->with(compact("logs"));
    }


    private function getDailyLogs() {
        $today = Carbon::now()->format('Y-m-d');

        // Retrieve records for the today
        return TimeTracker::whereDate('created_at', $today)->get();
    }

    private function getMonthlyLogs() {
        // Subtract one month for one month record
        $startDate = Carbon::now()->subMonth();
        // end date
        $endDate = Carbon::now();
        
        // Retrieve records for the current month
        return TimeTracker::whereBetween('created_at', [$startDate, $endDate])->get();
    }

    private function getWeeklyLogs() {
        $startDate = Carbon::now()->subWeek();
        $endDate = Carbon::now();

        // Retrieve records for the previous week
        return TimeTracker::whereBetween('created_at', [$startDate, $endDate])->get();
    }

}
