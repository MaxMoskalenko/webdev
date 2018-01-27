<?php
  $mesText = $_GET['text'];
  $user = $_GET['user'];
  date_default_timezone_set("Europe/Kiev");
  $date = date("h:i:sa");
  $fullDate = date('Y-m-d H:i:s');
  $list = json_decode(file_get_contents('corr.json'),TRUE);
  $fullMes = '['.$date.'] '.$user.' : '.$mesText;
  $list[] = array('date' => $fullDate, 'mes' => $fullMes);
  file_put_contents('corr.json',json_encode($list));
  unset($list);
  echo $fullMes;
 ?>
