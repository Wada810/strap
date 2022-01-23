<?php

//----------------------------------------------
//●linkを受け取りresultを返す
//◆引数：result
//◆返却値：
//データ件数が０件 => false
//データ件数が０件でない => 二次元配列
//----------------------------------------------

function db_run($link,$sql){
   //接続に失敗した場合
   if(!$link){
      header('location:./tpl/error.php?code=001');
      exit;
   }
   //文字設定
   mysqli_set_charset($link,'utf8');
   //SQL文の実行
   $result = mysqli_query($link,$sql);
   //DBの切断
   mysqli_close($link);
   //SQLをうまく実行出来なかった
   if(!$result){
      header('location:./tpl/error.php?code=002&sql='.$sql);
      exit;
   }
   else{
      return $result;
   }
}

//----------------------------------------------
//●linkを受け取りresultを返す
//◆引数：result
//◆返却値：
//データ件数が０件 => false
//データ件数が０件でない => 二次元配列
//----------------------------------------------

function db_run_insert($link,$sql){
   //接続に失敗した場合
   if(!$link){
      header('location:./tpl/error.php?code=001');
      exit;
   }
   //文字設定
   mysqli_set_charset($link,'utf8');
   //SQL文の実行
   $result = mysqli_query($link,$sql);
   $id = mysqli_insert_id($link);
   //DBの切断
   mysqli_close($link);
   //SQLをうまく実行出来なかった
   if(!$result){
      header('location:./tpl/error.php?code=002&sql='.$sql);
      exit;
   }
   else{
      return $id;
   }
}

//----------------------------------------------
//●resultをフェッチして２次元配列を返す
//◆引数：result
//◆返却値：
//データ件数が０件 => false
//データ件数が０件でない => 二次元配列
//----------------------------------------------

function get_data($result){
   //配列に変換し格納
   $data = [];
   $value = mysqli_fetch_assoc($result);
   $flag = 0;
   while(!is_null($value)){
      $flag = 1;
      $data[] = $value;
      $value = mysqli_fetch_assoc($result);
   }
   //件数が０でない場合、データを返す
   if($flag == 0){
      return false;
   }
   elseif($flag == 1){
      return $data;
   }
}

//----------------------------------------------
//●インサート文を生成する
//----------------------------------------------

function create_insert_sql($table,$colomn,$data){
   $sql = "INSERT INTO ".$table;
   $sql .= " (".$colomn[0];
   for($i=1;$i<count($colomn);$i++){
      $sql .= ','.$colomn[$i];
   }
   $sql .= ") VALUES ";
   if(array_depth($data) == 1){
      $sql .= "(".single_quote($data[0]);
      for($i=1;$i<count($data);$i++){
         $sql .= ','.single_quote($data[$i]);
      }
      $sql .= ");";
   }
   elseif(array_depth($data) == 2){

      $sql .= "(".single_quote($data[0][0]);
      for($i=1;$i<count($data[0]);$i++){
         $sql .= ','.single_quote($data[0][$i]);
      }
      $sql .= ")";

      for($i=1;$i<count($data);$i++){
         $sql .= ",(".single_quote($data[$i][0]);
         for($j=1;$j<count($data[$i]);$j++){
            $sql .= ','.single_quote($data[$i][$j]);
         }
         $sql .= ")";
      }
      $sql .= ";";
   }
   else{
      return false;
   }

   return $sql;
}

//----------------------------------------------
//●アップデート文を生成する
//----------------------------------------------

function create_update_sql($table,$colomn,$data,$conditions){
   $sql = "UPDATE ".$table;
   $sql .= " SET ".$colomn[0]." = ".single_quote($data[0])." ";
   for($i=1;$i<count($colomn);$i++){
      $sql .= ",".$colomn[$i]." = ".single_quote($data[$i]);
   }
   $sql .= " WHERE ".$conditions.";";
   return $sql;
}

//-----------------------------------------------
//●ANDによる絞り込み検索からセレクト文を作成する
//第一引数…テーブル名
//第二引数…[カラム名,演算子,値]を格納した２次元配列
//第三引数…取り出すカラムを格納した１次元配列
//-----------------------------------------------

function create_select_sql($table,$conditions,$select = ['*']){
   $sql = 'SELECT';
   foreach($select as $key => $value){
      if($key > 0){
         $sql .= ',';
      }
      $sql .= ' '.$value.' ';
   }
   $sql .= ' FROM '.$table.' WHERE';
   foreach($conditions as $key => $value){
      if($key > 0){
         $sql .= 'AND';
      }
      $sql .= ' ';
      foreach($value as $key => $values){
         if($key == 2){
            $sql .= single_quote($values).' ';
         }
         else{
            $sql .= $values.' ';
         }
      }
   }
   //$sql .= ';';
   return $sql;
}

//-----------------------------------------------
//●SQL文にORDER BY句を付ける
//-----------------------------------------------

