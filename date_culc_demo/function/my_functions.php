<?php

//------------------------------------------------------------
//●配列のカラム（縦列）を抜き出し配列で返す
//------------------------------------------------------------

function columnToArray ($array_list,$column_num){
   $generate_array = [];
   foreach($array_list as $array){
      $generate_array[] = $array[$column_num];
   }

   return $generate_array;
}

//------------------------------------------------------------
//●２数から大きい方を返す
//------------------------------------------------------------
function max_val($num1,$num2){
   return $num1 < $num2 ? $num2 : $num1;
}

//------------------------------------------------------------
//●２数から小さい方を返す
//------------------------------------------------------------
function min_val($num1,$num2){
   return $num1 > $num2 ? $num2 : $num1;
}

//------------------------------------------------------------
//●数値が２数の範囲に入っていればtrueを返す
//------------------------------------------------------------
function is_range($num1,$num2,$num3){
   return (min_val($num1,$num2) <= $num3 && $num3 <=max_val($num1,$num2));
}

//------------------------------------------------------------
//●文字数が２数の範囲に入っていればtrueを返す
//------------------------------------------------------------
function is_range_str($num1,$num2,$str){
   return is_range($num1,$num2,$str);
}

//------------------------------------------------------------
//●CSVファイルを読み込む
//------------------------------------------------------------

function open_csv($pass){
   $fp = fopen($pass,'r');
   $value = fgets($fp);
   $member = [];
   $flag = 0;
   
   while($value !== false){
      $flag = 1;
      $member[] = explode(",",$value);
      $value = fgets($fp);
   }
   fclose($fp);

   return $member;
}

//------------------------------------------------------------
//●CSVファイルを開き、縦列からその最大値を返す
//------------------------------------------------------------

function get_max_id($pass,$column){
   /* $fp = fopen($pass,'r');
   $value = fgets($fp);
   $array = [];
   $flag = 0;
   
   while($value !== false){
      $flag = 1;
      $array[] = explode(",",$value);
      $value = fgets($fp);
   }
   fclose($fp); */
   
   $array = [];
   $array = open_csv($pass);

   if(count($array) == 0){
      $Max = 0;
   }
   else{
      $Max = $array[0][$column];
   }
   
   for($i=1 ; $i<count($array) ; $i++){
      if($Max < $array[$i][$column]){
         $Max = $array[$i][$column];
      }
   }

   return $Max;
}


//------------------------------------------------------------
//●テキストファイルへ書き込む（書き込みが成功したらtrueを返す）
//------------------------------------------------------------
function writing_to_text($pass,$str){
   $msg = "";
   $fp = fopen($pass,'a');

   if(fputs($fp,$str."\n")){
      fclose($fp);
      return true;
   }
   else{
      fclose($fp);
      return false;
   }
}

//------------------------------------------------------------
//●テキストファイルへ書き込む（書き込みが成功したらtrueを返す）
//------------------------------------------------------------
function writing_to_newtext($pass,$str){
   $msg = "";
   $fp = fopen($pass,'w');

   if(fputs($fp,$str."\n")){
      fclose($fp);
      return true;
   }
   else{
      fclose($fp);
      return false;
   }
}

//------------------------------------------------------------
//●CSVファイルを開き、縦列からその最小値を返す
//------------------------------------------------------------

function get_min_id($pass,$column){

   $array = open_csv($pass);

   $Min = $array[0][$column];
   for($i=1 ; $i<count($array) ; $i++){
      if($Min > $array[$i][$column]){
         $Min = $array[$i][$column];
      }
   }

   return $Min;
}

//------------------------------------------------------------
//●_GETを用いてparameterを生成する
//------------------------------------------------------------

function url_parameter_generate($array){
   $url = "?";

   foreach($array as $key => $value){
      $url .= $key . "=" . $value . "&";
   }

   $url = substr($url,0,-1); //substr(str,0,-1)で末尾の文字を消去できる

   return $url;
}

//------------------------------------------------------------
//●改行を消す
//------------------------------------------------------------
function indention($str){
   $str = str_replace("\n","",$str);
   $str = str_replace("\r","",$str);
   return $str;
}

//------------------------------------------------------------
//●配列の中身に該当するデータがあれば該当する件数を返す。
//１件以上ある場合「件数」。０件の場合falseを返す。
//------------------------------------------------------------

function searchData($array,$column_num,$serch_ward){
   $hit = 0;
   foreach($array as $value){
      if($value[$column_num] == $serch_ward){
         $hit++;
      }
   }
   return $hit > 0 ? $hit : false ;
}

//--------------------------------------------------------------
//●２次元配列の物理削除
//主キーで消去するデータを決定します。
//--------------------------------------------------------------

