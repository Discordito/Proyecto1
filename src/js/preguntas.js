(function(){
    obtenerPreguntas();
    let preguntas = [];
    let filtradas = [];

    const filtros = document.querySelectorAll('#filtros input[type="radio"]');
    filtros.forEach(radio => {
        radio.addEventListener('input', filtrarPreguntas);
    })
    function filtrarPreguntas(e) {
        const filtro = e.target.value;
        if(filtro !== ''){
            filtradas = preguntas.filter(pregunta => pregunta.estado === filtro);
        }else {
            filtradas = [];
        }
        
        mostrarPreguntas();
    }

    async function obtenerPreguntas(){
        try {
            const url = '/api/preguntas';
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            preguntas = resultado.preguntas;
            
            mostrarPreguntas();
        } catch (error) {
            console.log(error);
        }
    }
    const estados = {
        0: 'Pendiente',
        1: 'Completa'
    }
    function mostrarPreguntas(){
        limpiarPreguntas();
        totalPendientes();
        totalCompletas();

        const arrayPreguntas = filtradas.length ? filtradas : preguntas;
        if(arrayPreguntas.lenght === 0) {
            const contenedorPreguntas = document.querySelector('#listado-preguntas');
            const textoNoPreguntas = document.createElement('LI');
            textoNoPreguntas.textContent = 'No hay preguntas';
            textoNoPreguntas.classList.add('no-preguntas');
            contenedorPreguntas.appendChild(textoNoPreguntas);
            return;
        }

        arrayPreguntas.forEach(pregunta => {
            const contenedorPreguntas = document.createElement('LI');
            contenedorPreguntas.dataset.preguntaId = pregunta.id;
            contenedorPreguntas.classList.add('pregunta');

            const nombrePregunta = document.createElement('P');
            nombrePregunta.textContent = pregunta.titulo;

            const opcionesDiv = document.createElement('DIV');
            opcionesDiv.classList.add('opciones');

            const btnEstado = document.createElement('BUTTON');
            btnEstado.classList.add('estado-pregunta');
            btnEstado.classList.add(`${estados[pregunta.estado].toLowerCase()}`);
            btnEstado.textContent = estados[pregunta.estado];
            btnEstado.dataset.estadoPregunta = pregunta.estado;
            btnEstado.onclick = function(){
                cambiarEstado({...pregunta});
            }

            const btnResponder = document.createElement('BUTTON');
            btnResponder.classList.add('responder-pregunta');
            btnResponder.dataset.idPregunta = pregunta.id;
            btnResponder.textContent = 'Responder';
            btnResponder.onclick = function(){
                guardarRespuesta({...pregunta});
            }

            opcionesDiv.appendChild(btnEstado);
            opcionesDiv.appendChild(btnResponder);

            contenedorPreguntas.append(nombrePregunta);
            contenedorPreguntas.append(opcionesDiv);

            const listadoPreguntas = document.querySelector('#listado-preguntas');
            listadoPreguntas.appendChild(contenedorPreguntas);
        });
    }
    function totalPendientes() {
        const totalPendientes = preguntas.filter(pregunta => pregunta.estado === "0");
        const pendientesRadio = document.querySelector('#pendientes');
        if(totalPendientes.length === 0){
            pendientesRadio.disabled = true;
        }else {
            pendientesRadio.disabled = false;
        }
    }
    function totalCompletas() {
        const totalCompletas = preguntas.filter(pregunta => pregunta.estado === "1");
        const completasRadio = document.querySelector('#completadas');
        if(totalCompletas.length === 0){
            completasRadio.disabled = true;
        }else {
            completasRadio.disabled = false;
        }
    }
    function cambiarEstado(pregunta){
        const nuevoEstado = pregunta.estado === "1" ? "0" : "1";
        pregunta.estado = nuevoEstado;
        actualizarPregunta(pregunta);
    }
    async function actualizarPregunta(pregunta){
        const {descripcion, estado, estandar_id, id, respuesta, titulo, url, usuarios_id} = pregunta;
        const datos = new FormData();
        datos.append('id', id);
        datos.append('titulo', titulo);
        datos.append('descripcion', descripcion);
        datos.append('respuesta', respuesta);
        datos.append('url', url);
        datos.append('estado', estado);
        datos.append('estandar_id', estandar_id);
        datos.append('usuarios_id', usuarios_id);
        
        try {
            const url = 'https://responsible-affair-ser.domcloud.dev/api/preguntas/actualizar';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();
            if(resultado.respuesta.tipo === 'exito'){
                mostrarAlerta(resultado.respuesta.mensaje, resultado.respuesta.tipo, document.querySelector('.contenedor-preguntas'));
                preguntas = preguntas.map(preguntaMemoria => {
                    if(preguntaMemoria.id === id){
                        preguntaMemoria.estado = estado;
                    }
                    return preguntaMemoria;
                });
                mostrarPreguntas();
            }
            
        } catch (error) {
            console.log(error);
        }
        
    }
    function guardarRespuesta(pregunta){
        verificar(pregunta);
        let variable = '';
        let textarea = document.createElement("textarea");
        const btnGuardar = document.createElement('BUTTON');
        btnGuardar.textContent = 'Guardar';
        const preg = document.querySelectorAll('.pregunta');
        preg.forEach(p => {
            if(p.dataset.preguntaId === pregunta['id']){
                p.appendChild(textarea);
                p.appendChild(btnGuardar);
                btnGuardar.addEventListener('click', function(){
                    pregunta['respuesta'] = textarea.value;
                    responder(pregunta);
                });
            }            
        });        
    }
    async function responder(pregunta){        

        const {descripcion, estado, estandar_id, id, respuesta, titulo, url, usuarios_id} = pregunta;
        const datos = new FormData();
        datos.append('id', id);
        datos.append('titulo', titulo);
        datos.append('descripcion', descripcion);
        datos.append('respuesta', respuesta);
        datos.append('url', url);
        datos.append('estado', estado);
        datos.append('estandar_id', estandar_id);
        datos.append('usuarios_id', usuarios_id);

        try {
            const url = 'https://responsible-affair-ser.domcloud.dev/api/preguntas/responder';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();
            if(resultado.respuesta.tipo === 'exito'){
                mostrarAlerta(resultado.respuesta.mensaje, resultado.respuesta.tipo, document.querySelector('.contenedor-preguntas'));
                limpiarRespuesta();
            }
        } catch (error) {
            console.log(error);
        }
    }
    function mostrarAlerta(mensaje, tipo, referencia){
        //previene la creacion de multiples alertas
        const alertaPrevia = document.querySelector('.alerta');
        if(alertaPrevia){
            alertaPrevia.remove();
        }
        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        //eliminar la alerta
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }
    function limpiarPreguntas() {
        const listadoTareas = document.querySelector('#listado-preguntas');
        
        while(listadoTareas.firstChild){
            listadoTareas.removeChild(listadoTareas.firstChild);
        }
    }
    function limpiarRespuesta(){
        const pregunta = document.querySelectorAll('.pregunta');
        pregunta.forEach(p => {
            if(p.childNodes.length > 2){
                p.removeChild(p.lastChild);
                p.removeChild(p.lastChild);
            }            
        })        
    }
    function verificar(pregunta){
        const pre = document.querySelectorAll('.pregunta');
        pre.forEach(p => {            
            if(p.dataset.preguntaId === pregunta['id']){
                if(p.childNodes.length > 2){
                    p.removeChild(p.lastChild);
                    p.removeChild(p.lastChild);
                }  
            }            
        })          
    }
})();