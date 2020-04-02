<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    //--------------------
    // 値をviewに渡す
    //--------------------
    public function add () {
        
        
        return $year_month;
    }
    
    //-------------------
    // 各月のカレンダー
    //-------------------
    public function calendar ($y_m_d) {
        
        //今後の年月日の変動を考えて今は定数を入れている
        $today = new Carbon('2020-02-01');
        // $today = new Carbon\Carbon('2020-04');
        $daysInMonth = $today->daysInMonth;
        $dayOfWeek = $today->dayOfWeek;
        
        $week = str_repeat('<th></th>', $dayOfWeek);
        // dd($week);
        $n = 7 - $dayOfWeek;
        $day = 1;
    
        for($v=$day; $v<$daysInMonth + 1; $v++){
            $week .= '<th>'.$day. '</th>';
            if(($dayOfWeek + $day)%7 == 0 ){
                $weeks[] = '<tr>'.$week.'</tr>';
                $week = "";
            }
            $day++;
        }
        // dd($weeks);
        // dd($week);
        $t = substr($today, 0, 7);
        $m = $t . '-'. $daysInMonth;
        $m_today = Carbon::parse($m);
        // $m_today = Carbon\Carbon::parse($m);
        $m_dayOfWeek = $m_today->dayOfWeek;
        $s = 6 - $m_dayOfWeek;
        if(!$s == 0){
            $week .= str_repeat('<th></th>', $s);
            $weeks[] = '<tr>'.$week.'</tr>';
        }
        // dd($weeks);
        return $weeks;
    }
}
