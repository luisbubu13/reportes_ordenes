$(document).ready(function(){


/*==========================================================
    SELECT2
==========================================================*/

$("#mecanico").select2({

    placeholder:"Todos los mecánicos",

    allowClear:true,

    closeOnSelect:false,

    width:"100%"

});



/*==========================================================
    ANIMACIÓN
==========================================================*/

$("body").addClass("visible");



/*==========================================================
    VARIABLE GLOBAL
==========================================================*/

let grafica = null;



/*==========================================================
    OBTENER FILTROS
==========================================================*/

function obtenerFiltros(){

    let mecanicos = $("#mecanico").val();


    if(!Array.isArray(mecanicos)){

        mecanicos = mecanicos ? [mecanicos] : [];

    }


    let datos = {

        fecha: $("#fechaDesde").val(),

        fechaDesde: $("#fechaDesde").val(),

        fechaHasta: $("#fechaHasta").val(),

        periodo: $("#periodo").val(),

        mecanico: mecanicos

    };


    console.log(
        "FILTROS ENVIADOS:",
        datos
    );


    return datos;

}




/*==========================================================
    AJAX COMÚN
==========================================================*/

function enviarAjax(url, success){

    let filtros = obtenerFiltros();

    console.log(
        "DATOS AJAX:",
        filtros
    );


    $.ajax({

        url:url,

        type:"GET",

        data:filtros,

        traditional:false,

        dataType:"json",

        success:function(data){

            success(data);

        },


        error:function(xhr){

            console.log(
                "ERROR AJAX:",
                xhr.responseText
            );

        }

    });

}






/*==========================================================
    RESUMEN
==========================================================*/

function cargarResumen(){


    enviarAjax(

        "ajax/resumen.php",


        function(data){


            if(data.error){

                console.log(data.error);

                return;

            }


            $("#fechaReporte")
            .html(data.fecha);


            $("#mecanicosActivos")
            .html(data.mecanicos_activos);


            $("#reparacionesActivas")
            .html(data.activas);


            $("#terminadasHoy")
            .html(data.terminadas);


            $("#productividadPromedio")
            .html(
                data.productividad+"%"
            );


        }


    );


}






/*==========================================================
    PRODUCTIVIDAD MECÁNICOS
==========================================================*/

function cargarProductividad(){


    $("#contenedorProductividad")
    .html(
        "<p>Cargando productividad...</p>"
    );



    enviarAjax(

        "ajax/productividad.php",


        function(data){



            if(data.error){

                console.log(data.error);

                return;

            }



            let html="";



            if(
                !data.mecanicos ||
                data.mecanicos.length===0
            ){


                html=`

                <div class="sinDatos">

                    No hay información de productividad.

                </div>

                `;


            }

            else{


                data.mecanicos.forEach(function(m){



                    let clase="verde";



                    if(m.productividad < 50){

                        clase="rojo";

                    }

                    else if(m.productividad < 80){

                        clase="amarillo";

                    }





                    html+=`

                    <div

                    class="tarjeta ${clase} clickable"

                    data-id="${m.id}"

                    data-nombre="${m.mecanico}"

                    >



                        <h3>

                            ${m.mecanico}

                        </h3>




                        <div class="dato">

                            🔧 Reparaciones:

                            <b>

                                ${m.reparaciones}

                            </b>


                        </div>





                        <div class="dato">


                            ⏱ Tiempo:


                            <b>

                                ${m.tiempo}

                            </b>


                        </div>





                        <div class="barra">


                            <div

                                class="progreso"

                                style="width:${m.productividad}%"

                            >

                            </div>


                        </div>





                        <div class="porcentaje">

                            ${m.productividad}%

                        </div>



                    </div>



                    `;



                });


            }



            $("#contenedorProductividad")
            .html(html);



        }


    );


}

/*==========================================================
    GRÁFICA
==========================================================*/

function cargarGrafica(){


    enviarAjax(

        "ajax/grafica.php",


        function(data){


            if(data.error){

                console.log(data.error);

                return;

            }



            let canvas =
                document.getElementById(
                    "graficaProductividad"
                );



            if(!canvas){

                return;

            }



            if(grafica !== null){

                grafica.destroy();

            }



            let colores =
            data.datos.map(function(valor){


                if(valor < 50){

                    return "#e53935";

                }

                else if(valor < 80){

                    return "#fbc02d";

                }

                else{

                    return "#43a047";

                }


            });


        const pluginPromedio = {

                id:"mostrarPromedio",

                afterDatasetsDraw(chart){

                    const {ctx} = chart;


                    const promedio = 
                        chart.data.datasets[1].data[0];


                    if(promedio === undefined){

                        return;

                    }


                    const yScale = chart.scales.y;


                    const y = yScale.getPixelForValue(promedio);


                    ctx.save();


                    ctx.font = "bold 14px Arial";


                    ctx.fillStyle = "#000";


                    ctx.textAlign = "right";


                    ctx.fillText(

                        "Promedio: " + promedio + "%",

                        chart.chartArea.right,

                        y - 10

                    );


                    ctx.restore();


                }

            };


            grafica = new Chart(

                canvas.getContext("2d"),


                {

                    plugins:[pluginPromedio],

                    type:"bar",


                    data:{


                        labels:data.labels,


                        datasets:[

                        {

                            label:"Productividad (%)",

                            data:data.datos,

                            backgroundColor:colores,

                            borderWidth:2,

                            borderRadius:8

                        },

                        {

                            label:"Promedio del equipo",

                            data:

                                data.labels.map(function(){

                                    return data.promedio;

                                }),

                            type:"line",

                            borderColor:"#000",

                            borderWidth:3,

                            pointRadius:5,

                            fill:false,

                            tension:0.3

                        }

                        ]

                    },

                    options:{

                        responsive:true,

                        maintainAspectRatio:false,



                        plugins:{


                            title:{


                                display:true,


                                text:"Rendimiento de mecánicos"


                            }


                        },



                        scales:{


                            y:{


                                beginAtZero:true,


                                max:100,


                                ticks:{


                                    callback:function(value){

                                        return value+"%";

                                    }


                                }


                            }


                        }


                    }


                }


            );


        }


    );


}







/*==========================================================
    DETALLE MECÁNICO
==========================================================*/


$(document).on(

"click",

".clickable",

function(){



    let id = $(this).data("id");


    let nombre = $(this).data("nombre");



    console.log(
        "ID ENVIADO DETALLE:",
        id
    );




    $("#tituloDetalle")
    .html(
        "Detalle de "+nombre
    );



    $("#contenidoDetalle")
    .html(
        "Cargando información..."
    );



    $("#modalDetalle")
    .css(
        "display",
        "flex"
    );





    $.ajax({


        url:"ajax/detalle_mecanico.php",


        type:"GET",


        data:{

            id_mecanico:id,

            fecha:$("#fecha").val(),

            periodo:$("#periodo").val()

        },


        dataType:"json",



        success:function(data){



            console.log(
                "DETALLE:",
                data
            );



            let html="";




            if(
                !data.autobuses ||
                data.autobuses.length===0
            ){


                html=`

                <div class="sinDatos">

                    No hay información de autobuses.

                </div>

                `;


            }

            else{



                data.autobuses.forEach(function(a){



                    let horas =
                    Math.floor(
                        a.minutos / 60
                    );



                    let minutos =
                    a.minutos % 60;




                    html+=`

                    <div class="detalleBus">



                        <div>

                            🚌 <b>${a.unidad}</b>

                        </div>



                        <div>

                            🔧 Reparaciones:
                            ${a.reparaciones}

                        </div>



                        <div>

                            ⏱ Tiempo:
                            ${horas} h ${minutos} min

                        </div>



                    </div>


                    `;



                });



            }




            $("#contenidoDetalle")
            .html(html);



        },


        error:function(xhr){


            console.log(
                "ERROR DETALLE:",
                xhr.responseText
            );


            $("#contenidoDetalle")
            .html(
                "Error cargando detalle."
            );


        }



    });



});






/*==========================================================
    CERRAR MODAL
==========================================================*/


$(".cerrarModal")
.click(function(){


    $("#modalDetalle")
    .hide();


});





$("#modalDetalle")
.click(function(e){


    if(e.target.id==="modalDetalle"){


        $(this).hide();


    }


});






/*==========================================================
    EVENTOS FILTROS
==========================================================*/


$("#fechaDesde,#fechaHasta,#mecanico,#periodo")
.on(

"change",

function(){


    cargarResumen();


    cargarProductividad();


    cargarGrafica();


}


);






/*==========================================================
    CARGA INICIAL
==========================================================*/


cargarResumen();


cargarProductividad();


cargarGrafica();







/*==========================================================
    ACTUALIZACIÓN AUTOMÁTICA
==========================================================*/


setInterval(function(){


    cargarResumen();


    cargarProductividad();


    cargarGrafica();



},60000);




});