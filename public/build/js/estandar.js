!function(){let e="";document.querySelector("#respondido").addEventListener("click",(function(){!function(){const n=document.querySelectorAll('#listado-items input[type="radio"]:checked'),t=document.querySelector("#puntaje"),a=document.createElement("P");a.classList.add("puntaje-texto"),n.forEach(n=>{"1"===n.name&&(e=.2*n.value),"3"===n.name&&(e+=.5*n.value),"4"===n.name&&(e+=.2*n.value),"5"===n.name&&(e+=.1*n.value),"2"===n.name&&(e+=.6*n.value),"6"===n.name&&(e+=.2*n.value),"7"===n.name&&(e+=.2*n.value),"8"===n.name&&(e+=.5*n.value),"9"===n.name&&(e+=.5*n.value),"10"===n.name&&(e+=1*n.value)}),e=e.toFixed(1),a.textContent="Tu puntaje es: "+e,t.appendChild(a),function(){const e=document.getElementById("puntaje");e.removeChild(e.firstElementChild)}()}()}))}();