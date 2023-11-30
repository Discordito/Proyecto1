const moment = require("moment/moment");

(function(){  

const btnRegistro = document.querySelector('#registrar');
btnRegistro.addEventListener('click', function() {
    var now = new Date();
    now = moment(now).format('YYYY-MM-DD HH:mm:ss');
    document.getElementById("mydata").setAttribute('value', now);
});
const btnPago = document.querySelector('#paypal-button-container');
btnPago.addEventListener('click', function() {
    var tiempo = new Date();
    tiempo = moment(tiempo).format('YYYY-MM-DD HH:mm:ss');
    document.getElementById("miTiempo").setAttribute('value', now);
});

const alerta = document.querySelector('#registrar');
alerta.addEventListener('click', function() {
    Alerta();
});
function Alerta(){
    Swal.fire({
        title: "The Internet?",
        text: "That thing is still around?",
        icon: "question"
      });
}

document.body.addEventListener('click', function() {
    elminarMensaje();
});
function elminarMensaje(){
    const mensaje = document.getElementById("alerta");
    setTimeout(() => {
        mensaje.remove();
    }, 500);    
}
})();