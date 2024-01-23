$(document).ready(function(){
    $(document).off("click","**");
    listar_deudores();
    BloquearCajas();
    function listar_deudores(nom='',ape=''){
        $.ajax({
            async:true,
            url:'php/controlador_deudores.php',
            type:'GET',
            data:{
                nom:nom,
                ape:ape,
                opcion:'listar'
            },
            success: function(response){

                if(response=='vacio'){
                    $('#cuerpo_tabla_deudores').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){
                        var cod=registro[z].cod;

                        template+=
                        '<tr><td>'+registro[z].nom+
                        '</td><td>'+registro[z].ape+  
                        '</td><td>'+registro[z].ape+   
                        '</td><td id="icon"><img src="img/pagar.svg" class="color amarillo" id="bpagar" data-cod="'+registro[z].cod+'" alt="Pagar"><img src="img/editar.svg" class="color rojo" id="bmod" data-cod="'+registro[z].cod+'"></td></tr>';
                    }
                    $('#cuerpo_tabla_deudores').html(template);
                    

                }
            }

        })
    }
    
    //buscar por nombres
    $(document).on('keyup','#bus_nom',function(){
        var valor=$(this).val();
        var ape=$('#bus_ape').val();
        if(valor !=""){
            listar_deudores(valor,ape);
        }else{
            listar_deudores();
        }
    })

    //buscar por apellidos
    $(document).on('keyup','#bus_ape',function(){
        var valor=$(this).val();
        var nom=$('#bus_nom').val();
        if(valor !=""){
            listar_deudores(nom,valor);
        }else{
            listar_deudores();
        }
    })
    //bloqueo de cajas en mantenimiento
    function BloquearCajas(){
        $('#tnom_deu').prop('disabled', true);
        $('#tape_deu').prop('disabled', true);
    }
    function DesbloquearCajas(){
        $('#tnom_deu').prop('disabled', false);
        $('#tape_deu').prop('disabled', false);
    }
    function limpiacajas(){
        $('#tnom_deu').val('');
        $('#tape_deu').val('');
    }

    $('#bnuevo_deu').click(function(){
        DesbloquearCajas();
        $('#bguardar_deu').css('display','block');
        $('#bcancelar_deu').css('display','block');
        $('#bnuevo_deu').css('display','none');
        $('#modificar_deu').css('display','none');
    })

    //Cancelar
    $(document).on('click', '#bcancelar_deu', function() {
            limpiacajas();
            BloquearCajas();
            $('#bguardar_deu').css('display','none');
            $('#bcancelar_deu').css('display','none');
            $('#bmodificar_deu').css('display','none');
            $('#bnuevo_deu').css('display','block');
         
    })

    // //Agregar categoria nueva
    // $(document).on('click', '#bguardar_cat', function() {
    //     // Obtener los valores de las cajas de texto
    //     const cat = $('#tnom_cat').val();
    //     //Validaciones
    //     if($('#tnom_cat').val()==""){
    //         alert("caja vacia");
    //         return;
    //     }
        
    //     // Crear el objeto de datos para enviar la solicitud
    //     const datos = {
    //         nom: cat,
    //         opcion: 'agregar'
    //       };
        
    //       // Enviar la solicitud AJAX
    //       $.get('php/controlador_categorias.php', datos, function(response) {
    //         alert(response);
    //         listar_categorias();
    //         limpiacajas();
    //         BloquearCajas();
    //         $('#bguardar_cat').css('display','none');
    //         $('#bmodificar_cat').css('display','none');
    //         $('#bcancelar_cat').css('display','none');
    //         $('#bnuevo_cat').css('display','block');
    //       });
    // })

    // //Seleccionar producto a modificar
    // $(document).on('click', '#bmod', function() {
    //     DesbloquearCajas();
    //     $('#bmodificar_cat').css('display','block');
    //     $('#bcancelar_cat').css('display','block');
    //     $('#bnuevo_cat').css('display','none');
    //     $('#bguardar_cat').css('display','none');

    //     const cod = $(this).data('cod');

    //     const datos={
    //     cod:cod,
    //     opcion:'buscar'
    //     };
    //     $.get('php/controlador_categorias.php', datos,function(response){

    //         var registro=JSON.parse(response);
    //         $('#tcod').val(registro[0].cod);
    //         $('#tnom_cat').val(registro[0].nom);
    //     });
    //   })

    // //actualizar categorias
    // $(document).on('click', '#bmodificar_cat', function() {
    //     const cod = $('#tcod').val().trim();
    //     const nom = $('#tnom_cat').val().trim();
    //     //Validaciones

        
    //     // Crear el objeto de datos para enviar la solicitud
    //     const datos = {
    //         cod: cod,
    //         nom: nom,
    //         opcion: 'actualizar'
    //       };
        
    //       // Enviar la solicitud AJAX
    //       $.get('php/controlador_categorias.php', datos, function(response) {
    //         alert(response);
    //         listar_categorias();
    //         limpiacajas();
    //         BloquearCajas();
    //         $('#bmodificar_cat').css('display','none');
    //         $('#bcancelar_cat').css('display','none');
    //         $('#bagregar_cat').css('display','none');
    //         $('#bnuevo_cat').css('display','block');
    //       });
    // })

    // ---------------------------------------------------------------- CODIGO PARA VALIDAR MAYUSCULAS
    $('.MT').on('input', function() {
        let currentValue = $(this).val();
        let newValue = currentValue.replace(/[^a-zA-Z0-9\sÑñ]/g, '');
        $(this).val(newValue.toUpperCase());
    });

    // ---------------------------------------------------------------- CODIGO PARA VALIDAR EL NO INGRESO DE NUMEROS
    $('.MT').on('keydown', function(event) {
        // Obtener el código de la tecla presionada
        // Obtener el código de la tecla presionada
        var keyCode = event.which;
    
        // Validar si la tecla presionada es un número del teclado principal o del teclado numérico
        if ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 96 && keyCode <= 105)) {
            // Prevenir la acción predeterminada (no permitir que se escriba el número)
            event.preventDefault();
        }
      });



   

})