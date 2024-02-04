$(document).ready(function(){
    $(document).off("click","**");
    listar_personal();
    BloquearCajas();
    $('#tdni_usu').prop('disabled', true);
    $('#ttipo').val(0);
    function listar_personal(dni='',ape='',nom='',car=''){
        $.ajax({
            async:true,
            url:'php/controlador_personal.php',
            type:'GET',
            data:{
                dni:dni,
                ape:ape,
                nom:nom,
                car:car,
                opcion:'listar'
            },
            success: function(response){
                response = response.trim();
                if(response=='vacio'){
                    $('#cuerpo_tabla_personal').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){

                        var est=registro[z].estado;
                        var el=""; var ac="";

                        if(est=="ACTIVO"){el="block";  ac="none";}else{el="none";  ac="block";} 

                        template+=
                        '<tr><td>'+registro[z].dni+
                        '</td><td>'+registro[z].per+
                        '</td><td>'+registro[z].car+   
                        '</td><td>'+est+      
                        '</td><td>'+'<input type="password" value="'+registro[z].clave+'" class="password">'+   
                        '</td><td id="icon" style="display:flex; justify-content: center;"><img src="img/editar.svg" width="40" id="bmod" class="color" data-cod="'+registro[z].dni+'"><img src="img/eliminar.svg" style="display:'+el+';" width="40" id="bir" class="color" data-cod="'+registro[z].dni+'"><img src="img/activar.svg" style="display:'+ac+';" width="40" id="bact" class="color" data-cod="'+registro[z].dni+'"></td></tr>';
                        // cambiarBotonEstado(cod, est);
                    }
                    $('#cuerpo_tabla_personal').html(template);
                    

                }
            }

        })
    }
    
    //buscar por dni
    $(document).on('keyup','#bus_dni',function(){
        var valor=$(this).val();
        var ape=$('#bus_ape').val();
        var nom=$('#bus_nom').val();
        var car=$('#bus_car').val();
        if(valor !=""){
            listar_personal(valor,ape,nom,car);
        }else{
            listar_personal();
        }
    })
     //buscar por dni
     $(document).on('keyup','#bus_ape',function(){
        var valor=$(this).val();
        var dni=$('#bus_dni').val();
        var nom=$('#bus_nom').val();
        var car=$('#bus_car').val();
        if(valor !=""){
            listar_personal(dni,valor,nom,car);
        }else{
            listar_personal();
        }
    })
     //buscar por dni
     $(document).on('keyup','#bus_nom',function(){
        var valor=$(this).val();
        var dni=$('#bus_dni').val();
        var ape=$('#bus_ape').val();
        var car=$('#bus_car').val();
        if(valor !=""){
            listar_personal(dni,ape,valor,car);
        }else{
            listar_personal();
        }
    })
     //buscar por dni
     $(document).on('keyup','#bus_car',function(){
        var valor=$(this).val();
        var dni=$('#bus_dni').val();
        var ape=$('#bus_ape').val();
        var nom=$('#bus_nom').val();
        if(valor !=""){
            listar_personal(dni,ape,nom,valor);
        }else{
            listar_personal();
        }
    })
    //bloqueo de cajas en mantenimiento
    function BloquearCajas(){
        $('.cajas-usu').prop('disabled', true);
        $('.bloquear').css('pointer-events', 'none');
    }
    function DesbloquearCajas(){
        $('.cajas-usu').prop('disabled', false);
        $('.bloquear').css('pointer-events', 'auto');
        
    }
    function limpiacajas(){
        $('.cajas-usu').val('');
        $('#ttipo').val('0');
    }

    $('#bnuevo_usu').click(function(){
        DesbloquearCajas();
        $('#tdni_usu').focus();
        $('#bguardar_usu').css('display','block');
        $('#bcancelar_usu').css('display','block');
        $('#bnuevo_usu').css('display','none');
        $('#modificar_usu').css('display','none');
    })

    //Cancelar
    $(document).on('click', '#bcancelar_usu', function() {
            limpiacajas();
            BloquearCajas();
            $('#bguardar_usu').css('display','none');
            $('#bcancelar_usu').css('display','none');
            $('#bmodificar_usu').css('display','none');
            $('#bnuevo_usu').css('display','block');
         
    })

    //Agregar categoria nueva
    $(document).on('click', '#bguardar_usu', function() {
        // Obtener los valores de las cajas de texto
        const dni = $('#tdni_usu').val();
        const ape = $('#tape_usu').val();
        const nom = $('#tnom_usu').val();
        const tipo = $('#ttipo').val();
        const clave = $('#clave').val();

        //Validaciones
        if(dni==""){
            alert("ERROR, INGRESE DNI !");
            $('#tdni_usu').focus();
            return;
        }
        if (dni.length !== 8) {
            alert("ERROR, INGRESE EXACTAMENTE 8 DÍGITOS !");
            $('#tdni_usu').focus();
            return;
        }
        if(ape==""){
            alert("ERROR, INGRESE APELLIDOS !");
            $('#tape_usu').focus();
            return;
        }
        if(nom==""){
            alert("ERROR, INGRESE NOMBRES !");
            $('#tnom_usu').focus();
            return;
        }
        if(tipo==0){
            alert("ERROR, SELECCIONE CARGO !");
            $('#ttipo').focus();
            return;
        }
        if(clave==""){
            alert("ERROR, INGRESE CLAVE !");
            $('#clave').focus();
            return;
        } 
                
        // Crear el objeto de datos para enviar la solicitud
        const datos = {
            dni: dni,
            ape: ape,
            nom: nom,
            tipo: tipo,
            clave: clave,
            opcion: 'agregar'
          };
        
          // Enviar la solicitud AJAX
          $.get('php/controlador_personal.php', datos, function(response) {
            alert(response);
            listar_personal();
            limpiacajas();
            BloquearCajas();
            $('#bguardar_usu').css('display','none');
            $('#bmodificar_usu').css('display','none');
            $('#bcancelar_usu').css('display','none');
            $('#bnuevo_usu').css('display','block');
          });
    })

    //Seleccionar producto a modificar
    $(document).on('click', '#bmod', function() {
        DesbloquearCajas();
        $('#tdni_usu').prop('disabled', true);  
        $('#bmodificar_usu').css('display','block');
        $('#bcancelar_usu').css('display','block');
        $('#bnuevo_usu').css('display','none');
        $('#bguardar_usu').css('display','none');

        const cod = $(this).data('cod');
       
        const datos={
        cod:cod,
        opcion:'buscar'
        };
        $.get('php/controlador_personal.php', datos,function(response){

            var registro=JSON.parse(response);
            $('#tdni_usu').val(registro[0].dni);
            $('#tape_usu').val(registro[0].ape);
            $('#tnom_usu').val(registro[0].nom);
            $('#ttipo').val(registro[0].car);
            $('#clave').val(registro[0].cla);
        });
      })

    //actualizar usuegorias
    $(document).on('click', '#bmodificar_usu', function() {
        const dni = $('#tdni_usu').val();
        const ape = $('#tape_usu').val();
        const nom = $('#tnom_usu').val();
        const tipo = $('#ttipo').val();
        const clave = $('#clave').val();

        //Validaciones
        if(dni==""){
            alert("ERROR, INGRESE DNI !");
            $('#tdni_usu').focus();
            return;
        }
        if (dni.length !== 8) {
            alert("ERROR, INGRESE EXACTAMENTE 8 DÍGITOS !");
            $('#tdni_usu').focus();
            return;
        }
        if(ape==""){
            alert("ERROR, INGRESE APELLIDOS !");
            $('#tape_usu').focus();
            return;
        }
        if(nom==""){
            alert("ERROR, INGRESE NOMBRES !");
            $('#tnom_usu').focus();
            return;
        }
        if(tipo==0){
            alert("ERROR, SELECCIONE CARGO !");
            $('#ttipo').focus();
            return;
        }
        if(clave==""){
            alert("ERROR, INGRESE CLAVE !");
            $('#clave').focus();
            return;
        } 
        // Crear el objeto de datos para enviar la solicitud
        const datos = {
            dni: dni,
            ape: ape,
            nom: nom,
            tipo: tipo,
            clave: clave,
            opcion: 'actualizar'
          };
        
          // Enviar la solicitud AJAX
          $.get('php/controlador_personal.php', datos, function(response) {
            alert(response);
            listar_personal();
            limpiacajas();
            BloquearCajas();
            $('#bmodificar_usu').css('display','none');
            $('#bcancelar_usu').css('display','none');
            $('#bagregar_usu').css('display','none');
            $('#bnuevo_usu').css('display','block');
          });
    })

    // boton para eliminar una categoria 
    $(document).on('click','#bir',function(){
        $('#sombra_modal_per').css("display","block");
        $('#caja_modal_per').css("margin-top","-30%");
        const codi = $(this).data('cod');
        // alert(codi);
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_personal.php",
            data:{
                cod:codi,
                opcion:"buscar"
            },
            success:function(respuesta){
                // console.log(respuesta);
                var registros=JSON.parse(respuesta);
                $('#namcamo').html("¿ESTA SEGURO DE DESACTVAR A "+registros[0].nom+' '+registros[0].ape+" ?");
                $('#idce').val(registros[0].dni);
                $('#estadocategoriamo').val(registros[0].estado);
            }
        })
    })
    // boton para cancelar la habilitacion o la deshabilitacion de una categoria
    $(document).on('click','#bcamo',function(){
        $('#sombra_modal_per').css("display","none");
        $('#caja_modal_per').css("margin-top","-90%");
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
            url:"php/controlador_personal.php",
            data:{
                code:codeli,
                esta:esteli,
                opcion:"deshabilitar"
            },
            success:function(respuestas){

                $('#sombra_modal_per').css("display","none");
                $('#caja_modal_per').css("margin-top","-90%");
                listar_personal();
                
            }
        })
    })

    // boton para activar una categoria 
    $(document).on('click','#bact',function(){
        $('#sombra_modal_per').css("display","block");
        $('#caja_modal_per').css("margin-top","-30%");
        const codi = $(this).data('cod');
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_personal.php",
            data:{
                cod:codi,
                opcion:"buscar"
            },
            success:function(respuesta){
                // console.log(respuesta);
                var registros=JSON.parse(respuesta);
                $('#namcamo').html("¿ESTA SEGURO DE HABILITAR LA CATEGORIA "+registros[0].nom+" ?");
                $('#idce').val(registros[0].dni);
                $('#estadocategoriamo').val(registros[0].estado);
                listar_categorias();
            }
        })
    })

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

      $('.SN').on('input', function() {
        let currentValue = $(this).val();
        
        // Elimina todos los caracteres no numéricos
        let newValue = currentValue.replace(/\D/g, '');
    
        // Limita la longitud máxima a 8 dígitos
        newValue = newValue.substring(0, 8);
    
        $(this).val(newValue);

    });

})