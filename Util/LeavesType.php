<?php
namespace app\Util;
class LeavesType
{
    const casual = 1;
    const sick = 2;
    
    public static function getLeaveType($type) {
        switch ($type) {
            case 'casual':
                return 1;
                break;
            case 'sick':
                return 2;
                break;
            default:
                return 'Invalid leave type';
        }
    }
    
    public static function getLeaveTypeFromValue($type) {
        switch ($type) {
            case 1:
                return 'casual';
                break;
            case 2:
                return 'sick';
                break;
            default:
                return 'Invalid leave type';
        }
    }
    
}
?>