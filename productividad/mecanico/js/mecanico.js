/*=========================================
    VARIABLES
=========================================*/

let idReparacion = null;

const modal = document.getElementById("modalPausa");

const btnAceptar = document.getElementById("aceptarPausa");

const btnCancelar = document.getElementById("cancelarPausa");

const radiosMotivo = document.querySelectorAll(
    "input[name='motivo']"
);



/*=========================================
    ABRIR MODAL
=========================================*/

document.querySelectorAll(".btnPausar")
.forEach(function(btn){

    btn.addEventListener("click",function(e){

        e.preventDefault();


        idReparacion = this.dataset.id;


        modal.style.display = "flex";


        btnAceptar.disabled = true;


        radiosMotivo.forEach(function(radio){

            radio.checked = false;

        });


    });


});



/*=========================================
    HABILITAR BOTÓN
=========================================*/

radiosMotivo.forEach(function(radio){


    radio.addEventListener("change",function(){


        btnAceptar.disabled = false;


    });


});



/*=========================================
    CERRAR MODAL
=========================================*/

function cerrarModal(){


    modal.style.display = "none";


    btnAceptar.disabled = true;


    radiosMotivo.forEach(function(radio){

        radio.checked = false;

    });


    idReparacion = null;


}



/*=========================================
    CANCELAR
=========================================*/

btnCancelar.addEventListener("click",function(){


    cerrarModal();


});



/*=========================================
    ACEPTAR
=========================================*/

btnAceptar.addEventListener("click",function(){


    let motivo = document.querySelector(

        "input[name='motivo']:checked"

    );



    if(!motivo || !idReparacion){

        return;

    }



    window.location.href =

        "pausar.php?id="

        + idReparacion

        + "&motivo="

        + encodeURIComponent(
            motivo.value
        );


});



/*=========================================
    CLICK FUERA DEL MODAL
=========================================*/

window.addEventListener("click",function(e){


    if(e.target === modal){


        cerrarModal();


    }


});