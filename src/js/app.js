const icon = document.getElementById('togglePassword');
const icon2 = document.getElementById('togglePassword2');
let password = document.getElementById('password');
let password2 = document.getElementById('password2');

/* Event fired when <i> is clicked */
icon.addEventListener('click', function() {
  if(password.type === "password") {
    password.type = "text";
    icon.classList.add("fa-eye-slash");
    icon.classList.remove("fa-eye");
  }
  else {
    password.type = "password";
    icon.classList.add("fa-eye");
    icon.classList.remove("fa-eye-slash");
  }
});
icon2.addEventListener('click', function() {
    if(password2.type === "password") {
      password2.type = "text";
      icon2.classList.add("fa-eye-slash");
      icon2.classList.remove("fa-eye");
    }
    else {
      password2.type = "password";
      icon2.classList.add("fa-eye");
      icon2.classList.remove("fa-eye-slash");
    }
  });

