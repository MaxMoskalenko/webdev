<?php
  $curMes = $_GET['curMes'];
  $list = json_decode(file_get_contents('corr.json'),TRUE);
  $message = (object)$list[$curMes];
  $a = count($list);
  date_default_timezone_set("Europe/Kiev");
  $fdate = (string)date($message->date);
  $sdate = (string)date('Y-m-d H:i:s');
  $sdate = new DateTime($sdate);
  $fdate = new DateTime($fdate);
  $interval = date_diff($sdate, $fdate);
  if ($interval->format('%H')>= '1' || $interval->format('%d')>= '1') {
    array_shift($list);
    file_put_contents('corr.json',json_encode($list));
    unset($list);
  }
  else {
    $smth[] = array('size' => $a, 'mes' => $message->mes);
    $smth = json_encode($smth);
    echo $smth;
  }
  //echo gettype($sdate); //$interval->format('%j');
//   if($list->date < $date && )
//   echo $list->mes;
 ?>
