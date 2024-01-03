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

function signout(){
  
    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
      if(request.readyState === 4 && request.status === 200){

        var response = request.responseText;

        if(response == "success"){
          window.location.reload();
        }

      }
    }

    request.open('GET','signOutProcess.php', true);
    request.send();

}

function changeProfileImg(){
  var img = document.getElementById("profileimage");
  
  img.onchange = function(){
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);

    document.getElementById("img").src = url;
  }

}

function updateProfile(){
  
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var province = document.getElementById("province");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var pcode = document.getElementById("pcode");
  var image = document.getElementById("profileimage");

  var form = new FormData();

  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("m", mobile.value);
  form.append("l1", line1.value);
  form.append("l2", line2.value);
  form.append("p", province.value);
  form.append("d", district.value);
  form.append("c", city.value);
  form.append("pc", pcode.value);
  form.append("i", image.files[0]);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function(){
    if(request.readyState === 4 && request.status === 200){
      
      var response = request.responseText;

      if(response == "Updated" || response == "Saved"){
        window.location.reload();
      }
      
      else if(response == "You have not selected any image."){
        alert("You have not selected any image.");
        window.location.reload();
      }

      else{
        alert(response);
      }

    }
  }

  request.open("POST","updateProfileProcess.php",true);
  request.send(form);

}

function addProduct(){

  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var title = document.getElementById("title");
  var condition = 0;
  
  if(document.getElementById("b").checked){
    condition = 1;
  }else if(document.getElementById("u").checked){
    condition = 2;
  }

  var color = document.getElementById("clr");
  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var desc = document.getElementById("desc");
  var image = document.getElementById("imageuploader");


  var form = new FormData();
  form.append("ca",category.value);
  form.append("b",brand.value);
  form.append("m",model.value);
  form.append("t",title.value);
  form.append("con",condition);
  form.append("col",color.value);
  form.append("q",qty.value);
  form.append("co",cost.value);
  form.append("dwc",dwc.value);
  form.append("doc",doc.value);
  form.append("de",desc.value);


  var file_count = image.files.length;
  
  for(var x = 0; x< file_count; x++){

      form.append("image"+x,image.files[x]);

  }


  var request = new XMLHttpRequest();

  request.onreadystatechange = function (){

    if(request.readyState==4 & request.status==200){

      var response = request.responseText;
      
      if(response == "success"){
        alert("Product successfully added");
        window.location.reload();
      }else{
        alert(response);
      }

    }

  }

  request.open("POST","addProductProcess.php",true);
  request.send(form);



}

function changeProductImage(){

  var image = document.getElementById("imageuploader");
  
  image.onchange = function(){

    var file_count = image.files.length;
    
    if(file_count <= 3){

      for(var x; x < file_count; x++){
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i"+x).src = url;
      }

    }else{
      alert(file_count+" files You are proceed to upload to upload only 3 or less than 3 files");
    }

  }

}