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
                        '</td><td id="icon"><img src="img/pagar.svg" class="color amarillo bpagar" data-cod="'+registro[z].cod+'" alt="Pagar"></td></tr>';
                    }
                    $('#cuerpo_tabla_promociones').html(template);
                    

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

    function BloquearCajas(){
        $('.cajas-promo').prop('disabled', true);
    }
    function DesbloquearCajas(){
        $('.cajas-promo').prop('disabled', false);
    }
    function limpiacajas(){
        $('.cajas-promo').val('');
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