$(document).ready(function(){
    listar_ventas();
    function listar_ventas(est){
        if(est=null){
            est=$("#tdesav").val();
        }
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vventas.php",
            data:{esta:est,opcion:"listar"},
            success:function(response){
                if(response=='vacio'){
                    $('#cuerpo_tabla_vventas').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){
                        
                        var est=registro[z].esc;
                        var el=""; var ac="";

                        if(est==0){ var esta="none"; el="block";  ac="none"; }
                        if(est==1){ var esta="rgba(255, 0, 0, 0.31)";el="none"; ac="block";}

                        template+=
                        '<tr><td>'+registro[z].cod+
                        '</td><td>'+registro[z].nomc+
                        '</td><td>'+registro[z].fec+
                        '</td><td>'+registro[z].nomp+
                        '</td><td>'+registro[z].estd+
                        '</td><td id="icon" style="display:flex; justify-content: center;"><img src="img/editar.svg" width="40" id="bmod" class="color" data-cod="'+registro[z].cod+'"><img src="img/eliminar.svg" style="display:'+el+';" width="40" id="bir" class="color" data-cod="'+registro[z].cod+'"></td></tr>';
                    }
                    $('#cuerpo_tabla_vventas').html(template);

                }



            }
        })

    }
})