<?php
$servername = "localhost";
$username = "root";
$password = "";   //rSJ7ezzhCIDUonMw
$dbname = 'userlist';
$log = $_GET['login'];
$pass = $_GET['password'];

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = 'SELECT * FROM chatusers';
$table = mysqli_query($conn, $sql);

$size = mysqli_num_rows($table);

 $newUser = true;
 if ($size == 0) {
   $sql = "INSERT INTO chatusers (login, password)
   VALUES ('$log', '$pass')";
   if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
   } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }
  $answer = 3;
  $newUser = false;
 }
 else {
     for ($i = 0; $i < $size; $i++) {
         $curUser = mysqli_fetch_row($table); // 0-id, 1-login, 2-password
         if ($log == $curUser[1]) {
             $newUser = false;
             if ($pass == $curUser[2]) {
                 $answer = 1;
             } else {
                 $answer = 2;
             }
         }
     }
 }
 if ($newUser) {
   $sql = "INSERT INTO chatusers (login, password)
   VALUES ('$log', '$pass')";
   if (mysqli_query($conn, $sql)) {
    $answer = 3;
   } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }
 }
 echo $answer;


mysqli_close($conn);


 ?>
