<?php
/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 20-08-2018
 * Time: 15:25
 */

namespace app\Util;


use app\models\AttendanceMaster;
use app\models\EmployeeUnpaidLeaves;
use app\models\HolidayMaster;
use app\models\LateCount;
use app\models\LeaveApply;

class AttendanceInfo
{
    public $leaveRangeArr = [];
    /**
     * Get day-wise week off from employee week-off (i.e 1=Sun, 2=Mon etc...)
     * @param array $days
     * @return array
     */
    public function weekOffDays($days=[])
    {
        $dayFull = [];
        if(count($days)>0)
        {
            foreach ($days as $day)
            {
                if($day == 1)
                {
                    $dayFull[] = 'Mon';
                }
                elseif($day == 2)
                {
                    $dayFull[] = 'Tue';
                }
                elseif($day == 3)
                {
                    $dayFull[] = 'Wed';
                }
                elseif($day == 4)
                {
                    $dayFull[] = 'Thu';
                }
                elseif($day == 5)
                {
                    $dayFull[] = 'Fri';
                }
                elseif($day == 6)
                {
                    $dayFull[] = 'Sat';
                }
                elseif($day == 7)
                {
                    $dayFull[] = 'Sun';
                }
            }
            return $dayFull;
        }
    }

    /**
     * Get all holidays month wise
     * @param null $month
     * @param null $year
     * @param null $date
     * @return false|string
     */
    public function holidaysList($month=NULL, $year=NULL, $date=NULL)
    {
        if(!empty($month) && !empty($year))
        {
            $holidaySql = "SELECT * FROM `holiday_master` WHERE MONTH(`date`)='".$month."' AND YEAR(`date`)='".$year."' AND `is_active` = '1'";
            $holidays = HolidayMaster::findBySql($holidaySql)->all();
            if($holidays)
            {
                foreach($holidays as $holiday)
                {
                    $holidayDate = date_format(date_create($holiday->date), 'd');
                    if($date==$holidayDate)
                    {
                        return date_format(date_create($holiday->date), 'Y-m-d D');
                    }
                }
            }
        }
    }

    /**
     * Get the attendance of employees
     * @param null $empId
     * @return array
     */
   public function empAttendance($empId=NULL, $month=NULL, $year=NULL)
    {
        if(!empty($empId))
        {
            $attendArray = [];
            $attendanceSql = "SELECT * FROM `attendance_master` WHERE `emp_id` = '".$empId."' AND MONTH(`date`) = '".$month."' AND YEAR(`date`) = '".$year."'";
            $empAttends = AttendanceMaster::findBySql($attendanceSql)->all();
            foreach($empAttends as $attend)
            {
                $attendArray[] = date_format(date_create($attend->date), 'd');
            }
            return $attendArray;
        }
    }
    public function empAttendancetotal($empId=NULL, $month=NULL, $year=NULL)
    {
        if(!empty($empId))
        {
           // $attendArray = [];
            $attendanceSql = "SELECT * FROM `attendance_master` WHERE `emp_id` = '".$empId."' AND MONTH(`date`) = '".$month."' AND YEAR(`date`) = '".$year."'";
            $empAttends = AttendanceMaster::findBySql($attendanceSql)->all();
            $attendArray = count($empAttends);
            return $attendArray;
        }
    }
   
   

    /**
     * List of approved leaves employee-wise
     * @param null $empId
     * @param null $month
     * @param null $year
     * @param null $day
     * @return array
     */
    public function empLeaves($empId=NULL, $month=NULL, $year=NULL, $day=NULL)
    {
        if(!empty($empId))
        {
            $leaveArray = [];
            $leaveSql = "SELECT * FROM `leave_apply` WHERE `user_emp_id`='".$empId."' AND `leave_status`='1' AND MONTH(`start_date`)='".$month."' AND YEAR(`start_date`)='".$year."'";
            $empLeaves = LeaveApply::findBySql($leaveSql)->all();
            if($empLeaves)
            {
                foreach ($empLeaves as $empLeave)
                {
                    $leave = array('empId' => $empId, 'startDate' => $empLeave->start_date, 'endDate' => $empLeave->end_date);
                    array_push($leaveArray, $leave);
                    $strtExpld = explode('-',$empLeave->start_date);
                    $endExpld = explode('-',$empLeave->end_date);
                    $strtRange = $strtExpld[2];
                    $endRange = $endExpld[2];
                    $a = 0;
//                    for($i=$strtRange; $i<=$endRange;$i++)
//                    {
//                        $this->leaveRangeArr[$empId][$a] = $strtRange;
//                        $a++;
//                    }
                }
            }
            else
            {
                $leaveArray[0] = array('empId' => $empId,'startDate' => '0000-00-00', 'endDate' => '0000-00-00');
            }
            return $leaveArray;
        }
    }


