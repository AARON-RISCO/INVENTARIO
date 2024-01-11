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
                        cod=registro[z].cod;
                        est=registro[z].estado;
                        if (est==0) {
                            esta="HABILITADO";
                        } else {
                            esta="DESHABILITADO";
                        }
                        template+=
                        '<tr><td>'+registro[z].nom+
                        '</td><td>'+esta+
                        '</td><td id="icon"><img src="img/editar.svg" width="40" id="bmod" class="color" data-cod="'+registro[z].cod+'"><img src="img/eliminar.svg" width="40" id="bir" class="color" data-cod="'+registro[z].cod+'"></td></tr>';
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
})