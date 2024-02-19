$(document).ready(function(){
    $(document).off("click","**");
    // $('.caja1t').css('pointer-events','none');
    listar_detalle_caja();
    act_comven();
    actualizar_cabe();
    listar_cabecera();
        $('#id_perso').css("pointer-events","none");
        $('.encabe').css("pointer-events","none");
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
                if(respues=='vacio'){
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
                $('#ttota').val(respues[0].total);
                $('#nro_caja').val(respues[0].id_ca);
                $('#id_deca').val(respues[0].id_ca);
            }
        })
    }
    // actualizar_cabe($('#nro_caja').val());
    
    function actualizar_cabe(){
        // console.log(id);
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vcaja.php",
            data:{
                opcion:"actualizar_totales"
            },success:function(response){
                
            }
        })
    }
    
    
    function act_comven(){
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vcaja.php",
            data:{
                opcion:"actualizar_ventas_compras"
            },success:function(response){
                // console.log(response);
            }
        })
    }

    bloquear(true);
    function bloquear(a){
        $('.bloc').prop('disabled',a);
        $('.bloc2').prop('disabled',a);
    }
    $('#bnuevo_ca').click(function(){
        bloquear(false);
        $('.bloc').val('');
        $('.bloc2').val(0);
        $('#bguardar_ca').css("display","block");
        $('#bcancelar_ca').css("display","block");
        $('#bnuevo_ca').css("display","none");
    })
    $(document).on('click','#bguardar_ca',function(){
        let tipo=$("#tipo_mov").val();
        let moti=$("#motivo_m").val();
        // let nrod=$("#id_de_caja").val();
        let dnip=$("#dni_per").val();
        let idca=$("#nro_caja").val();
        let mont=$("#total_mo").val(); 
        let toca=$("#ttota").val();
        
        if(tipo==0){
            alert("SELECCIONA TIPO DE MOVIMIENTO");
            return;
        }
        if(moti=="" || $.isNumeric(moti)){
            alert("INGRESA MOTIVO DE MOVIMIENTO");
            return;
        }
        if(mont===0 || mont==""){
            alert("INGRESA MONTO DE MOVIMIENTO");
            return;
        }
        if(tipo==="EGRESO" && mont>toca){
            alert("INGRESASTE UN VALOR MAYOR AL DISPONIBLE");
            $("#total_mo").val("");
            $("#total_mo").focus();  
            return;
        };

        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vcaja.php",
            data:{
                dnip:dnip,
                idca:idca,
                tipo:tipo,
                moti:moti,
                mont:mont,
                opcion:"registrar_detalle"
            },success:function(response){
                alert(response);
                
                listar_cabecera();
                act_comven();
                actualizar_cabe();
                listar_detalle_caja();
                $('#bguardar_ca').css("display","none");
                $('#bcancelar_ca').css("display","none");
                $('#bnuevo_ca').css("display","block");

                bloquear(true);
                
                $('.bloc').val('');
                $('.bloc2').val(0);
                
            }
        })

        
    })
    $('.MAYR').on('input', function() {
        let currentValue = $(this).val();
        // Ahora la expresión regular permite letras, números, espacios, puntos y comas
        let newValue = currentValue.replace(/[^a-zA-Z\sÑñ.,-]/g, '');
        $(this).val(newValue.toUpperCase());
    });

    $('.NUMP').on('input', function() {
        // Obtener el valor actual del input
        let currentValue = $(this).val();
        // Remover caracteres no permitidos (que no son números, puntos ni comas)
        let newValue = currentValue.replace(/[^0-9.,]/g, '');
    
        // Reemplazar comas por puntos (si las hay)
        newValue = newValue.replace(/,/g, '.');
    
        // Actualizar el valor del input en mayúsculas
        $(this).val(newValue.toUpperCase());
    });

    $('#bmodificar_ca').click(function(){
        // if( $("#tipo_mov").val()==0){
        //     alert("SELECCIONA UN TIPO DE MOVIMIENTO A REALIZAR");
        //     return;
        // }
        if( $("#motivo_m").val()==""){
            alert("INGRESA MOTIVO DE MOVIMIENTO");
            return;
        }
        if( $("#total_mo").val()==0){
            alert("INGRESA MONTO DE MOVIMIENTO");
            return;
        }
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vcaja.php",
            data:{
                nroc:$("#id_de_caja").val(),
                moti:$("#motivo_m").val(),
                tota:$("#total_mo").val(),
                opcion:"modificar_caja"
            },success:function(response){
                alert(response);
                $('#bmodificar_ca').css("display","none");
                $('#bcancelar_ca').css("display","none");
                $('#bnuevo_ca').css("display","block");

                $("#tipo_mov").css("display","block");
                $("#tvoc").css("display","none");
                bloquear(true);
                listar_cabecera();
                act_comven();
                actualizar_cabe();
                listar_detalle_caja();
                $('.bloc').val('');
                $('.bloc2').val(0);
            }
        })
        
    })
    $('#bcancelar_ca').click(function(){
        $('#bguardar_ca').css("display","none");
        $('#bcancelar_ca').css("display","none");
        $('#bnuevo_ca').css("display","block");
        $('#bmodificar_ca').css("display","none");

        $("#tipo_mov").css("display","block");
        $("#tvoc").css("display","none");
        bloquear(true);
        $('.bloc').val('');
        $('.bloc2').val(0);
    })

    // boton par abuscar datos de actualizar en detalle de caja
    $(document).on('click','#bcatu',function(){
        const cod = $(this).data('cod');
        // console.log(cod)
        $.ajax({
            async:true,
                type:"GET",
                url:"php/controlador_vcaja.php",
                data:{
                    cod:cod,
                    opcion:"buscar"
                },success:function(response){
                    // console.log(response);
                    let res=response.trim();
                    let respuesta=JSON.parse(res);
                   $("#id_de_caja").val(respuesta[0].codmo);
                   $("#nro_caja").val(respuesta[0].idcaj);
                   $("#id_perso").val(respuesta[0].nompe);
                   $("#total_mo").val(respuesta[0].total);
                   $("#motivo_m").val(respuesta[0].motiv);
                   if(respuesta[0].tipom=="COMPRA" || respuesta[0].tipom=="VENTA"){
        
                    $("#tvoc").css("display","block");
                    $("#tvoc").val(respuesta[0].tipom);
                    $("#tipo_mov").css("display","none");
                    // $("#tvoc").css("disabled",true);
                   }else{
                    $("#tipo_mov").css("display","block");
                    $("#tvoc").css("display","none");
                    $("#tipo_mov").val(respuesta[0].tipom);
                    // $("#tipo_mov").css("disabled",true);
                    bloquear(false);
                    $("#tipo_mov").prop("disabled",true);
                    
                   }
                   
                   
                   $('#bguardar_ca').css("display","none");
                   $('#bcancelar_ca').css("display","block");
                   $('#bnuevo_ca').css("display","none");
                   $('#bmodificar_ca').css("display","block");

                }
            })
    });
    
});