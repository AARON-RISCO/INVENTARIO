$(document).ready(function(){
    autocompletaridcaja();
    function autocompletaridcaja(){
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vcaja.php",
            data:{
                opcion:"autocompletarid"
            },success:function(response){
                $("#id_cabecera_caja").val(response);
                $("#nro_caja").val(response);
            }
        })
    }
});