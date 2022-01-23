<?php
require_once './initial_setting.php';

function get_date_list($every,$frequency,$end,$start = ""){
    //$startに値が渡されていない場合、本日の日付を代入
    if($start == ""){
        $start = date('Y-m-d');
    }

    //結果を代入する配列
    $result = [];

    //dateオブジェクト、end_pointオブジェクトを作成
    $date = new DateTime($start);
    $end_point = new DateTime($end);
    $end_point = $end_point->modify('+ 1day');

    //以降$everyによって処理が分かれる
    if($every == 'days'){
        while($date < $end_point){
            $result[] = $date->format('Y-m-d');
            $date->modify('+' . $frequency . ' day')->format('Y-m-d');
        }
    }
    elseif($every == 'weeks'){
        while($date < $end_point){
            $result[] = $date->format('Y-m-d');
            $date->modify('+' . ($frequency * 7) . ' day')->format('Y-m-d');
        }
    }
    elseif($every == 'months'){
        while($date < $end_point){
            $result[] = $date->format('Y-m-d');
            $date->modify('+' . $frequency . 'month')->format('Y-m-d');
        }
    }
    elseif($every == 'years'){
        while($date < $end_point){
            $result[] = $date->format('Y-m-d');
            $date->modify('+' . $frequency . 'years')->format('Y-m-d');
        }
    }
    elseif($every == 'no'){
        $result[] = $date->format('Y-m-d');
    }
    else{
        $result = false;
    }
    return $result;
}

$result = get_date_list($every,$frequency,$end_repeat,$start_repeat);

require_once './tpl/'.basename(__FILE__);
?>