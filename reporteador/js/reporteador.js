// ==========================================
// ANIMACIÓN DE ENTRADA
// ==========================================

window.addEventListener("load", () => {

    document.body.classList.add("visible");

});

// ==========================================
// RELOJ
// ==========================================

function actualizarReloj(){

    const ahora = new Date();

    const fecha = ahora.toLocaleDateString('es-MX');

    const hora = ahora.toLocaleTimeString('es-MX');

    const reloj = document.getElementById("reloj");

    if(reloj){

        reloj.innerHTML = fecha + " &nbsp;&nbsp; " + hora;

    }

}

actualizarReloj();

setInterval(actualizarReloj,1000);


// ==========================================
// ROTACIÓN DE EMPRESAS
// ==========================================

const empresas = [1,2,3,4];

const parametros = new URLSearchParams(window.location.search);

let empresaActual = parseInt(parametros.get("empresa")) || 1;

let indice = empresas.indexOf(empresaActual);

if(indice === -1){

    indice = 0;

}

// Empieza a desaparecer medio segundo antes
setTimeout(() => {

    document.body.classList.remove("visible");
    document.body.classList.add("ocultar");

},14500);

// Cambia de empresa
setTimeout(() => {

    indice++;

    if(indice >= empresas.length){

        indice = 0;

    }

    window.location.href = "index.php?empresa=" + empresas[indice];

},10000);