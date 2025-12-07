<?php

namespace app\Util;

class DaysUtil {
    const SUNDAY = 'sunday';
    const MONDAY = 'monday';
    const TUESDAY = 'tuesday';
    const WEDNESDAY = 'wednesday';
    const THURSDAY = 'thursday';
    const FRIDAY = 'friday';
    const SATURDAY = 'saturday';
    
    public static function todayIs() {
        $time = time();
        $day = strtolower(date("l", $time));
        return $day;
    }
    public static function todayDate() {
        $time = time();
        $date = strtolower(date("o" . "-" . "m" . "-" . "d", $time));
        return $date;
    }
    public static function currentTime() {
        $time = time();
        return date("H:i:s");
    }
    
      public static function timestamp() {
        $time = time();
        return $day = date("Y-m-d H:i:s", $time);
    }
    
    public static function isLate($time) {
        if($time > self::currentTime()) {
            return false;
        } else {
            return true;
        }
    }
    
    public static function isTodayHoliday() {
        $today = self::todayDate();
        
        $holiday = HolidayMaster::findOne(['date' => $today]);
        
        if(empty($holiday)) {
            return false;
        } else {
            return true;
        }
    }
    
    
     public static function isBeforeToday($date) {
        $today = self::todayDate();
        $applied_date = $date;

        if(strtotime($today) <= strtotime($applied_date)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getFinancialYearSingleYear($start_date, $end_date){
        $start_y_timestamp = strtotime($start_date);
        $end_y_timestamp = strtotime($end_date);

        $start_year = date("Y", $start_y_timestamp);
        $end_year = date("Y", $end_y_timestamp);

        return $start_year == $end_year ? $start_year : $start_year ."-".$end_year;
    }

    public static function getFinancialYearSession($start_date, $end_date){
        $start_y_timestamp = strtotime($start_date);
        $end_y_timestamp = strtotime($end_date);

        $start_year = date("Y", $start_y_timestamp);
        $start_month = date("m", $start_y_timestamp);
        $end_year = date("Y", $end_y_timestamp);
        $end_month = date("m", $end_y_timestamp);

        // return $start_year ."-". $start_month ."-". $end_year ."-". $end_month;
        // return $start_year_date = $start_month ."-". $end_month;
        // if($start_month < )
        if($start_month < 04) {
            return ($start_year - 1) ."-". $start_year;
        } elseif ($start_date >= 04) {
            return $start_year ."-". ($start_year + 1);
        }

        // return $start_year == $end_year ? $start_year : $start_year ."-".$end_year;

    }

    public static function getDays($start_date, $end_date){
        if($start_date == $end_date) {
            return 1;
        } else {
            $start_date_timestamp = strtotime($start_date);
            $end_date_timestamp = strtotime($end_date);
            return (($end_date_timestamp - $start_date_timestamp) / 86400) + 1;
        }
    }

    public static function getMonth($date){
        $time_from_date = strtotime($date);
        return $month_from_month = date("m", $time_from_date);
    }
    public static function getFinancialYearStartEndSession() {
        $current_timestamp = time();
        $current_year = date("Y", $current_timestamp);
        $current_month = date("m", $current_timestamp);
        $current_date = date("d", $current_timestamp);
        if($current_month < 04) {
            return array([
                "start_year" => (int) ($current_year - 1),
                "end_year" => (int) $current_year
            ]);
        } else {
            return array([
                "start_year" => (int) $current_year,
                "end_year" => (int) ($current_year + 1)
            ]);
        }
    }
    
    
    public static function isAppliedDateWithInLastLeaveDate($applied_date, $found_date) {
        if(strtotime($applied_date) <= strtotime($found_date)) {
            return true;
        } else {
            return false;
        }
    }
    
}

?>