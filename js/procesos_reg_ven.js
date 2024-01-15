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
    $.ajax({
        async:true,
        url:'php/controlador_productos.php',
        type:'GET',
        data:{nombre:parametro,opcion:'listar'},
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
                    '</td><td id="icon"><img src="img/añadiralcarrito.svg" width="40" id="bcarrito" class="color" data-cod="'+registro[z].cod+'"></td></tr>';
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
                    cod_pro=registro[z].cod;
                    template +=
                        '<tr><td>' + registro[z].nom+
                        '</td><td>' + registro[z].sabor +
                        '</td><td>' + registro[z].pre +
                        '</td><td>' + registro[z].can +
                        '</td><td>' + registro[z].tot +
                        '</td><td id="icon"><img src="img/eliminar.svg" width="30" id="beli" data-cod="' + registro[z].cod + '"></td></tr>';
                }
                $('#cuerpo_tabla_temporal').html(template);
                $('#ttot').val(totven);
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
        nven = venta;
        codp = (registro[0].cod);
        nom = (registro[0].nom);
        sabor = (registro[0].sa);
        can = parseInt(cantidad);
        pre = (registro[0].pre);
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
    });
});

})