$(document).ready(function(){
    // listar_ventas('','');

    llenar_per();
    function listar_ventas(f1,f2,cp,ep,tp){
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_reporte_ventas.php",
            data:{
                f1:f1,
                f2:f2,
                cp:cp,
                ep:ep,
                tp:tp,  
                opcion:"listarv"
            },
            success:function(response){
                // console.log(response);
                if(response=='vacio'){
                    $('#cuerpo_tabla_reve').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){
                        
                        var est=registro[z].estd;
                        var nomest;
                        var clien;

                        if(est==1){  nomest="PAGADO"; clien=registro[z].nomc}
                        if(est==2){  nomest="PENDIENTE"; clien=registro[z].nomd}

                        template+=
                        '<tr><td>'+registro[z].cod+
                        '</td><td>'+registro[z].fec+
                        '</td><td>'+clien+
                        '</td><td>'+registro[z].nomp+
                        '</td><td>'+registro[z].tpve+
                        '</td><td>'+nomest+
                        '</td><td>S/. '+registro[z].neto+
                        '</td></tr>';
                    }
                    $('#cuerpo_tabla_reve').html(template);

                }
            }
        })
    }

    // codigo para filtrar por fecha
    $(document).on('change', '#rangoFechas, #rangoFechas2', function() {
        var fechai = $('#rangoFechas').val();
        var fechaf = $('#rangoFechas2').val();
    
        if (fechaf.length > 0 && fechai.length > 0 && fechai <= fechaf) {
            listar_ventas(fechai,fechaf,$('#cvrp').val(),$('#est_pago').val(),$('#ttipo_pago').val());
            $('#rangoFechas2').css('border','1px solid green');
            console.log(fechai+" ---"+fechaf);
        } else {
            // listar_ventas('');
            $('#cuerpo_tabla_reve').html('');
            $('#rangoFechas2').val('');
            $('#rangoFechas2').css('border','1px solid red');
        }
    });

    // codigo para filtrar por la fecha y por el personal 
    $(document).on('input','#cvrp',function(){
        let valor=$(this).val();
        if(valor!=0){
            listar_ventas($('#rangoFechas').val(),$('#rangoFechas2').val(),valor);
        }else{
            listar_ventas($('#rangoFechas').val(),$('#rangoFechas2').val(),'');
        }
    })
    
    // codigo para filtrar por la fecha y por el estado de la venta y/o por el personal  
    $(document).on('input','#est_pago',function(){
        let valor=$(this).val();
        if(valor!=0){
            listar_ventas($('#rangoFechas').val(),$('#rangoFechas2').val(),$('#cvrp').val(),valor);
        }else{
            listar_ventas($('#rangoFechas').val(),$('#rangoFechas2').val(),$('#cvrp').val(),'');
        }
    })

     // codigo para filtrar por la fecha y por el tipo de pago y/o por el estado de la venta y/o por el personal  
     $(document).on('input','#ttipo_pago',function(){
        let valor=$(this).val();
        if(valor!=0){
            listar_ventas($('#rangoFechas').val(),$('#rangoFechas2').val(),$('#cvrp').val(),$('#est_pago').val(),valor);
        }else{
            listar_ventas($('#rangoFechas').val(),$('#rangoFechas2').val(),$('#cvrp').val(),$('#est_pago').val(),'');
        }
    })

    //--------------------------------------imprimir reporte
    $(document).on('click','#bimprimirv',function(){    
        // alert("asdfa");        
        // $('#contenido_reporte_venta').css('overflow','hidden');
        // $('#contenido_reporte_venta').height('auto');
        // window.print();
        imprimirDiv("contenido_reporte_venta");
        // $('#contenido_reporte_venta').height('65vh');
        // $('#contenido_reporte_venta').css('overflow','auto');
    })
  
    function imprimirDiv(idDiv) {
        var contenidoDiv = $("#" + idDiv).clone();  // Clonar el contenido del div
    
        // Crear un nuevo documento temporal
        var ventanaImpresion = window.open('', '_blank');
        ventanaImpresion.document.write('<html><head><title>Imprimir</title>');
    
        // Obtener los estilos CSS y agregarlos al nuevo documento
        $('link[rel="stylesheet"]').each(function() {
            ventanaImpresion.document.write($(this).prop('outerHTML'));
        });
    
        // Establecer estilos para el cuerpo del documento
        ventanaImpresion.document.write('<style>body {margin: 0; padding: 0;}</style>');
    
        // Establecer estilos para el div en el nuevo documento usando jQuery
        ventanaImpresion.document.write('<style>#' + idDiv + ' {width: 98%; margin: 0 auto;}</style>');
    
        // Establecer estilos para la tabla en el nuevo documento usando jQuery
        ventanaImpresion.document.write('<style>#' + idDiv + ' table {width: 100%; border-collapse: collapse;}</style>');
    
        // Establecer estilos para el encabezado de la tabla en el nuevo documento usando jQuery
        ventanaImpresion.document.write('<style>#' + idDiv + ' th {background-color: #f2f2f2;}</style>');
    
        ventanaImpresion.document.write('</head><body>');
    
        // Agregar el contenido del div clonado al nuevo documento
        ventanaImpresion.document.write(contenidoDiv[0].outerHTML);
    
        // Finalizar el nuevo documento
        ventanaImpresion.document.write('</body></html>');
        ventanaImpresion.document.close();
    
        // Llamada a la función print() para activar la ventana de impresión
        ventanaImpresion.print();
    
        // Cerrar el nuevo documento después de la impresión
        ventanaImpresion.close();
    }
    

    // codigo para poner titulo al reporte 
    $(document).on('input','#titrpv',function(){
        let valor=$(this).val();
        $('#vtit_rpv').html(''+valor+'');
        if(valor==""){
            $('#titrpv').css('border','1px solid red');
        }else{
            $('#titrpv').css('border','1px solid green');   
        }
    })

    $('.MAYR').on('input', function() {
        let currentValue = $(this).val();
        // Ahora la expresión regular permite letras, números, espacios, puntos y comas
        let newValue = currentValue.replace(/[^a-zA-Z0-9\sÑñ.,-]/g, '');
        $(this).val(newValue.toUpperCase());
    });

    function llenar_per(){
        $.ajax({
            asyn:true,
            type:"GET",
            url:"php/controlador_reporte_ventas.php",
            data:{
                opcion:"listar_per"
            },
            success:function(respuesta){
                // console.log(respuesta);
                $('#cvrp').html(respuesta);
            }
        })
    }

});