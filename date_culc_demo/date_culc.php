<?php
require_once './initial_setting.php';

$start_time = "08:00:00";
$end_time = "10:00:00";
$start_repeat = "2022-01-30";
$end_repeat = "2022-02-10";

//現在
$date = new DateTime($start_repeat);
echo '現在の時刻を表示<br>';
echo $date->format('Y-m-d');
echo '<br>';
echo '<br>';
//3日後
$date1 = new DateTime($start_repeat);
echo '1日後<br>';
echo $date1->modify('+1 day')->format('Y-m-d');
echo '<br>';
echo '<br>';
//1週間後
$date2 = new DateTime($start_repeat);
echo '1週間後<br>';
echo $date2->modify('+7 day')->format('Y-m-d');
echo '<br>';
echo '<br>';
//3ヶ月後
$date2 = new DateTime($start_repeat);
echo '３ヶ月後<br>';
echo $date2->modify('+3 month')->format('Y-m-d');
echo '<br>';
echo '<br>';
//1年後
$date3 = new DateTime($start_repeat);
echo '1年後<br>';
echo $date3->modify('+1 year')->format('Y-m-d');
echo '<br>';
echo '<br>';
//2日ごとに日付を表示し、endrepeatで止める
echo '2日ごとに日付を表示し、endrepeatで止める<br>';

$date = new DateTime($start_repeat);
$end_point = new DateTime($end_repeat);

while($date < $end_point){
    echo $date->format('Y-m-d') . '<br>';
    $date->modify('+2 day')->format('Y-m-d');
}

require_once './tpl/'.basename(__FILE__);
?>