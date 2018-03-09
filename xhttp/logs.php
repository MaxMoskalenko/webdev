<?php
$user =  $_GET['user'];
date_default_timezone_set("Europe/Kiev");
$time = (string)date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$logs = 'logs.dat';
$log = file_get_contents($logs);
$log .= "User: ".$user." entered in system in ".$time." ip: ".$ip."\n";
file_put_contents($logs, $log);
echo $log;
 ?>
