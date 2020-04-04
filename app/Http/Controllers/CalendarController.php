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
    public function calendar ($month) {
        
        $first_month_day = $month . '-01';
        $today = Carbon::parse($first_month_day);
        // $today = new Carbon\Carbon('2020-04');
        $daysInMonth = $today->daysInMonth;
        $dayOfWeek = $today->dayOfWeek;
        // dd($dayOfWeek);
        $week = str_repeat('<td></td>', $dayOfWeek);
        // dd($week);
        $n = 7 - $dayOfWeek;
        $day = 1;
    
        for($v=$day; $v<$daysInMonth + 1; $v++){
            $week .= '<td><a href="?today=' .$day. '">' .$day. '</a></td>';
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
            $week .= str_repeat('<td></td>', $s);
            $weeks[] = '<tr>'.$week.'</tr>';
        }
        // dd($weeks);
        return $weeks;
    }
    
    // --------------------
    //  年月の変更
    // --------------------
    public function getMonth (){
        
        if(isset($_GET['date'])){
            $get = $_GET['date'] . '-01';
            if($_GET['method'] == "addmonth"){
                $get_month = Carbon::parse($get)->addMonth();
            }elseif($_GET['method'] == "submonth"){
                $get_month = Carbon::parse($get)->subMonth();
            }
            $month = substr($get_month, 0, 7);
        // dd($month);
        }else{
            $month = substr(Carbon::today(), 0, 7);
        }
        
        return $month;
    }
        
        
        
}
