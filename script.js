function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

function signup() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var password = document.getElementById("password");
  var mobile = document.getElementById("mobile");
  var gender = document.getElementById("gender");

  var form = new FormData();
  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("m", mobile.value);
  form.append("g", gender.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          var response = request.responseText;

          if (response == "success") {
              document.getElementById("msg").innerHTML = "Registration Successfull";
              document.getElementById("msg").className = "alert alert-success";
              document.getElementById("msgdiv").className = "d-block";
          } else {
              document.getElementById("msg").innerHTML = response;
              document.getElementById("msgdiv").className = "d-block";
          }

      }
  }

  request.open("POST", "signupProcess.php", true);
  request.send(form);
}

function signin() {

  var email = document.getElementById("email2");
  var password = document.getElementById("password2");
  var rememberme = document.getElementById("rememberme");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("r", rememberme.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          var response = request.responseText;

          if (response == "success") {
              window.location = "home.php";
          } else {
              document.getElementById("msg1").innerHTML = response;
              document.getElementById("msgdiv1").className = "d-block";
          }

      }
  }

  request.open("POST", "signInProcess.php", true);
  request.send(form);

}

var forgotPasswordModal;

function forgotPassword() {

  var email = document.getElementById("email2");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          var text = request.responseText;

          if (text == "Success") {
              alert("Verification code has sent successfully. Please check your Email.");
              var modal = document.getElementById("fpmodal");
              forgotPasswordModal = new bootstrap.Modal(modal);
              forgotPasswordModal.show();
          } else {
              document.getElementById("msg1").innerHTML = text;
              document.getElementById("msgdiv1").className = "d-block";
          }

      }
  }

  request.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
  request.send();

}


function showPassword1(){

  var textfield = document.getElementById("np");
  var button = document.getElementById("npb");

  if(textfield.type == "password"){
      textfield.type = "text";
      button.innerHTML = "Hide";
  }else{
    textfield.type = "password";
      button.innerHTML = "Show";
  }

}

function showPassword2(){

  var textfield = document.getElementById("rnp");
  var button = document.getElementById("rnpb");

  if(textfield.type == "password"){
      textfield.type = "text";
      button.innerHTML = "Hide";
  }else{
    textfield.type = "password";
      button.innerHTML = "Show";
  }

}

function resetPassword(){

  var email = document.getElementById("email2");
  var newPassword = document.getElementById("np");
  var retypePassword = document.getElementById("rnp");
  var Verification = document.getElementById("vcode");

  var form = new FormData();

  form.append('e',email.value);
  form.append('n',newPassword.value);
  form.append('r',retypePassword.value);
  form.append('v', Verification.value);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function(){
    if(request.readyState === 4 && request.status === 200){

      var response = request.responseText;
      if(response == "success"){
        alert("Password Updated Successfully.");
        forgotPasswordModal.hide();
      }else {
        alert(response);
      }

    }
  }
  request.open('POST','resetPasswordProcess.php', true);
  request.send(form);

}