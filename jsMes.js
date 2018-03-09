var corrSize = 1;
function logging() {
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var ans = xhttp.responseText;
      console.log(ans)
    }
  };
  xhttp.open("GET", "xhttp/logs.php?user="+user, false);
  xhttp.send();
}
logging();

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
    xhttp.open("GET", "xhttp/crOldCorr.php?curMes="+i, false);
    xhttp.send();
  }
  for (var i = 0; i < corrSize; i++) {
    send(i);
}
}
oldCorr();


function addtext() {
  var xhttp;
  var text = document.getElementById('text').value;
  var gsm = document.getElementById('gsmile').innerHTML;
  var bsm = document.getElementById('bsmile').innerHTML;
  text = text.replace(/:-\)/g, gsm);
  text = text.replace(/:-\(/g, bsm);
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
    }
  };
  xhttp.open("GET", "xhttp/makeMes.php"+queryString, true);
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
