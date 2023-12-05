(function(){

    obtenerPreguntas();
    let preguntas = [];

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
        preguntas.forEach(pregunta => {
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

            opcionesDiv.appendChild(btnEstado);
            opcionesDiv.appendChild(btnResponder);

            contenedorPreguntas.append(nombrePregunta);
            contenedorPreguntas.append(opcionesDiv);

            const listadoPreguntas = document.querySelector('#listado-preguntas');
            listadoPreguntas.appendChild(contenedorPreguntas);
        });
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
            const url = 'http://localhost:3000/api/preguntas/actualizar';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            console.log(respuesta);
        } catch (error) {
            console.log(error);
        }
        
    }
})();