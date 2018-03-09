<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'userlist';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$curMes = $_GET['curMes'];

  $sql = 'SELECT * FROM messages';
  $table = mysqli_query($conn, $sql);
  $size = mysqli_num_rows($table);
  for ($i=0; $i < $size; $i++) {
    $curRow = mysqli_fetch_row($table);
    if ($i == $curMes) {
      $mes = $curRow[0];
      $time = $curRow[1];
    }
  }
  date_default_timezone_set("Europe/Kiev");
  $fdate = (string)date($time);
  $sdate = (string)date('Y-m-d H:i:s');
  $sdate = new DateTime($sdate);
  $fdate = new DateTime($fdate);
  $interval = date_diff($sdate, $fdate);
  if ($interval->format('%H')>= '1' || $interval->format('%d')>= '1') {
    $sql= "DELETE FROM messages
          WHERE message = '$mes'";
    mysqli_query($conn, $sql);
   }
  else {
    $result[] = array('size' => $size, 'mes' => $mes);
    $result = json_encode($result);
    echo $result;
  }
mysqli_close($conn);
 ?>
