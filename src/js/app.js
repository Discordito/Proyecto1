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





const mobileMenuBtn = document.querySelector('#mobile-menu');
const cerrarMenuBtn = document.querySelector('#cerrar-menu');
const sidebar = document.querySelector('.sidebar');

if(mobileMenuBtn){
    mobileMenuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('mostrar');
    })
}
if(cerrarMenuBtn){
    cerrarMenuBtn.addEventListener('click', function(){
        sidebar.classList.add('ocultar');
        setTimeout(() => {
            sidebar.classList.remove('mostrar');
            sidebar.classList.remove('ocultar');
        }, 800);
    });
}

//eliminar la clase de mostrar en tamasño tablet
const anchoPantalla = document.body.clientWidth;
window.addEventListener('resize', function() {
    const anchoPantalla = document.body.clientWidth;
    if(anchoPantalla >= 768){
        sidebar.classList.remove('mostrar');
    }
});