function physicalDeletion($pass,$key){
   $data_array = open_csv($pass);
   $after_data_array = [];
   
   foreach($data_array as $value){
      //選択した主キーと異なる場合、書き写す
      if(!($value[0] == $key)){
         $after_data_array[] = $value;
      }
   }
   
   //テキストファイルの初期化
   $fg = fopen($pass,"w");
   fclose($fg);
   
   //物理消去したデータを書き出す
   foreach($after_data_array as $value){
      $data_string = indention(implode($value,","));
      writing_to_text($pass,$data_string);
   }
}

//--------------------------------------------------------------
//●２次元配列から検索語にヒットした列のみ取り出す
//配列で結果を返します。０件の場合falseを返します
//--------------------------------------------------------------

function get_array_by_search($array,$column_num,$str){
   $hit_array = [];
   foreach($array as $value){
      if($value[$column_num] == $str){
         $hit_array[] = $value;
      }
   }
   if(count($hit_array) == 0){
      return false;
   }
   else{
      return $hit_array;
   }
}

//--------------------------------------------------------------
//●主キーを元に書き換えを行う
//--------------------------------------------------------------
function update($pass,$array,$key){
   $hit = 0;
   $original_array = open_csv($pass);
   $new_array = [];
   foreach($original_array as $value){
      if($value[0] == $key){
         $array[0] = $key;  
         $new_array[] = $array;
         $hit = 1;
      }
      else{
         $new_array[] = $value;
      }
   }
   $fp = fopen($pass,'w');
   fclose($fp);
   foreach($new_array as $array){
      writing_to_text($pass,indention(implode($array,",")));
   }
}

//--------------------------------------------------------------
//●配列の深さを調べる
//--------------------------------------------------------------

function array_depth(array $array) {
    $max_depth = 1;
    foreach ($array as $value) {
        if (is_array($value)) {
            $depth = array_depth($value) + 1;
            if($depth > $max_depth){
                $max_depth = $depth;
            }
        }
    }
    return $max_depth;
}

//--------------------------------------------------------------
//●文字列ならば''を付けて返す
//--------------------------------------------------------------

function single_quote($value){
   if(is_numeric($value)){
      return $value;
   }
   elseif(is_string($value)){
      $return_value = "'".$value."'";
      return $return_value;
   }
   elseif(is_null($value)){
      return 'NULL';
   }
   else{
      return $value;
   }
}

//--------------------------------------------------------------
//●ファイル名を受け取りフォーマットを返す
//--------------------------------------------------------------
function filename_to_format($file_name){
   $divided_file_name = explode('.',$file_name);
   $file_format = $divided_file_name[count($divided_file_name) - 1];
   return strtolower($file_format);
}

//--------------------------------------------------------------
//●日付を表す文字列を指定フォーマットに変換し文字列で返す
//・第一引数：日付を表す文字列
//・第二引数：区切り文字
//・第三引数：返却地フォーマット
//例）引数が(19990525,,yyyy/mm/dd)の時、返却地は「1999/05/25」
//例）引数が('1999-05-25','-',yyyy年mm月dd日)の時、返却地は「1999年05月25日」
//例）引数が('1999/05/25','/',yyyy年)の時、返却地は「1999年」
//--------------------------------------------------------------

function date_format_change($date,$sep,$format){
   //変数の初期化
   $sep_date = [];
   //受け取った$dateは区切り文字が存在するか
   if(is_numeric($date)){
      //存在しない場合
      //与えられた数値は八桁であるか？
      if(!(strlen($date) == 8)){
         return false;
      }
      //4桁,2桁,2桁で区切る
      $sep_date['year'] = substr($date,0,4);
      $sep_date['month'] = substr($date,4,2);
      $sep_date['day'] = substr($date,6);
   }
   else{
      //存在する場合、与えられた区切り文字で文字を区切り配列にする
      $tmp = [];
      $tmp = explode($sep,$date);
      //$tmpの要素数が３つでない（＝年月日に正しく分割されていない）場合
      if(!(count($tmp) == 3)){
         return false;
      }
      //$tmpを$sep_dateに移行する
      $sep_date['year'] = $tmp[0];
      $sep_date['month'] = $tmp[1];
      $sep_date['day'] = $tmp[2];
   }
   //年月日が妥当であるか確認する
   if(!checkdate($sep_date['month'],$sep_date['day'],$sep_date['year'])){
      return false;
   }
   //与えられたフォーマットに変換して返す
   switch ($format){
      case 'yyyy/mm/dd':
         return $sep_date['year'].'/'.$sep_date['month'].'/'.$sep_date['day'];
      break;
      case 'mm/dd':
         return $sep_date['month'].'/'.$sep_date['day'];
      break;   
      case 'yyyy/mm':
         return $sep_date['year'].'/'.$sep_date['month'];
      break;
      case 'yyyy-mm-dd':
         return $sep_date['year'].'-'.$sep_date['month'].'-'.$sep_date['day'];
      break;
      case 'mm/dd':
         return $sep_date['month'].'-'.$sep_date['day'];
      break;
      case 'yyyy/mm':
         return $sep_date['year'].'-'.$sep_date['month'];
      break;
      case 'yyyy年mm月dd日':
         return intval($sep_date['year']).'年'.intval($sep_date['month']).'月'.intval($sep_date['day']).'日';
      break;
      case 'mm月dd日':
         return intval($sep_date['month']).'月'.intval($sep_date['day']).'日';
      break;
      case 'yyyy年mm月':
         return intval($sep_date['year']).'年'.intval($sep_date['month']).'月';
      break;
      case 'yyyy年':
         return intval($sep_date['year']).'年';
      break;
      case 'mm月':
         return intval($sep_date['month']).'月';
      break;
      case 'dd日':
         return intval($sep_date['day']).'日';
      break;
      case '和暦':
         return to_wareki('KX年',intval($sep_date['year'].$sep_date['month'].$sep_date['day']));
      break;
      default:
         return false;
   }
}

