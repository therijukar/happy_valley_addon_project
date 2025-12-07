<?php
/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 26-07-2018
 * Time: 15:23
 */

namespace app\Util;

trait GlobalUtilities {
//    public $model;
//    public $arr;

    /**
     * Trait method for bulk delete
     * @param null $mdl
     * @param array $arr
     * @return string
     */
    public function bulkDelete($mdl=NULL, $arr=[])
    {
        try
        {
            for ($i=0; $i<count($arr); $i++)
            {
                $model = $mdl::findOne($arr[$i]);
                if($model)
                {
                    if($model->delete())
                    {
                        $ret = 'success';
                    }
                    else
                    {
                        $ret = $model->getErrors();
                    }
                }
                else
                {
                    $ret = 'Model not found';
                }
            }
        }
        catch (\Exception $e)
        {
            $ret = $e->getMessage();
        }
        return $ret;
    }

    /**
     * Bulk soft-delete for users & projects
     * @param null $paramModel
     * @param array $arr
     * @return string
     */
    public function projectUserBulkDelete($paramModel=NULL, $arr=[])
    {
        try
        {
            for ($i=0; $i<count($arr); $i++)
            {
                $model = $paramModel::findOne($arr[$i]);
                if($model)
                {
                    $model->soft_delete = 1;
                    if($model->save())
                    {
                        $ret = 'success';
                    }
                    else
                    {
                        $ret = $model->getErrors();
                    }
                }
                else
                {
                    $ret = 'Model not found';
                }
            }
        }
        catch (\Exception $e)
        {
            $ret = $e->getMessage();
        }
        return $ret;
    }
    
    function getIndianCurrency(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal) ? "and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }

}