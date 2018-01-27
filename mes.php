<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Joti+One|Montserrat" rel="stylesheet">
  <title>Document</title>
  <style media="screen">
  .chatText{
    font-size: 50px;
    font-family: 'Joti One', cursive;
  }
  body{
    position: relative;
    display: flex;
    justify-content: center;
    background-color: #34495e;
    color: #ecf0f1;
  }
  .center{
    width: 700px;
    height: 420px;
    position: absolute;
    top: 150px;
  }
  #textarea{
    width: auto;
    height: 340px;
    margin: 10px 30px;
    background-color: #ecf0f1;
    color: black;
    padding: 10px;
    overflow: scroll;
    position: relative;
  }
  .form{
    width: auto;
    height: 35px;
    display: flex;
    align-items: center;
  }
  textarea{
    margin: 0px 30px;
    background-color: #ecf0f1;
  }
  button{
    margin: 10px 0px;
    height: 30px;
    width: 100px;
    font: bold 20px 'Montserrat', sans-serif;
    background: linear-gradient(to bottom right, #696969, #A9A9A9);
    border: none;
    color: #ecf0f1;
  }
  .mesText{
    font: bold 14px 'Montserrat', sans-serif;
    width: 320px;
    position: static;

  }
  </style>
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
      $list = (array)json_decode(file_get_contents('corr.json'),TRUE);
      $num = count($list);
      function qwerty($num)
      {
        return $num;
      }
      $q = qwerty($num);
   ?>
  <script type="text/javascript">
    var newMes =  0;
    var corrSize = <?php echo $num?>;
    //-----------------------------------------------------------------------------------------
    function oldCorr() {
     var newDIV = document.createElement('DIV');
     var oldDIV = document.getElementById('textarea');
     newDIV.id = 'textarea';
     document.getElementById('smth').replaceChild(newDIV, oldDIV);
      function send(i) {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var message = document.createElement('P');
            var ans = xhttp.responseText;
            ans = JSON.parse(ans);
            fullText = ans[0].mes;
            corrSize = ans[0].size;
            message.innerHTML = fullText;
            message.className = "mesText";
            message.id = 'a';
            document.getElementById("textarea").appendChild(message);

          }
        };
        xhttp.open("GET", "crOldCorr.php?curMes="+i, false);
        xhttp.send();
      }
      for (var i = 0; i < corrSize; i++) {
        send(i);
    }
  }
    oldCorr();
//-------------------------------------------------------------------------------------------
    function addtext() {
      var xhttp;
      var text = document.getElementById('text').value;
      var gsm = document.getElementById('gsmile').innerHTML;
      var bsm = document.getElementById('bsmile').innerHTML;
      text = text.replace(/:-\)/g, gsm);
      text = text.replace(/:-\(/g, bsm);
      var user = '<?php echo $userName; ?>';
      var queryString = "?text=" + text + "&user=" + user;


      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var message = document.createElement('P');
          var fullText = xhttp.responseText;
          message.innerHTML = fullText;
          message.className = "mesText";
          message.id = 'a';
          document.getElementById("textarea").appendChild(message);
          newMes++;
        }
      };
      xhttp.open("GET", "makeMes.php"+queryString, true);
      xhttp.send();
      document.getElementById('text').value = '';
    }
    var timerId = setInterval(function() {
      oldCorr();
    }, 5000);

    document.getElementById("text")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("send").click();
    }
    });

  </script>
</body>
</html>
