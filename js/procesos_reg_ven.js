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


})