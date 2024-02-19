$(document).ready(function(){

    listar_caja();
    function listar_caja(parametro1,parametro2){
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_in_eg.php",
            data:{
                p1:parametro1,
                p2:parametro2,
                opcion:"listar_caja"
            },success:function(response){
                // console.log(response);
                let respues=response.trim();
                if(respues=='vacio'){
                    $('#cuerpo_tabla_caja_cab').html('');
                }else{
                    var registro=JSON.parse(respues);
                    let co=0;
                    var template='';
                    for(z in registro){
                        co++;
                        template+=
                        '<tr><td>'+co+
                        '</td><td>'+registro[z].fecha+
                        '</td><td>S/. '+registro[z].apert+
                        '</td><td>S/. '+registro[z].ingre+
                        '</td><td>S/. '+registro[z].egres+
                        '</td><td>S/. '+registro[z].total+
                        '</td><td id="op"><img src="img/verv.svg" width="35" id="bverdc" data-cod="'+registro[z].idcaj+'"></td></tr>';
                        '</td></tr>';
                    }
                    $('#cuerpo_tabla_caja_cab').html(template);
                }
            }
        })
    }


    // codigo para filtrar por fecha
    $(document).on('change', '#tfci, #tfcf', function() {
        var fechai = $('#tfci').val();
        var fechaf = $('#tfcf').val();

        if (fechaf.length > 0 && fechai.length > 0 && fechai <= fechaf) {
            listar_caja(fechai,fechaf);
            $('#tfcf').css('border','1px solid green');
            // console.log(fechai+" ---"+fechaf);
        } else {
            listar_caja();
            $('#tfcf').val('');
            $('#tfcf').css('border','1px solid red');
        }
    });

    $(document).on("click",'#bverdc',function (){
        $('#modal_caja').css('margin-top','0');
        $('#fondo_mc').css('display','block');
        let val=$(this).data('cod');
        // console.log(val)
        listar_detalle_c(val);
    })

    function listar_detalle_c(parametro){
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_in_eg.php",
            data:{
                p1:parametro,
                opcion:"listar_detalle_c"
            },success:function(response){
                // console.log(response);
                let respues=response.trim();
                if(respues=='vacio'){
                    $('#cuerpo_tabla_dectca').html('');
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
                        '</td></tr>';
                    }
                    $('#cuerpo_tabla_dectca').html(template);
                }
            }
        })
    }

    $(document).on('click','.ccm',function(){
        $('#modal_caja').css('margin-top','-100%');
        $('#fondo_mc').css('display','none');
    })

});