//福プログラム
//西暦を和暦に変換する
//引用元：https://qiita.com/r-fuji/items/53d3cf408f24848e507a

/**
 * 西暦→和暦変換
 *
 * @param string $format 'K':元号
 *                       'k':元号略称
 *                       'Q':元号(英語表記)
 *                       'q':元号略称(英語表記)
 *                       'X':和暦年(前ゼロ表記)
 *                       'x':和暦年
 * @param string $time 変換対象となる日付(西暦)‎
 *
 * @return string $result 変換後の日付(和暦)‎
 */

function to_wareki($format, $time='now')
{
    // 元号一覧
    $era_list = [
        // 令和(2019年5月1日〜)
        [
            'jp' => '令和', 'jp_abbr' => '令',
            'en' => 'Reiwa', 'en_abbr' => 'R',
            'time' => '20190501'
        ],
        // 平成(1989年1月8日〜)
        [
            'jp' => '平成', 'jp_abbr' => '平',
            'en' => 'Heisei', 'en_abbr' => 'H',
            'time' => '19890108'
        ],
        // 昭和(1926年12月25日〜)
        [
            'jp' => '昭和', 'jp_abbr' => '昭',
            'en' => 'Showa', 'en_abbr' => 'S',
            'time' => '19261225'
        ],
        // 大正(1912年7月30日〜)
        [
            'jp' => '大正', 'jp_abbr' => '大',
            'en' => 'Taisho', 'en_abbr' => 'T',
            'time' => '19120730'
        ],
        // 明治(1873年1月1日〜)
        // ※明治5年以前は旧暦を使用していたため、明治6年以降から対応
        [
            'jp' => '明治', 'jp_abbr' => '明',
            'en' => 'Meiji', 'en_abbr' => 'M',
            'time' => '18730101'
        ],
    ];

    $dt = new DateTime($time);

    $format_K = '';
    $format_k = '';
    $format_Q = '';
    $format_q = '';
    $format_X = $dt->format('Y');
    $format_x = $dt->format('y');

    foreach ($era_list as $era) {
        $dt_era = new DateTime($era['time']);
        if ($dt->format('Ymd') >= $dt_era->format('Ymd')) {
            $format_K = $era['jp'];
            $format_k = $era['jp_abbr'];
            $format_Q = $era['en'];
            $format_q = $era['en_abbr'];
            $format_X = sprintf('%02d', $format_x = $dt->format('Y') - $dt_era->format('Y') + 1);
            break;
        }
    }

    $result = '';

    foreach (str_split($format) as $val) {
        // フォーマットが指定されていれば置換する
        if (isset(${"format_{$val}"})) {
            $result .= ${"format_{$val}"};
        } else {
            $result .= $dt->format($val);
        }
    }

    return $result;
}

//--------------------------------------------------------------
//●連想配列のキーからその要素が何番目なのか返す
//--------------------------------------------------------------

function key_to_num($array,$index){
   if(!$index){
      return 99999;
   }
   $i = 0;
   foreach($array as $key => $value){
      if($key == $index){
         break;
      }
      $i++;
   }
   return $i;
}

//--------------------------------------------------------------
//●画像のパス名を受け取り存在しなければNo imageのパスを返す
//--------------------------------------------------------------

function no_image($img_pass,$no_img_pass){
   if(file_exists($img_pass)){
      return $img_pass;
   }
   else{
      return $no_img_pass;
   }
}

//--------------------------------------------------------------
//●URLパラメータを作成する
//--------------------------------------------------------------

function make_parameter($array){
   $copy_array = $array;
   unset($copy_array['page_num']);
   $parameter = '&';
   $i = 0;
   foreach($copy_array as $key => $value){
      if($i > 0){
         $parameter .= '&';
      }
      $parameter .= $key.'='.$value;
      $i ++;
   }
   return $parameter;
}

?>