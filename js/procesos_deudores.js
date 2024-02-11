$(document).ready(function(){
    $(document).off("click","**");
    listar_deudores();
    BloquearCajas();
    $('.todos_detalle').css('display','none');
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
                response = response.trim();
                if(response=='vacio' || response=='[{"cod":null,"nom":null,"ape":null,"deu":null}]'){
                    $('#cuerpo_tabla_deudores').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){
                        let deuda = registro[z].deu;
                        if(deuda>0){ var el="block";  ac="none"; }
                        if(deuda==0){ var el="none"; ac="block";}
                        template+=
                        '<tr><td>'+registro[z].nom+
                        '</td><td>'+registro[z].ape+  
                        '</td><td>'+registro[z].deu+   
                        '</td><td id="icon"><img src="img/pagar.svg" class="color amarillo bpagar" style="display:'+el+';" id="'+registro[z].nom+" "+registro[z].ape+'" data-cod="'+registro[z].cod+'" alt="Pagar"><img src="img/eliminar.svg" class="color red beliminar" style="display:'+ac+';" data-cod="'+registro[z].cod+'" ></td></tr>';
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

    //Ir a detalle de deudor
    $(document).on('click', '.bpagar', function() {
        const cod = $(this).data('cod');
        $('.oculto2').val(cod);

        var deudor=$(event.target).attr('id');
        $('#ruta').html('>'+ " " + deudor);
        $('.todos_todos').css('display','none');
        $('.todos_detalle').css('display','block');
        const datos={
            cod:cod,
            opcion:'listar_ventas'
        }
        $.get('php/controlador_deudores.php', datos, function(response) {
            response = response.trim();
            if(response=='vacio'){
                $('#cuerpo_tabla_detalle_deudores').html('');
            }else{
                var registro=JSON.parse(response);
                var template='';
                for(z in registro){
                    var cod=registro[z].cod;
                    template+=
                    '<tr><td>'+registro[z].fecha+
                    '</td><td>'+registro[z].ven+  
                    '</td><td>'+registro[z].deu+   
                    '</td><td id="icon"><label id="bpagar"  data-cod="'+registro[z].cod+'" >Pagar</label><label id="bver"  data-cod="'+registro[z].cod+'">Detalle</label></td></tr>';
                }
                $('#cuerpo_tabla_detalle_deudores').html(template);
            }
        })

    })

    $(document).on('click', '#todos_deudores', function() {
        $('#ruta').html('');
        $('.todos_todos').css('display','block');
        $('.todos_detalle').css('display','none');
        listar_deudores();
    })

    $(document).on('click', '#bpagar', function() {
        const cod = $(this).data('cod');
        const venta = parseFloat($('.oculto2').val());
        var pago;
    
        const datos = {
            cod: cod,
            opcion: 'buscar_deuda'
        };
    
        $.get('php/controlador_deudores.php', datos, function(response) {
            response = response.trim();
            var registro = JSON.parse(response);
            $('.oculto').val(registro[0].deu);
    
            const deuda = parseFloat($('.oculto').val());
    
            do {
                pago = prompt("Ingrese Cantidad", "");
            } while (pago !== null && (!validarPrecio(pago) || pago.trim() === '' || pago > deuda));
    
            if (pago === null) {
                // El usuario ha cancelado el prompt
                return;
            } else {
                //procede a descontar deuda
                const datos2={
                    cod:cod,
                    pago:pago,
                    opcion:'pagar'
                }
                $.get('php/controlador_deudores.php', datos2, function(response) {
                    response = response.trim();
                    alert(response);
                    listar_deudores();
                    const datos3={
                        cod:venta,
                        opcion:'listar_ventas'
                    }
                    $.get('php/controlador_deudores.php', datos3, function(response) {
                        response = response.trim();
                        if(response=='vacio'){
                            $('#cuerpo_tabla_detalle_deudores').html('');
                                $('#ruta').html('');
                                $('.todos_todos').css('display','block');
                                $('.todos_detalle').css('display','none');
                                listar_deudores();
                                alert('EL CLIENTE PAGO TODA SU DEUDA');
                        }else{
                            var registro=JSON.parse(response);
                            var template='';
                            for(z in registro){
                                var cod=registro[z].cod;
                                template+=
                                '<tr><td>'+registro[z].fecha+
                                '</td><td>'+registro[z].ven+  
                                '</td><td>'+registro[z].deu+   
                                '</td><td id="icon"><label id="bpagar"  data-cod="'+registro[z].cod+'" >Pagar</label><label id="bver"  data-cod="'+registro[z].cod+'">Detalle</label></td></tr>';
                            }
                            $('#cuerpo_tabla_detalle_deudores').html(template);
                        }
                    })
                })
            }
        });
    });
    

    function validarPrecio(valor) {
        // Expresión regular que permite números y puntos decimales
        var regex = /^[0-9]+(\.[0-9]+)?$/;
        return regex.test(valor);
    }

    // boton para cerrar la ventana modal de ver ventas
    $(document).on('click','#bcavv',function(){
        $('#sombra_modal_vventas').css("display","none");
        $('#caja_modal_vventas').css("margin-top","-90%");
        
    });

    $(document).on('click','#bver',function(){
        $('#sombra_modal_vventas').css("display","block");
        $('#caja_modal_vventas').css("margin-top","-25%");
        $('#bacvv').css("display","none");
        const codi = $(this).data('cod');
        // console.log(codi)
        $(".iddv").html( "DETALLE DE LA VENTA N°: "+codi);
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vventas.php",
            data:{
                cod:codi,
                opcion:"listar_detalle"
            },
            success:function(respon){
                if(respon=='vacio'){
                    $('#cuerpo_tabla_vdventa').html('');
                }else{
                    var registro=JSON.parse(respon);
                    $('#ttdv').html("S/. "+registro[0].neto);

                    var template='';
                    for(z in registro){
                        
                        var est=registro[z].icev;
                        // var el=""; var ac="";
                        var nomest;

                        if(est==0){  nomest="NO"}
                        if(est>0){  nomest="SI"}

                        template+=
                        '<tr><td>'+registro[z].cant+
                        '</td><td>'+registro[z].nopr+
                        '</td><td>S/. '+registro[z].prec+
                        '</td><td>'+nomest+
                        '</td><td>S/. '+registro[z].totv+
                        '</td></tr>';
                    }
                    $('#cuerpo_tabla_vdventa').html(template);

                }
            }
        });
        // alert("funciona ver ");
    });

    $(document).on('click','.beliminar',function(){
        const cod = $(this).data('cod');
        const datos={
            cod:cod,
            opcion:'eliminar'
        }
        $.get('php/controlador_deudores.php',datos,function(response){
            alert(response);
            listar_deudores();
        })
    });


    // ---------------------------------------------------------------- CODIGO PARA VALIDAR MAYUSCULAS
    $('.MAYP').on('input', function() {
        let currentValue = $(this).val();
        let newValue = currentValue.replace(/[^a-zA-Z0-9\sÑñ]/g, '');
        $(this).val(newValue.toUpperCase());
    });

    // ---------------------------------------------------------------- CODIGO PARA VALIDAR EL NO INGRESO DE NUMEROS
    $('.MAYP').on('keydown', function(event) {
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