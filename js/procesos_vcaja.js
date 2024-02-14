$(document).ready(function(){
    $(document).off("click","**");
    // autocompletaridcaja();
    // function autocompletaridcaja(){
    //     $.ajax({
    //         async:true,
    //         type:"GET",
    //         url:"php/controlador_vcaja.php",
    //         data:{
    //             opcion:"autocompletarid"
    //         },success:function(response){
    //             $("#id_cabecera_caja").val(response);
    //             $("#nro_caja").val(response);
    //         }
    //     })
    // }
    listar_detalle_caja();
    function listar_detalle_caja(parametro){
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vcaja.php",
            data:{
                p1:parametro,
                opcion:"listar_detalle_caja"
            },success:function(response){
                // console.log(response);
                let respues=response.trim();
                if(response=='vacio'){
                    $('#cuerpo_tabla_caja').html('');
                }else{
                    var registro=JSON.parse(respues);
                    let co=0;
                    var template='';
                    for(z in registro){
                        co++;
                        template+=
                        '<tr><td>'+co+
                        '</td><td>'+registro[z].nom_per+
                        '</td><td>'+registro[z].movimi+
                        '</td><td>'+registro[z].motivo+
                        '</td><td>S/. '+registro[z].total+
                        '</td><td id="op"><img src="img/editar.svg" width="35" id="bcatu" data-cod="'+registro[z].nro_mov+'"></td></tr>';
                        '</td></tr>';
                    }
                    $('#cuerpo_tabla_caja').html(template);
                }
            }
        })
    }
    listar_cabecera();
    function listar_cabecera(){
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vcaja.php",
            data:{
                opcion:"listar_cabe_caja"
            },success:function(response){
                // console.log(response);
                let respuesta=response.trim();
                let respues=JSON.parse(respuesta);
                $('#fecha_caja').val(respues[0].fecha);
                $('#taper').val('S/. '+respues[0].apert);
                $('#tingr').val('S/. '+respues[0].ingre);
                $('#tegre').val('S/. '+respues[0].egres);
                $('#ttot').val('S/. '+respues[0].total);
                $('#nro_caja').val(respues[0].id_ca);
            }
        })
    }

    $('#bnuevo_ca').click(function(){
        $('#bguardar_ca').css("display","block");
        $('#bcancelar_ca').css("display","block");
        $('#bnuevo_ca').css("display","none");
    })
    $('#bguardar_ca').click(function(){
        $('#bguardar_ca').css("display","none");
        $('#bcancelar_ca').css("display","none");
        $('#bnuevo_ca').css("display","block");
    })
    $('#bmodificar_ca').click(function(){
        
    })
    $('#bcancelar_ca').click(function(){
        $('#bguardar_ca').css("display","none");
        $('#bcancelar_ca').css("display","none");
        $('#bnuevo_ca').css("display","block");
    })

    // boton de actualizar datos de detalle de caja
    $(document).on('click','#bcatu',function(){
        
    });
    
});