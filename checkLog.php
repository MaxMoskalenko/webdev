<?php
  $login = $_GET['login'];
  $password = $_GET['password'];
  $dataBase = json_decode(file_get_contents('userBase.json'),TRUE);
  $size = count($dataBase);
  $newUser = true;
  if ($size == 0) {
    $dataBase[] = array('login'=>$login, 'password'=>$password);
    file_put_contents('userBase.json',json_encode($dataBase));
    $answer = 3;
    $newUser = false;
  }
  else {
    for ($i=0; $i < $size; $i++) {
      $curUser = (object)$dataBase[$i];
      if ($login == $curUser->login) {
        $newUser = false;
        if($password == $curUser->password){
          $answer = 1;
        }
        else {
          $answer = 2;
        }
      }
    }
  }
  if ($newUser) {
    $dataBase[] = array('login'=>$login, 'password'=>$password);
    file_put_contents('userBase.json',json_encode($dataBase));
    $answer = 3;
  }
  echo $answer;
 ?>
