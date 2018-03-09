function enter() {
  var login = document.getElementById('log').value;
  var password = document.getElementById('pas').value;
  var queryString = "?login=" + login;

  queryString +=  "&password=" + password;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var answer = xhttp.responseText;
      answer = Number(answer);
      switch(answer) {
        case 1:
          document.location.href="mes.php?log_user=" + login;
          break;
        case 2:
          alert("Wrong password");
          break;
        case 3:
          alert("Welcome to chat");
          document.location.href="mes.php?log_user=" + login;
          break;
        default:
          alert("Ooops");
      }
    }
  };
  xhttp.open("GET", "xhttp/siginSQL.php"+queryString, true);
  xhttp.send();
}