//templateからスケジュールのインスタンスを生成、登録
function embody_schedule(){
   //--データベースに接続する
   $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
   $query = "SELECT * FROM personal_schedule_template WHERE user_id = " . $_COOKIE["login"] .
   " ORDER BY id DESC
   LIMIT 1;";
   $data = mysqli_fetch_assoc(mysqli_query($link,$query));
   var_dump($data);
   $template_id = $data["id"];
   $title = $data["title"];
   $explanation = $data["explanation"];
   $category = $data["category"];

   $end_repeat = new DateTime($data["end_repeat"]);
   $start = new DateTime(date("Y-m-d") . " " .  $data["start"]);
   $end = new DateTime($data["end"]);

   if($_POST["repeat_every"] == "no"){
      $query = "INSERT INTO personal_schedule (template_id, user_id, title, explanation, start, end, category) VALUES (" . $template_id . ", " . $_COOKIE["login"] . ", '" . $title . "', '" . $explanation . "', '" . $start->format("Y-m-d H:i:s") . "', '" . $end->format("Y-m-d H:i:s") . "', '" . $category . "')";
      $result = mysqli_query($link,$query);
      //SQLをうまく実行出来なかった
      if(!$result){
         mysqli_close($link);
         header('location:./tpl/error.php?code=002&sql='.$query);
         exit;
      }
   }else{
      $valid = true;
      while($valid){
         $query = "INSERT INTO personal_schedule (template_id, user_id, title, explanation, start, end, category) VALUES (" . $template_id . ", " . $_COOKIE["login"] . ", '" . $title . "', '" . $explanation . "', '" . $start->format("Y-m-d H:i:s") . "', '" . $end->format("Y-m-d H:i:s") . "', '" . $category . "')";
         $result = mysqli_query($link,$query);
         //SQLをうまく実行出来なかった
         if(!$result){
            mysqli_close($link);
            var_dump($query);
            header('location:./tpl/error.php?code=002');
            exit;
         }
         $modifier = "+" . $data["repeat_frequency"] . " " . $data["repeat_every"];
         $start->modify($modifier);
         $end->modify($modifier);
         if($end_repeat < $start){
            $valid = false;
         }
      }
   }
   return true;
}
function get_p_s($modifier=""){
   if($modifier != ""){
      $mod = new DateTime();
      $mod->modify("+" . $modifier . " weeks");
      $modifier = $mod->format("Y-m-d");
   }
   $start = new DateTime($modifier);
   $end = new DateTime($modifier);
   $start->modify("Monday this week");
   $end->modify("Monday next week");
   $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
   $query = "SELECT * FROM personal_schedule
   WHERE user_id = " . $_COOKIE["login"] . "
   AND start BETWEEN '" . $start->format("Y-m-d") . "' AND '" . $end->format("Y-m-d") . "'";
   //var_dump($query);
   $result = db_run($link,$query);
   return get_data($result);
}
function get_c_d($modifier=""){
   if($modifier != ""){
      $mod = new DateTime();
      $mod->modify("+" . $modifier . " weeks");
      $modifier = $mod->format("Y-m-d");
   }
   $list = [];
   $day = new DateTime($modifier);
   $day->modify("Monday this week");
   for($i = 0; $i < 7; $i ++){
      $list[] = $day->format("m/d");
      $day->modify("+1 days");
   }
   return $list;
}
//block_idの最新のstateを確認し変更
function change_single_state($block_id){
   //--データベースに接続する
   $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
   $query = "SELECT * FROM personal_block WHERE block_id = " . $block_id;
   $result = db_run($link,$query);
   $list = get_data($result);
   $availability = 0;
   foreach($list as $val){
      if($val["state"] == 1){
         $availability ++;
      }
   }
   $availability = $availability / count($list) * 100;
   $query = "UPDATE `block` SET `state` = ";
   if($availability >= 100){
      $query .= "1";
   }elseif($availability <= 50){
      $query .= "0";
   }else{
      $query .= "2";
   }
   $query .= " WHERE id = " . $block_id;
   //--データベースに接続する
   $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
   db_run($link,$query);
   return true;
}
function get_g_b($modifier=""){
   if($modifier != ""){
      $mod = new DateTime();
      $mod->modify("+" . $modifier . " weeks");
      $modifier = $mod->format("Y-m-d");
   }
   $start = new DateTime($modifier);
   $end = new DateTime($modifier);
   $start->modify("Monday this week");
   $start->setTime(0,0,0);
   $end->modify("Monday next week");
   $end->setTime(0,0,0);
   $link = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
   $query = "SELECT * FROM block
    WHERE user_id = " . $_COOKIE["login"] . "
   AND start BETWEEN '" . $start->format("Y-m-d H:i:s") . "' AND '" . $end->format("Y-m-d H:i:s") . "'";
   //var_dump($query);
   $result = db_run($link,$query);
   return get_data($result);
}
?>