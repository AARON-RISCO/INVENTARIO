$(document).ready(function(){
    $(document).off("click","**");
    listar_unidades();
    BloquearCajas();
    function listar_unidades(parametro){
        $.ajax({
            async:true,
            url:'php/controlador_unidades.php',
            type:'GET',
            data:{nombre:parametro,opcion:'listar'},
            success: function(response){
                //console.log(response)
                if(response=='vacio'){
                    $('#cuerpo_tabla_unidades').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){
                        // var cod=registro[z].cod;
                        var est=registro[z].estado;
                        var el=""; var ac="";

                        if(est==0){ var esta="HABILITADO"; el="block";  ac="none"; }
                        if(est==1){ var esta="DESHABILITADO";el="none"; ac="block";}

                        template+=
                        '<tr><td>'+registro[z].nom+
                        '</td><td>'+esta+
                        '</td><td id="icon" style="display:flex; justify-content: center;"><img src="img/editar.svg" width="40" id="bmod" class="color" data-cod="'+registro[z].cod+'"><img src="img/eliminar.svg" style="display:'+el+';" width="40" id="bir" class="color" data-cod="'+registro[z].cod+'"><img src="img/activar.svg" style="display:'+ac+';" width="40" id="bact" class="color" data-cod="'+registro[z].cod+'"></td></tr>';
                    }
                    $('#cuerpo_tabla_unidades').html(template);

                }
            }

        })
    }
 
    //buscar en la caja de texto
    $(document).on('keyup','#bus_nom',function(){
        var valor=$(this).val();
        if(valor !=""){
            listar_unidades(valor);
        }else{
            listar_unidades();
        }
    })
    //bloqueo de cajas en mantenimiento
    function BloquearCajas(){
        $('#tnom_uni').prop('disabled', true);
    }
    function DesbloquearCajas(){
        $('#tnom_uni').prop('disabled', false);
    }
    function limpiacajas(){
        $('#tnom_uni').val('');
    }

    $('#bnuevo_uni').click(function(){
        DesbloquearCajas();
        $('#bguardar_uni').css('display','block');
        $('#bcancelar_uni').css('display','block');
        $('#bnuevo_uni').css('display','none');
        $('#modificar_uni').css('display','none');
    })

    //Cancelar
    $(document).on('click', '#bcancelar_uni', function() {
            limpiacajas();
            BloquearCajas();
            $('#bguardar_uni').css('display','none');
            $('#bcancelar_uni').css('display','none');
            $('#bmodificar_uni').css('display','none');
            $('#bnuevo_uni').css('display','block');
         
    })

    //Agregar uniegoria nueva
    $(document).on('click', '#bguardar_uni', function() {
        // Obtener los valores de las cajas de texto
        const uni = $('#tnom_uni').val();
        //Validaciones

        
        // Crear el objeto de datos para enviar la solicitud
        const datos = {
            nom: uni,
            opcion: 'agregar'
          };
        
          // Enviar la solicitud AJAX
          $.get('php/controlador_unidades.php', datos, function(response) {
            alert(response);
            listar_unidades();
            limpiacajas();
            BloquearCajas();
            $('#bguardar_uni').css('display','none');
            $('#bmodificar_uni').css('display','none');
            $('#bcancelar_uni').css('display','none');
            $('#bnuevo_uni').css('display','block');
          });
    })

    //Seleccionar producto a modificar
    $(document).on('click', '#bmod', function() {
        DesbloquearCajas();
        $('#bmodificar_uni').css('display','block');
        $('#bcancelar_uni').css('display','block');
        $('#bnuevo_uni').css('display','none');
        $('#bguardar_uni').css('display','none');

        const cod = $(this).data('cod');

        const datos={
        cod:cod,
        opcion:'buscar'
        };
        $.get('php/controlador_unidades.php', datos,function(response){

            var registro=JSON.parse(response);
            $('#tcod').val(registro[0].cod);
            $('#tnom_uni').val(registro[0].nom);
        });
      })

    //actualizar unidades
    $(document).on('click', '#bmodificar_uni', function() {
        const cod = $('#tcod').val().trim();
        const nom = $('#tnom_uni').val().trim();
        //Validaciones

        
        // Crear el objeto de datos para enviar la solicitud
        const datos = {
            cod: cod,
            nom: nom,
            opcion: 'actualizar'
          };
        
          // Enviar la solicitud AJAX
          $.get('php/controlador_unidades.php', datos, function(response) {
            alert(response);
            listar_unidades();
            limpiacajas();
            BloquearCajas();
            $('#bmodificar_uni').css('display','none');
            $('#bcancelar_uni').css('display','none');
            $('#bagregar_uni').css('display','none');
            $('#bnuevo_uni').css('display','block');
          });
    })

    // boton para eliminar una categoria 
    $(document).on('click','#bir',function(){
        $('#sombra_modal_uni').css("display","block");
        $('#caja_modal_uni').css("margin-top","-30%");
        const codi = $(this).data('cod');
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_unidades.php",
            data:{
                cod:codi,
                opcion:"buscar"
            },
            success:function(respuesta){
                // console.log(respuesta);
                var registros=JSON.parse(respuesta);
                $('#namuni').html("¿ESTA SEGURO DE DESHABILITAR LA UNIDAD "+registros[0].nom+" ?");
                $('#idunim').val(registros[0].cod);
                $('#estunimod').val(registros[0].esc);
            }
        })
    })
    // boton para cancelar la habilitacion o la deshabilitacion de una categoria
    $(document).on('click','#bcaun',function(){
        $('#sombra_modal_uni').css("display","none");
        $('#caja_modal_uni').css("margin-top","-90%");
    })

    // boton para aceptar la habilitacion o la deshabilitacion de una categoria
    $(document).on('click','#bacun',function(){
        // const codi = $(this).data('cod');
        let codeli=null;
        let esteli=null;
        codeli=$('#idunim').val();
        esteli=$('#estunimod').val();
        // console.log(codeli);
        // console.log(esteli);
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_unidades.php",
            data:{
                code:codeli,
                esta:esteli,
                opcion:"deshabilitar"
            },
            success:function(respuestas){
                alert(respuestas);
                $('#sombra_modal_uni').css("display","none");
                $('#caja_modal_uni').css("margin-top","-90%");
                listar_unidades();
                
            }
        })
    })


    // boton para activar una categoria 
    $(document).on('click','#bact',function(){  
        $('#sombra_modal_uni').css("display","block");
        $('#caja_modal_uni').css("margin-top","-30%");
        const codi = $(this).data('cod');
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_unidades.php",
            data:{
                cod:codi,
                opcion:"buscar"
            },
            success:function(respuesta){
                // console.log(respuesta);
                var registros=JSON.parse(respuesta);
                $('#namuni').html("¿ESTA SEGURO DE HABILITAR LA CATEGORIA "+registros[0].nom+" ?");
                $('#idunim').val(registros[0].cod);
                $('#estunimod').val(registros[0].esc);
                listar_unidades();
            }
        })
    })



    // ---------------------------------------------------------------- CODIGO PARA VALIDAR MAYUSCULAS
    $('.MTU').on('input', function() {
        let currentValue = $(this).val();
        let newValue = currentValue.replace(/[^a-zA-Z0-9\sÑñ]/g, '');
        $(this).val(newValue.toUpperCase());
    });


     // ---------------------------------------------------------------- CODIGO PARA VALIDAR EL NO INGRESO DE NUMEROS

     $('.MTU').on('keydown', function(event) {
        // Obtener el código de la tecla presionada
        var keyCode = event.which;
    
        // Validar si la tecla presionada es un número del teclado principal o del teclado numérico
        if ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 96 && keyCode <= 105)) {
            // Prevenir la acción predeterminada (no permitir que se escriba el número)
            event.preventDefault();
        }
    });
    

})