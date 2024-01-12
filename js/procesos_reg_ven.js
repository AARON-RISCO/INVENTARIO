$(document).ready(function(){
$(document).off("click","**");
numerodeventa();
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
})