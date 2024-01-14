$(document).ready(function(){
$(document).off("click","**");
numerodeventa();
ClienteGeneral();
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

})