    /**
     * List of pending leaves employee-wise
     * @param null $empId
     * @param null $month
     * @param null $year
     * @param null $day
     * @return array
     */
    public function empLeavesPending($empId=NULL, $month=NULL, $year=NULL, $day=NULL)
    {
        if(!empty($empId))
        {
            $leaveArray = [];
            $leaveSql = "SELECT * FROM `leave_apply` WHERE `user_emp_id`='".$empId."' AND `leave_status`='2' AND MONTH(`start_date`)='".$month."' AND YEAR(`start_date`)='".$year."'";
            $empLeaves = LeaveApply::findBySql($leaveSql)->all();
            if($empLeaves)
            {
                foreach ($empLeaves as $empLeave)
                {
                    $leave = array('empId' => $empId, 'startDate' => $empLeave->start_date, 'endDate' => $empLeave->end_date);
                    array_push($leaveArray, $leave);
                }
            }
            else
            {
                $leaveArray[0] = array('empId' => $empId,'startDate' => '0000-00-00', 'endDate' => '0000-00-00');
            }
            return $leaveArray;
        }
    }

    /**
     * Removing duplicate values from array element ( DON NOT DELETE **NOT IN USE**)
     * @param array $arrList
     * @return array
     */
    public function arrayDistinct($arrList=[])
    {
        $arrCheck = [];
        $retArray = [];
        foreach($arrList as $key => $val)
        {
            if(in_array($key, $arrCheck))
            {
                if($retArray[$key]==1)
                {
//                    unset($retArray[$key]);
                    $retArray[$key] = $val;
                }
            }else
            {
                $retArray[$key] = $val;
            }
            $arrCheck[] = $key;
        }
        return $arrList;
    }

    /**
     * List for work on holidays
     * @param null $empId
     * @param null $date
     * @return string
     */
     public function workOnHolidayList($empId=NULL,$date=NULL)
    {
        if(!empty($date))
        {
            $workSql = "SELECT * FROM `attendance_master` WHERE `emp_id` = '".$empId."' AND `date` = '".$date."'";
            $works = AttendanceMaster::findBySql($workSql)->all();
            if($works)
            {
                if(count($works)>0)
                {
                    return 'yes';
                }
                else
                {
                    return 'no';
                }
            }
            else
            {
                return 'no';
            }

        }
    }

    /**
     * Creating the range for approved leaves date-wise
     * @param array $leaveArr
     * @param null $eId
     * @return array
     */
    public function leaveListRange($leaveArr=[], $eId=NULL)
    {
        $leaveRangeArray = [];
        $strtExpld = '';
        $endExpld = '';
        $strtRange = '';
        $endRange = '';
        if(count($leaveArr)>0)
        {
            for ($i=0; $i<count($leaveArr); $i++)
            {
                if ($leaveArr[$i]['startDate']!='0000-00-00' && $leaveArr[$i]['endDate']!='0000-00-00')
                {
                    $strtExpld = explode('-',$leaveArr[$i]['startDate']);
                    $endExpld = explode('-',$leaveArr[$i]['endDate']);
                    $strtRange = $strtExpld[2];
                    $endRange = $endExpld[2];
                    $a = 0;
                    for($strtRange; $strtRange<=$endRange; $strtRange++)
                    {
                        $leaveRangeArray[$eId][] = $strtRange;
                    }
                }else
                {
                    $leaveRangeArray[$eId] = [];
                }
            }
        }
        else
        {
            $leaveRangeArray[$eId] = [];
        }
        return $leaveRangeArray;
    }

    /**
     * Creating the range for unapproved leaves date-wise
     * @param array $leaveArr
     * @param null $eId
     * @return array
     */
    public function leavePendingListRange($leaveArr=[], $eId=NULL)
    {
        if(!empty($eId))
        {
            $leaveRangeArray = [];
            $strtExpld = '';
            $endExpld = '';
            $strtRange = '';
            $endRange = '';
            if(count($leaveArr)>0)
            {
                for ($i=0; $i<count($leaveArr); $i++)
                {
                    if ($leaveArr[$i]['startDate']!='0000-00-00' && $leaveArr[$i]['endDate']!='0000-00-00')
                    {
                        $strtExpld = explode('-',$leaveArr[$i]['startDate']);
                        $endExpld = explode('-',$leaveArr[$i]['endDate']);
                        $strtRange = $strtExpld[2];
                        $endRange = $endExpld[2];
                        $a = 0;
                        for($strtRange; $strtRange<=$endRange; $strtRange++)
                        {
                            $leaveRangeArray[$eId][] = $strtRange;
                        }
                    }else
                    {
                        $leaveRangeArray[$eId] = [];
                    }
                }
            }
            return $leaveRangeArray;
        }
    }

