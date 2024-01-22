$(document).ready(function(){
    $(document).off("click","**");
    numerodecompra();
    listar_temporal();
    function numerodecompra(){
        const datos={
            opcion: 'ultimo'     
        };
        $.get('php/controlador_reg_com.php',datos,function(response){
                var registro=JSON.parse(response);
                $('#id_cod').val( "V00"+registro[0].cod);
                $('#cod_com').val(registro[0].cod);
        })
    }
                  
    function listar_productos(parametro){
        $.ajax({
            async:true,
            url:'php/controlador_reg_com.php',
            type:'GET',
            data:{nombre:parametro,opcion:'listar'},
            success: function(response){
                if(response=='vacio'){
                    $('.añadir').css('display','block');
                    $('#cuerpo_tabla_productos').html('');
                }else{
                    $('.añadir').css('display','none');
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){ 
                        cod=registro[z].cod;
                        template+=
                        '<tr><td>'+registro[z].nom+
                        '</td><td>'+registro[z].sa+
                        '</td><td>'+registro[z].uni+
                        '</td><td>'+registro[z].pre+
                        '</td><td>'+registro[z].actual+
                        '</td><td id="icon"><img src="img/comprar.svg" width="40" id="bcarrito" data-cod="'+registro[z].cod+'"></td></tr>';
                    }
                    
                    $('#cuerpo_tabla_productos').html(template);
    
                }
            }
    
        })
    }
    
     //buscar en la caja de texto
     $(document).on('keyup','#bus_nom',function(){
        var valor=$(this).val();
        if(valor !=""){
            $('#listado').css('display','block');
            listar_productos(valor);
        }else{
            $('#listado').css('display','none');
            listar_productos();
        }
    })
    
    //listar temporal
    function listar_temporal() {
        $.ajax({
            async: true,
            url: 'php/controlador_reg_com.php',
            type: 'GET',
            data: { opcion: 'listar_temporal' },
            success: function(response) {
                if (response == 'vacio') {
                    $('#cuerpo_tabla_temporal_com').html('');
                } else {
                    var registro = JSON.parse(response);
                    var template = '';
                    var totcom = 0;
                    for (z in registro) {
                        totcom = totcom + parseFloat(registro[z].tot);
                        item=registro[z].item;
                        cod=registro[z].cod;
                        template +=
                            '<tr><td>' + registro[z].nom+
                            '</td><td>' + registro[z].sabor +
                            '</td><td>' + registro[z].pre_com +
                            '</td><td>' + registro[z].pre_ven +
                            '</td><td>' + registro[z].can +
                            '</td><td>' + registro[z].tot +
                            '</td><td id="icon"><img src="img/editar.svg" class="color amarillo" id="bmod" data-cod="'+registro[z].cod+'"><img src="img/eliminar.svg" class="color rojo" id="beli" data-cod="'+registro[z].item+'"></td></tr>';
                            $('#ttot').val(totcom);  
                        }
                        
                    $('#cuerpo_tabla_temporal_com').html(template);
                }
            }
        });
    }
    
// AÑADIR AL CARRITO
$(document).on('click', '#bcarrito', function() {
    const cod = $(this).data('cod');
    var cantidad;
    var compra;
    compra = $('#cod_com').val();
    var opcion;
    var opcion2;

    do {
        opcion = prompt("Ingrese Cantidad", "");
    } while (opcion !== null && (!validarEntero(opcion) || opcion.trim() === ''));

    if (opcion === null) {
        // El usuario ha cancelado el prompt
        return;
    } else {
        cantidad = opcion;
    }

    do {
        opcion2 = prompt("Ingrese Precio Compra", "");
    } while (opcion2 !== null && (!validarPrecio(opcion2) || opcion2.trim() === ''));

    if (opcion2 === null) {
        // El usuario ha cancelado el prompt
        return;
    }

    const datos = {
        cod: cod,
        opcion: 'buscar'
    };

    $.get('php/controlador_reg_com.php', datos, function(response) {
        registro = JSON.parse(response);
        ncom = compra;
        codp = (registro[0].cod);
        nom = (registro[0].nom);
        sabor = (registro[0].sa);
        can = parseInt(cantidad);
        pre_com = parseFloat(opcion2);
        pre_ven = (registro[0].pre);
        tot = can * pre_com;

        const datos2 = {
            com: ncom,
            cod: codp,
            can: can,
            pre: pre_com,
            tot: tot,
            opcion: 'agregar_temporal'
        };

        $.get('php/controlador_reg_com.php', datos2, function(response) {
            alert(response);
            listar_temporal();
        });
    });
});

function validarEntero(valor) {
    // Expresión regular que permite solo números enteros
    var regex = /^[0-9]+$/;
    return regex.test(valor);
}

function validarPrecio(valor) {
    // Expresión regular que permite números y puntos decimales
    var regex = /^[0-9]+(\.[0-9]+)?$/;
    return regex.test(valor);
}
 
 //Eliminar producto de la temporal
 $(document).on('click', '#beli', function() {
     const cod = $(this).data('cod');
     const datos={
         cod:cod,
         opcion:'eliminar'
     }
     $.get('php/controlador_reg_com.php', datos, function(response) {
         alert(response);
         $('#ttot').val('');
         listar_temporal();
     });
 })
 
 //añadir extra
 
 $(document).on('click', '#bmod', function() {
    const cod = $(this).data('cod');
    var nuevo_precio
    do {
        nuevo_precio = prompt("Ingrese Nuevo Precio de Venta", "");
    } while (nuevo_precio !== null && (!validarPrecio(nuevo_precio) || nuevo_precio.trim() === ''));

    if (nuevo_precio === null) {
        // El usuario ha cancelado el prompt
        return;
    }
    const datos={
        cod:cod,
        nuevo_pre:nuevo_precio,
        opcion:'modificar_pre'
    }
    $.get('php/controlador_reg_com.php',datos,function(response){
        alert(response);
        listar_temporal();
    })
     
 });
 
 //registrar venta
$(document).on('click', '#bguardar_com', function () {
    var neto = parseFloat($('#ttot').val());
    const fecha = $('#fecha').val();
    const dni = $('#dni_per').val();
    const cod_com = $('#cod_com').val();
    if (fecha=="") {
        alert('Ingrese Fecha');
        return;
    }

    // Validar si hay productos en la tabla temporal
    if ($('#cuerpo_tabla_temporal_com tr').length === 0) {
        alert('NO SE PUEDE REGISTRAR LA COMPRA SIN PRODUCTOS');
        return;
    }

    const datos = {
        cod: cod_com,
        fecha:fecha,
        dni:dni,
        neto: neto,
        opcion: 'agregar_compra'
    };

    $.get('php/controlador_reg_com.php', datos, function (response) {
        alert(response);
        $('#cuerpo_tabla_temporal_com').html('');
        $("#listado").css("display","none");
        $("#fecha").val("");
        $("#ttot").val('');
        $("#bus_nom").val('');
        const datos = {
            opcion: 'limpiar'
        };
        $.get('php/controlador_reg_com.php', datos, function (response) {
            listar_temporal();
        });

    });
}); 

    //Cancelar compra
    $(document).on('click', '#bcancelar_com', function() {
        const datos = {
            opcion: 'cancelar'
        };
        $.get('php/controlador_reg_com.php', datos, function(response) {
            alert(response);
            listar_temporal();
            $('#cuerpo_tabla_temporal_com').html('');
            $("#listado").css("display","none");
            $("#fecha").val("");
            $("#ttot").val('');
            $("#bus_nom").val('');
        });
    });
    
    
    
})