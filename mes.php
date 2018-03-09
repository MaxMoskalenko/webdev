<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Joti+One|Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="CSS/cssMes.css">
  <title>Document</title>
</head>
<body>
  <p class="chatText">Chat
    <p id="gsmile" class="chatText">&#128515;</p>
    <p id="bsmile" class="chatText">&#128532;</p>
  </p>
  <div class="center">
    <div id = "smth">
      <div id="textarea">

      </div>
    </div>
    <div class="form">
      <textarea id="text" name="text" rows="2" cols="60"></textarea>
      <button id="send" onclick="addtext()" name="button" type="button">Send</button>
    </div>
  </div>
  <?php
      $userName = $_GET['log_user'];
      echo "<script href=\"jsMes.js\">
        var user='$userName';
      </script>";
   ?>
  <script src = "jsMes.js"></script>
</body>
</html>
