const moment = require("moment/moment");


(function(){  
    //estandares
    
    let res1 = 0;
    
    const respuesta = document.querySelector('#respondido');
    respuesta.addEventListener('click', function() {
        guardarRespuestas();
    });
    function guardarRespuestas() {
        const pregunta = document.querySelectorAll('#listado-items input[type="radio"]:checked');
        const contenedorRespuesta = document.querySelector('#puntaje');
        const textoRespuesta = document.createElement('P');
        textoRespuesta.classList.add('puntaje-texto');
        pregunta.forEach( r => {
            //Estandar 1
            if (r.name === "1") {
                res1 = (r.value*0.2);
            }if(r.name === "3") {
                res1 = res1+(r.value*0.5)
            }if(r.name === "4") {
                res1 = res1+(r.value*0.2)
            }if(r.name === "5") {
                res1 = res1+(r.value*0.1)
            }
            //Estandar 2
            if(r.name === "2") {
                res1 = res1+(r.value*0.6)
            }if(r.name === "6") {
                res1 = res1+(r.value*0.2)
            }if(r.name === "7") {
                res1 = res1+(r.value*0.2)
            }
            //Estandar 3
            if(r.name === "8") {
                res1 = res1+(r.value*0.5)
            }if(r.name === "9") {
                res1 = res1+(r.value*0.5)
            }
            //Estandar 4
            if(r.name === "10") {
                res1 = res1+(r.value*1)
            }
        })
        res1 = res1.toFixed(1);
        textoRespuesta.textContent = "Tu puntaje es: " + res1;
        contenedorRespuesta.appendChild(textoRespuesta);
        limpiarRespuesta();
        res1=0;
        
    }
    function limpiarRespuesta() {
        const respuestaAnterior = document.getElementById("puntaje");
        respuestaAnterior.removeChild(respuestaAnterior.firstElementChild);         
    }

    //guardar registro
    
    const btnRegistro = document.querySelector('#registrar');
    btnRegistro.addEventListener('click', function() {
        var now = new Date();
        now = moment(now).format('YYYY-MM-DD HH:mm:ss');
        document.getElementById("mydata").setAttribute('value', now);
    });


})();