    /**
     * Check if leave is unpaid, or leave taken after all leaves under that leave-category is exhausted
     * @param null $empId
     * @param null $month
     * @param null $year
     * @param null $day
     * @return string
     */
    public function unpaidLeaveList($empId=NULL, $month=NULL, $year=NULL, $day=NULL)
    {
        if(!empty($empId))
        {
            $leaveRangeArray = [];
            $leaveTypeArray = [];
            $date = $year.'-'.$month.'-'.$day;
            $unpaidSql = "SELECT * FROM `employee_unpaid_leaves` WHERE `emp_id`='".$empId."' AND MONTH(`date`)='".$month."' AND YEAR(`date`)='".$year."'";
            $unpaidLeaves = EmployeeUnpaidLeaves::findBySql($unpaidSql)->all();
            if($unpaidLeaves)
            {

                foreach($unpaidLeaves as $unpaidLeave)
                {
                    $leaveDt = date_format(date_create($unpaidLeave->date), 'd');
                    for($i=0; $i<$unpaidLeave->days_absent; $i++)
                    {
                        $leaveRangeArray[] = $leaveDt;
                        $leaveTypeArray[$leaveDt] = $unpaidLeave->is_unpaid;
                        $leaveDt++;
                    }
                }
                //create the array date range for unpaid-leaves
                if(in_array($day, $leaveRangeArray))
                {
                    if(isset($leaveTypeArray[$day]) && $leaveTypeArray[$day]==0)
                    {
                        return 'shape1';
                    }
                    elseif(isset($leaveTypeArray[$day]) && $leaveTypeArray[$day]==1)
                    {
                        return 'tick1';
                    }
                }
                else
                {
                    return 'tick';
                }

            }
            else
            {
                return 'tick';
            }
        }
    }

    /**
     * Total count of A employee worked in a specific month
     * @param null $empId
     * @param null $month
     * @param null $year
     * @return int
     */
   public function countWorkDays($empId=NULL, $month=NULL, $year=NULL)
    {
        if(!empty($empId))
        {
            $countWorkDays = 0;
            $workSql = "SELECT * FROM `attendance_master` WHERE `emp_id` = '".$empId."' AND MONTH(`date`) = '".$month."' AND YEAR(`date`) = '".$year."'";
            $works = AttendanceMaster::findBySql($workSql)->all();
            if($works)
            {
                $countWorkDays = count($works);
            }
            return $countWorkDays;
        }
    }

    /**
     * Total count of A employee's unpaid leave in a specific month
     * @param null $empId
     * @param null $month
     * @param null $year
     * @return int
     */
    public function countUnpaidLeaves($empId=NULL, $month=NULL, $year=NULL)
    {
        if(!empty($empId))
        {
            $countUnpaidLeaves = 0;
            $leaveRangeArray = [];
            $leaveTypeArray = [];
            $unpaidSql = "SELECT * FROM `employee_unpaid_leaves` WHERE `emp_id`='".$empId."' AND MONTH(`date`)='".$month."' AND YEAR(`date`)='".$year."'";
            $unpaidLeaves = EmployeeUnpaidLeaves::findBySql($unpaidSql)->all();
            if($unpaidLeaves)
            {
                foreach($unpaidLeaves as $unpaidLeave)
                {
                    $leaveDt = date_format(date_create($unpaidLeave->date), 'd');
                    for($i=0; $i<$unpaidLeave->days_absent; $i++)
                    {
                        $leaveRangeArray[] = $leaveDt;
                        $leaveTypeArray[$leaveDt] = $unpaidLeave->is_unpaid;
                        $leaveDt++;
                    }
                }
                $countUnpaidLeaves = count($leaveRangeArray);
            }
            return $countUnpaidLeaves;
        }
    }

    /**
     * Count of total lates of employees
     * @param null $empId
     * @param null $month
     * @param null $year
     * @return int
     */
    public function countLate($empId=NULL, $month=NULL, $year=NULL)
    {
        $countLate = 0;
        $lateSql = "SELECT * FROM `late_count` WHERE `emp_id`='".$empId."' AND MONTH(`date`)='".$month."' AND YEAR(`date`)='".$year."'";
        $lates = LateCount::findBySql($lateSql)->all();
        if($lates)
        {
            $countLate = count($lates);
        }
        return $countLate;
    }
}