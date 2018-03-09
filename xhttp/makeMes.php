<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = 'userlist';
  $mesText = $_GET['text'];
  $user = $_GET['user'];

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  date_default_timezone_set("Europe/Kiev");
  $date = date("h:i:sa");
  $fullDate = date('Y-m-d H:i:s');
  $fullMes = '['.$date.'] '.$user.' : '.$mesText;

  $sql = "INSERT INTO messages (message, time)
  VALUES ('$fullMes', '$fullDate')";

  mysqli_query($conn, $sql);
  echo $fullMes;

  mysqli_close($conn);
 ?>
