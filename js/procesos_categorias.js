$(document).ready(function(){
    $(document).off("click","**");
    listar_categorias();
    BloquearCajas();
    function listar_categorias(parametro){
        $.ajax({
            async:true,
            url:'php/controlador_categorias.php',
            type:'GET',
            data:{nombre:parametro,opcion:'listar'},
            success: function(response){
                //console.log(response)
                if(response=='vacio'){
                    $('#cuerpo_tabla_categorias').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){
                        var cod=registro[z].cod;
                        var est=registro[z].estado;
                        var el=""; var ac="";

                        if(est==0){ var esta="HABILITADO"; el="block";  ac="none"; }
                        if(est==1){ var esta="DESHABILITADO";el="none"; ac="block";}

                        template+=
                        '<tr><td>'+registro[z].nom+
                        '</td><td>'+esta+   
                        '</td><td id="icon" style="display:flex; justify-content: center;"><img src="img/editar.svg" width="40" id="bmod" class="color" data-cod="'+registro[z].cod+'"><img src="img/eliminar.svg" style="display:'+el+';" width="40" id="bir" class="color" data-cod="'+registro[z].cod+'"><img src="img/activar.svg" style="display:'+ac+';" width="40" id="bact" class="color" data-cod="'+registro[z].cod+'"></td></tr>';
                        // cambiarBotonEstado(cod, est);
                    }
                    $('#cuerpo_tabla_categorias').html(template);
                    

                }
            }

        })
    }
    
    

        
 
    //buscar en la caja de texto
    $(document).on('keyup','#bus_nom',function(){
        var valor=$(this).val();
        if(valor !=""){
            listar_categorias(valor);
        }else{
            listar_categorias();
        }
    })
    //bloqueo de cajas en mantenimiento
    function BloquearCajas(){
        $('#tnom_cat').prop('disabled', true);
    }
    function DesbloquearCajas(){
        $('#tnom_cat').prop('disabled', false);
    }
    function limpiacajas(){
        $('#tnom_cat').val('');
    }

    $('#bnuevo_cat').click(function(){
        DesbloquearCajas();
        $('#bguardar_cat').css('display','block');
        $('#bcancelar_cat').css('display','block');
        $('#bnuevo_cat').css('display','none');
        $('#modificar_cat').css('display','none');
    })

    //Cancelar
    $(document).on('click', '#bcancelar_cat', function() {
            limpiacajas();
            BloquearCajas();
            $('#bguardar_cat').css('display','none');
            $('#bcancelar_cat').css('display','none');
            $('#bmodificar_cat').css('display','none');
            $('#bnuevo_cat').css('display','block');
         
    })

    //Agregar categoria nueva
    $(document).on('click', '#bguardar_cat', function() {
        // Obtener los valores de las cajas de texto
        const cat = $('#tnom_cat').val();
        //Validaciones
        if($('#tnom_cat').val()==""){
            alert("caja vacia");
            return;
        }
        
        // Crear el objeto de datos para enviar la solicitud
        const datos = {
            nom: cat,
            opcion: 'agregar'
          };
        
          // Enviar la solicitud AJAX
          $.get('php/controlador_categorias.php', datos, function(response) {
            alert(response);
            listar_categorias();
            limpiacajas();
            BloquearCajas();
            $('#bguardar_cat').css('display','none');
            $('#bmodificar_cat').css('display','none');
            $('#bcancelar_cat').css('display','none');
            $('#bnuevo_cat').css('display','block');
          });
    })

    //Seleccionar producto a modificar
    $(document).on('click', '#bmod', function() {
        DesbloquearCajas();
        $('#bmodificar_cat').css('display','block');
        $('#bcancelar_cat').css('display','block');
        $('#bnuevo_cat').css('display','none');
        $('#bguardar_cat').css('display','none');

        const cod = $(this).data('cod');

        const datos={
        cod:cod,
        opcion:'buscar'
        };
        $.get('php/controlador_categorias.php', datos,function(response){

            var registro=JSON.parse(response);
            $('#tcod').val(registro[0].cod);
            $('#tnom_cat').val(registro[0].nom);
        });
      })

    //actualizar categorias
    $(document).on('click', '#bmodificar_cat', function() {
        const cod = $('#tcod').val().trim();
        const nom = $('#tnom_cat').val().trim();
        //Validaciones

        
        // Crear el objeto de datos para enviar la solicitud
        const datos = {
            cod: cod,
            nom: nom,
            opcion: 'actualizar'
          };
        
          // Enviar la solicitud AJAX
          $.get('php/controlador_categorias.php', datos, function(response) {
            alert(response);
            listar_categorias();
            limpiacajas();
            BloquearCajas();
            $('#bmodificar_cat').css('display','none');
            $('#bcancelar_cat').css('display','none');
            $('#bagregar_cat').css('display','none');
            $('#bnuevo_cat').css('display','block');
          });
    })

    // boton para eliminar una categoria 
    $(document).on('click','#bir',function(){
        $('#sombra_modal_cat').css("display","block");
        $('#caja_modal_cat').css("margin-top","-30%");
        const codi = $(this).data('cod');
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_categorias.php",
            data:{
                cod:codi,
                opcion:"buscar"
            },
            success:function(respuesta){
                // console.log(respuesta);
                var registros=JSON.parse(respuesta);
                $('#namcamo').html("¿ESTA SEGURO DE DESHABILITAR LA CATEGORIA "+registros[0].nom+" ?");
                $('#idce').val(registros[0].cod);
                $('#estadocategoriamo').val(registros[0].esc);
            }
        })
    })
    // boton para cancelar la habilitacion o la deshabilitacion de una categoria
    $(document).on('click','#bcamo',function(){
        $('#sombra_modal_cat').css("display","none");
        $('#caja_modal_cat').css("margin-top","-90%");
    })

    // boton para aceptar la habilitacion o la deshabilitacion de una categoria
    $(document).on('click','#bamo',function(){
        // const codi = $(this).data('cod');
        let codeli=null;
        let esteli=null;
        codeli=$('#idce').val();
        esteli=$('#estadocategoriamo').val();
        // console.log(codeli);
        // console.log(esteli);
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_categorias.php",
            data:{
                code:codeli,
                esta:esteli,
                opcion:"deshabilitar"
            },
            success:function(respuestas){
                alert(respuestas);
                $('#sombra_modal_cat').css("display","none");
                $('#caja_modal_cat').css("margin-top","-90%");
                listar_categorias();
                
            }
        })
    })


    // boton para activar una categoria 
    $(document).on('click','#bact',function(){
        $('#sombra_modal_cat').css("display","block");
        $('#caja_modal_cat').css("margin-top","-30%");
        const codi = $(this).data('cod');
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_categorias.php",
            data:{
                cod:codi,
                opcion:"buscar"
            },
            success:function(respuesta){
                // console.log(respuesta);
                var registros=JSON.parse(respuesta);
                $('#namcamo').html("¿ESTA SEGURO DE HABILITAR LA CATEGORIA "+registros[0].nom+" ?");
                $('#idce').val(registros[0].cod);
                $('#estadocategoriamo').val(registros[0].esc);
                listar_categorias();
            }
        })
    })


   

})