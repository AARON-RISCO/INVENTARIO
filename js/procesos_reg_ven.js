$(document).ready(function(){
$(document).off("click","**");
numerodeventa();
ClienteGeneral();
//bloquear tipo de pago
$('#ttipo_pago').css('pointer-events','none');
//Mostrar codigo de venta
function numerodeventa(){
    const datos={
        opcion: 'ultimo'     
    };
    $.get('php/controlador_reg_ven.php',datos,function(response){
            var registro=JSON.parse(response);
            $('#id_cod').val( "V00"+registro[0].cod);
            $('#cod_ven').val(registro[0].cod);
    })
}

//Buscar cliente general
function ClienteGeneral(){
    const datos={
        opcion:'Buscar_ClienteGeneral'
    };
    $.get('php/controlador_reg_ven.php',datos,function(response){
        var registro=JSON.parse(response);
        $('#cliente').val(registro[0].cli);
    })
}

//Estado de venta
function EstadoVenta(){
    const estado=$('#est_pago').val();
    if (estado==0) {
        $('.debe').css('display','none');
        $('#ttipo_pago').css('pointer-events','none');  
        $('#ttipo_pago').val(0);
        $('#tdeudores').html("");
    }else if (estado==1) {
        $('.debe').css('display','none');
        $('#ttipo_pago').css('pointer-events','auto');
        $.ajax({
            async:true,
            type: "GET",
            data:{opcion:'deudorGeneral'},
            url: "php/controlador_reg_ven.php",
            success: function(response){
                $('#tdeudores').html(response);
            }
        });
    } else if (estado > 1) {
        $('.debe').css('display','block');
        $('#ttipo_pago').css('pointer-events','none');
        $('#ttipo_pago').val(3);
        $.ajax({
            async:true,
            type: "GET",
            data:{opcion:'deudores'},
            url: "php/controlador_reg_ven.php",
            success: function(response){
                $('#tdeudores').html(response);
            }
        });
    } 
}

//llenar deudores
$(document).on('change','#est_pago',function(){
    EstadoVenta();
})

//Abrir modal de registrar nuevo deudor
$(document).on('click', '.reg_deudores', function() {
    $('.fondo').css('display','block');
    $('.modal').css('margin-top','-30%');
})
//cerrar modal de registrar nuevo deudor
$(document).on('click', '.cerrar_modal', function() {
    $('.fondo').css('display','none');
    $('.modal').css('margin-top','-90%');
})

function listar_productos(parametro){
    var es=0;
    $.ajax({
        async:true,
        url:'php/controlador_reg_com.php',
        type:'GET',
        data:{nombre:parametro,espa:es,opcion:'listar'},
        success: function(response){
            if(response=='vacio'){
                $('#cuerpo_tabla_productos').html('');
            }else{
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
                    '</td><td id="icon"><img src="img/añadiralcarrito.svg" width="40" id="bcarrito" data-cod="'+registro[z].cod+'"></td></tr>';
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
        url: 'php/controlador_reg_ven.php',
        type: 'GET',
        data: { opcion: 'listar_temporal' },
        success: function(response) {
            if (response == 'vacio') {
                $('#cuerpo_tabla_temporal').html('');
            } else {
                var registro = JSON.parse(response);
                var template = '';
                var totven = 0;
                for (z in registro) {
                    totven = totven + parseFloat(registro[z].tot);
                    item=registro[z].item;
                    extra=registro[z].ex ;
                    let fondo="";

                    if(extra>0){ fondo="rgb(0, 255, 255)";  }
                    if(extra==0){ fondo="rgba(0, 0, 0, 0)";}
            
                    template +=
                        '<tr><td>' + registro[z].nom+
                        '</td><td>' + registro[z].sabor +
                        '</td><td>' + registro[z].pre +
                        '</td><td>' + registro[z].can +
                        '</td><td>' + registro[z].ex +
                        '</td><td>' + registro[z].tot +
                        '</td><td id="icon"><img src="img/helado.svg" width="40" id="'+registro[z].item+'" class="color frio" data-cod="'+registro[z].item+'" style="background-color:'+fondo+';"><img src="img/eliminar.svg" width="40" id="bir" class="color" data-cod="'+registro[z].item+'"></td></tr>';
                        $('#ttot').val(totven);  
                    }
                    
                $('#cuerpo_tabla_temporal').html(template);
                
            }
        }
    });
}

//AÑADIR AL CARRITO
$(document).on('click', '#bcarrito', function() {
    const cod = $(this).data('cod');
    var cantidad;
    var venta;
    venta = $('#cod_ven').val();
    var opcion = prompt("Ingrese Cantidad", "");

    if (opcion == null || opcion == "" || opcion == 0) {
        alert('NO A IMGRESADO CANTIDAD');
        return;
    } else {
        cantidad = opcion;
    }

    const datos = {
        cod: cod,
        opcion: 'buscar'
    };
    $.get('php/controlador_reg_ven.php', datos, function(response) {
        registro = JSON.parse(response);
        if ((registro[0].nom) == "BIG BEN" ) {
            canpro = parseInt(cantidad);
            id=registro[0].cod;
            const dato={
                canpro:canpro,
                id:id,
                opcion:'buscar_promocion'
            }
            $.get('php/controlador_reg_ven.php', dato, function(response) {
                registro = JSON.parse(response);
                nven = venta;
                codp = (registro[0].cod);
                nom = (registro[0].nom);
                sabor = (registro[0].sa);
                can = parseInt(cantidad);
                pre = (registro[0].precio_promo);
                tot = can * pre;
                
                const datos2 = {
                    ven: nven,
                    cod: codp,
                    can: can,
                    pre: pre,
                    tot: tot,
                    opcion: 'agregar_temporal'
                };
                $.get('php/controlador_reg_ven.php', datos2, function(response) {
                    alert(response);
                    listar_temporal();
        
                });

            })
        }else{
            nven = venta;
            codp = (registro[0].cod);
            nom = (registro[0].nom);
            sabor = (registro[0].sa);
            can = parseInt(cantidad);
            pre = (registro[0].pre);
            tot = can * pre;
    
            const datos3 = {
                ven: nven,
                cod: codp,
                can: can,
                pre: pre,
                tot: tot,
                opcion: 'agregar_temporal'
            };
            $.get('php/controlador_reg_ven.php', datos3, function(response) {
                alert(response);
                listar_temporal();
    
            });
        }
        
    });
});

//Eliminar producto de la temporal
$(document).on('click', '#bir', function() {
    const cod = $(this).data('cod');
    const datos={
        cod:cod,
        opcion:'eliminar'
    }
    $.get('php/controlador_reg_ven.php', datos, function(response) {
        alert(response);
        $('#ttot').val('');
        listar_temporal();
    });
})

//añadir extra

$(document).on('click', '.frio', function() {
    var codigoh=$(event.target).attr('id');
    const codigop = $(this).data('cod');
    const ex = 0.2;

    if ($('#'+codigoh).css('background-color') === 'rgba(0, 0, 0, 0)') {
        $('#'+codigoh).css('background-color', 'rgb(0, 255, 255)');
        const datos = {
            cod: codigop,
            ex: ex,
            opcion: 'extra'
        };

        $.get('php/controlador_reg_ven.php', datos, function(response) {
            listar_temporal();
        });
    } else if ($('#'+codigoh).css('background-color') === 'rgb(0, 255, 255)') {
        $('#'+codigoh).css('background-color', 'rgba(0, 0, 0, 0)');
        const datos = {
            cod: codigop,
            ex: ex,
            opcion: 'menos_extra'
        };

        $.get('php/controlador_reg_ven.php', datos, function(response) {
            listar_temporal();
        });
    }
});

//registrar venta
$(document).on('click', '#bguardar_ven', function () {
    var neto = parseFloat($('#ttot').val());
    const estado = $('#est_pago').val();
    const tipo = $('#ttipo_pago').val();
    const deudores = $('#tdeudores').val();
    const cod_ven = $('#cod_ven').val();
    if (estado==0) {
        alert('SELECCIONE ESTADO DE LA VENTA');
        return;
    }
    if (estado==1 & tipo==0) {
        alert('SELECCIONE TIPO DE PAGO');
        return;
    }else if (estado==2 & deudores==0) {
        alert('SELECCIONE UN DEUDOR');
        return;
    }

    // Validar si hay productos en la tabla temporal
    if ($('#cuerpo_tabla_temporal tr').length === 0) {
        alert('NO SE PUEDE REGISTRAR LA VENTA SIN PRODUCTOS');
        return;
    }

    const datos = {
        cod: cod_ven,
        fecha: $('#fecha').val(),
        dni_per: $('#dni_per').val(),
        dni_cli: $('#dni').val(),
        estado: estado,
        deudor: deudores,
        neto: neto,
        opcion: 'agregar_venta'
    };

    $.get('php/controlador_reg_ven.php', datos, function (response) {
        alert(response);
        $("#est_pago").val(0);
        $("#ttipo_pago").val(0);
        $("#ttot").val('');
        $("#bus_nom").val('');
        $("#deudores").val(0);
        $(".debe").css('display','none');
        $('#listado').css('display','none');
        const datos = {
            opcion: 'limpiar'
        };
        $.get('php/controlador_reg_ven.php', datos, function (response) {
            listar_temporal();
        });

        });
    }); 

//Cancelar Venta
$(document).on('click', '#bcancelar_ven', function() {
    const datos = {
        opcion: 'cancelar'
    };
    $.get('php/controlador_reg_ven.php', datos, function(response) {
        alert(response);
        listar_temporal();
        $('#cuerpo_tabla_temporal').html('');
        $("#est_pago").val(0);
        $("#ttipo_pago").val(0);
        $("#deudores").val(0);
        $(".debe").css('display','none');
        $("#ttot").val('');
        $("#bus_nom").val('');
        $('#listado').css('display','none');
    });
});



})