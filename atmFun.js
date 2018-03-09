var ATM = {
    is_auth: false,
    current_user: false,
    current_type: false,

    // all cash of ATM
    cash: 2000,
    report: '',
    // all available users
    users: [
        {number: "0000", pin: "0000", debet: 1000000, type: "admin"}, // EXTENDED
        {number: "0001", pin: "1234", debet: 675, type: "user"},
        {number: "0002", pin: "4321", debet: 1000, type: "user"}
    ],
    // authorization
    auth: function(number, pin) {
      for (var i = 0; i < ATM.users.length; i++) {
        if (number == ATM.users[i].number) {
          if (pin == ATM.users[i].pin) {
            console.log("Correct password");
            ATM.is_auth = true;
            ATM.current_user = i;
            ATM.current_type = ATM.users[i].type;
            ATM.report += ATM.current_type + ' #' + ATM.current_user + ' entered in system\n';
          }
          else {
            console.log("Incorrect password");
          }
        }
      }
    },
    // check current debet
    check: function() {
      if(ATM.is_auth){
        console.log('You have: ' + ATM.users[ATM.current_user].debet);
        ATM.report += ATM.current_type + ' #' + ATM.current_user + ' check balance\n';
      }
      else {
        console.log('Log first');
      }
    },
    // get cash - available for user only
    getCash: function(amount) {
      if(ATM.is_auth && ATM.current_type == 'user'){
        if (amount<=ATM.users[ATM.current_user].debet && amount>=0) {
          if (amount<=ATM.cash) {
            ATM.cash -= amount;
            ATM.users[ATM.current_user].debet -= amount;
            console.log('You get ' + amount);
            ATM.report += ATM.current_type + ' #' + ATM.current_user + ' get '+ amount +'\n';
          }
          else {
            console.log('ATM doesn\'t have such sum of money');
          }
        }
        else {
          console.log('You don\'t have such sum of money');
        }
      }
      else {
        console.log('Log first');
      }
    },
    // load cash - available for user only
    loadCash: function(amount){
      if(ATM.is_auth && ATM.current_type == 'user'){
            ATM.cash += amount;
            ATM.users[ATM.current_user].debet += amount;
            console.log('You load ' + amount);
            ATM.report += ATM.current_type + ' #' + ATM.current_user + ' load '+ amount +'\n';
      }
      else {
        console.log('Log first');
      }
    },
    // load cash to ATM - available for admin only - EXTENDED
    load_cash: function(addition) {
      if (ATM.is_auth && ATM.current_type == 'admin') {
        ATM.cash += addition;
        console.log('Admin load ' + addition);
        ATM.report += 'Admin' + ATM.current_user + ' load '+ addition +' in ATM\n';
      }
    },
    // get report about cash actions - available for admin only - EXTENDED
    getReport: function() {
      if (ATM.is_auth && ATM.current_type == 'admin') {
        console.log(ATM.report);
      }
      else {
        console.log('Log first');
      }
    },
    // log out
    logout: function() {
      if (ATM.is_auth) {
        ATM.report += ATM.current_type + ' #' + ATM.current_user + ' exit from system\n';
        ATM.is_auth = false;
        ATM.current_user = false;
        ATM.current_type = false;
      }
      else {
        console.log('Log first');
      }
    }
};
