function validatePassword() {
var username,currentPassword,newPassword,confirmPassword,output = true;

username = document.getElementsByName("username")[0];
currentPassword = document.getElementsByName("currentPassword")[0];
newPassword = document.getElementsByName("newPassword")[0];
confirmPassword = document.getElementsByName("confirmPassword")[0];

    
if(!username.value){
username.focus();
document.getElementById("username").innerHTML = "required";
output = false;
}
else if(!currentPassword.value) {
currentPassword.focus();
document.getElementById("currentPassword").innerHTML = "required";
output = false;
}
else if(!newPassword.value) {
newPassword.focus();
document.getElementById("newPassword").innerHTML = "required";
output = false;
}
else if(!confirmPassword.value) {
confirmPassword.focus();
document.getElementById("confirmPassword").innerHTML = "required";
output = false;
}
else if(newPassword.value != confirmPassword.value) {
newPassword.value="";
confirmPassword.value="";
newPassword.focus();
document.getElementById("confirmPassword").innerHTML = "not same";
output = false;
} 
 console.log("Hit");   
return output;
}