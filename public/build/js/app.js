const icon=document.getElementById("togglePassword"),icon2=document.getElementById("togglePassword2");let password=document.getElementById("password"),password2=document.getElementById("password2");icon.addEventListener("click",(function(){"password"===password.type?(password.type="text",icon.classList.add("fa-eye-slash"),icon.classList.remove("fa-eye")):(password.type="password",icon.classList.add("fa-eye"),icon.classList.remove("fa-eye-slash"))})),icon2.addEventListener("click",(function(){"password"===password2.type?(password2.type="text",icon2.classList.add("fa-eye-slash"),icon2.classList.remove("fa-eye")):(password2.type="password",icon2.classList.add("fa-eye"),icon2.classList.remove("fa-eye-slash"))}));const mobileMenuBtn=document.querySelector("#mobile-menu"),cerrarMenuBtn=document.querySelector("#cerrar-menu"),sidebar=document.querySelector(".sidebar");mobileMenuBtn&&mobileMenuBtn.addEventListener("click",(function(){sidebar.classList.toggle("mostrar")})),cerrarMenuBtn&&cerrarMenuBtn.addEventListener("click",(function(){sidebar.classList.add("ocultar"),setTimeout(()=>{sidebar.classList.remove("mostrar"),sidebar.classList.remove("ocultar")},800)}));const anchoPantalla=document.body.clientWidth;window.addEventListener("resize",(function(){document.body.clientWidth>=768&&sidebar.classList.remove("mostrar")}));