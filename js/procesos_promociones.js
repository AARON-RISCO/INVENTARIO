$(document).ready(function(){
    $(document).off("click","**");
    listar_promociones();
    BloquearCajas();
    function listar_promociones(nom='',sa=''){
        $.ajax({
            async:true,
            url:'php/controlador_promociones.php',
            type:'GET',
            data:{
                nom:nom,
                sa:sa,
                opcion:'listar'
            },
            success: function(response){
                response = response.trim();
                if(response=='vacio' || response=='[{"cod":null,"nom":null,"ape":null,"deu":null}]'){
                    $('#cuerpo_tabla_promociones').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){
                        template+=
                        '<tr><td>'+registro[z].nom+
                        '</td><td>'+registro[z].sa+  
                        '</td><td>'+registro[z].can+   
                        '</td><td>'+registro[z].pre+ 
                        '</td><td id="icon"><img src="img/editar.svg" class="color amarillo" id="mod" data-cod="'+registro[z].cod+'" alt="Pagar"><img src="img/eliminar.svg" id="eli" class="color red" data-cod="'+registro[z].cod+'"></td></tr>';
                    }
                    $('#cuerpo_tabla_promociones').html(template);
                    

                }
            }

        })
    }
    function listar_productos(parametro){
        $.ajax({
            async:true,
            url:'php/controlador_promociones.php',
            type:'GET',
            data:{
                nom:parametro,
                opcion:'listar_productos'
            },
            success: function(response){
            if(response=='vacio'){
                $('#cuerpo_tabla_productos').html('');
            }else{
                var registro=JSON.parse(response);
                var template='';
                for(z in registro){
                    template+=
                    '<tr><td>'+registro[z].nom+
                    '</td><td>'+registro[z].sa+  
                    '</td><td>'+registro[z].pre+   
                    '</td><td id="icon"><img src="img/activar.svg" class="color amarillo" id="bselec" data-cod="'+registro[z].cod+'" ></td></tr>';
                }
                $('#cuerpo_tabla_productos').html(template);
            }
            }
           
        })
    }
    
    //buscar por nombres
    $(document).on('keyup','#bus_nom',function(){
        var valor=$(this).val();
        var sa=$('#bus_sa').val();
        if(valor !=""){
            listar_promociones(valor,sa);
        }else{
            listar_promociones();
        }
    })

    //buscar por apellidos
    $(document).on('keyup','#bus_sa',function(){
        var valor=$(this).val();
        var nom=$('#bus_nom').val();
        if(valor !=""){
            listar_promociones(nom,valor);
        }else{
            listar_promociones();
        }
    })

    //buscar en modal
    $(document).on('keyup','#buscar',function(){
        var valor=$(this).val();
        if(valor !=""){
            listar_productos(valor);
        }else{
            listar_productos();
        }
    })

    function BloquearCajas(){
        $('.cajas-promo').prop('disabled', true);
        $('.bus_promo').prop('disabled', true);
    }
    function DesbloquearCajas(){
        $('.cajas-promo').prop('disabled', false);
        $('.bus_promo').prop('disabled', false);
    }
    function limpiacajas(){
        $('.cajas-promo').val('');
        $('#tcod_pro').val('');
    }   

    $('#bnuevo_promo').click(function(){
        DesbloquearCajas();
        $('#bguardar_promo').css('display','block');
        $('#bcancelar_promo').css('display','block');
        $('#bnuevo_promo').css('display','none');
        $('#modificar_promo').css('display','none');
    })

    //Cancelar
    $(document).on('click', '#bcancelar_promo', function() {
            limpiacajas();
            BloquearCajas();
            $('#bguardar_promo').css('display','none');
            $('#bcancelar_promo').css('display','none');
            $('#bmodificar_promo').css('display','none');
            $('#bnuevo_promo').css('display','block');
         
    })

    //Extraer nombres del producto seleccionado
    $(document).on('click', '#bselec', function() {
       const cod = $(this).data("cod");
       const datos={
        cod:cod,
        opcion:'extraer_pro'
       }
       $.get('php/controlador_promociones.php',datos,function(response){
            $('.modal').css('margin-top','-90%');
            $('.fondo').css('display','none');
            $('#buscar').val("");
            listar_productos();
            var registro = JSON.parse(response);
            $("#tcod_pro").val(registro[0].cod);
            $("#tnom").val(registro[0].nom);
            $("#tsa").val(registro[0].sa);
       })
    }) 

    //Agregar nueva promocion
    $(document).on('click', '#bguardar_promo', function() {
        // Obtener los valores de las cajas de texto
        const cod = $('#tcod_pro').val().trim();
        const can = $('#tcan').val().trim();
        const pre = $('#tpre').val().trim();
        //Validaciones  
        if (cod=="") {
            alert("Seleccione un producto , Por favor !");
            return;
        }
        if (can=="") {
            alert("Ingrese Cantidad");
            $('#tcan').focus();
            return;
        }
        if (pre=="") {
            alert("Ingrese Precio");
            $('#tpre').focus();
            return;
        }
        // Crear el objeto de datos para enviar la solicitud
        const datos = {
            cod: cod,
            can:can,
            pre:pre,
            opcion: 'agregar_promo'
          };
      
          // Enviar la solicitud AJAX
          $.get('php/controlador_promociones.php', datos, function(response) {
            alert(response);
            listar_promociones();
            limpiacajas();
            BloquearCajas();
            $('#bguardar_promo').css('display','none');
            $('#bcancelar_promo').css('display','none');
            $('#bmodificar_promo').css('display','none');
            $('#bnuevo_promo').css('display','block');
          });
    })  

    // Seleccionar promocion a modificar
    $(document).on('click', '#mod', function() {
        DesbloquearCajas();
        $('#bguardar_promo').css('display','none');
        $('#bcancelar_promo').css('display','block');
        $('#bnuevo_promo').css('display','none');
        $('#bmodificar_promo').css('display','block');  
        const cod = $(this).data('cod');    
        const datos={
        cod:cod,
        opcion:'buscar_promo'
        };
        $.get('php/controlador_promociones.php', datos,function(response){ 
            var registro=JSON.parse(response);
            $('#tcod').val(registro[0].cod);
            $('#tcod_pro').val(registro[0].cod_pro);
            $('#tnom').val(registro[0].nom);
            $('#tsa').val(registro[0].sa);
            $('#tcan').val(registro[0].can);
            $('#tpre').val(registro[0].pre);
        });
    })

    //actualizar promocion
    $(document).on('click', '#bmodificar_promo', function() {
         // Obtener los valores de las cajas de texto
         const cod = $('#tcod').val().trim();
         const cod_pro = $('#tcod_pro').val().trim();
         const can = $('#tcan').val().trim();
         const pre = $('#tpre').val().trim();
         //Validaciones  
         if (cod_pro=="") {
             alert("Seleccione un producto , Por favor !");
             return;
         }
         if (can=="") {
             alert("Ingrese Cantidad");
             $('#tcan').focus();
             return;
         }
         if (pre=="") {
             alert("Ingrese Precio");
             $('#tpre').focus();
             return;
         }
        //Validaciones  

        // Crear el objeto de datos para enviar la solicitud
        const datos = {
            cod: cod,
            cod_pro: cod_pro,
            can: can,
            pre: pre,
            opcion: 'actualizar'
          };
      
          // Enviar la solicitud AJAX
          $.get('php/controlador_promociones.php', datos, function(response) {
            alert(response);
            listar_promociones();
            limpiacajas();
            BloquearCajas();
            $('#bguardar_promo').css('display','none');
            $('#bcancelar_promo').css('display','none');
            $('#bmodificar_promo').css('display','none');
            $('#bnuevo_promo').css('display','block');
          });
    })  

    //Eliminar promocion
    $(document).on('click', '#eli', function() {
        const cod = $(this).data('cod');
        const datos={
            cod:cod,
            opcion:'eliminar'
        }
        $.get('php/controlador_promociones.php',datos,function(response){
            alert(response);
            listar_promociones();
        })
   })  

    //abrir modal
    $(document).on('click', '.bus_promo', function() {
        $('.fondo').css('display','block');
        $('.modal').css('margin-top','-10%');
        listar_productos();
    }) 

    //Cerrar modal
    $(document).on('click', '.cerrar_modal', function() {
        $('.modal').css('margin-top','-90%');
        $('.fondo').css('display','none');
        $('#buscar').val("");
        listar_productos();
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

    $('.NUM').on('input', function(event) {
        // Obtener el valor actual del campo
        var inputValue = $(this).val();
    
        // Reemplazar cualquier caracter no numérico por una cadena vacía
        var numericValue = inputValue.replace(/\D/g, '');
    
        // Actualizar el valor del campo con la versión numérica
        $(this).val(numericValue);
    });

    $('.MPRE').on('input', function(event) {
        // Obtener el valor actual del campo
        var inputValue = $(this).val();
    
        // Reemplazar cualquier caracter no numérico o punto decimal por una cadena vacía
        var numericValue = inputValue.replace(/[^\d.]/g, '');
    
        // Actualizar el valor del campo con la versión numérica
        $(this).val(numericValue);
    });

 

})