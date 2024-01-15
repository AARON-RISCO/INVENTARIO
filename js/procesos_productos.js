$(document).ready(function(){
    $(document).off("click","**");
    listar_productos();
    llenar_categorias();
    llenar_unidades();
    BloquearCajas();
    function listar_productos(parametro){
        $.ajax({
            async:true,
            url:'php/controlador_productos.php',
            type:'GET',
            data:{nombre:parametro,opcion:'listar'},
            success: function(response){
                //console.log(response)
                if(response=='vacio'){
                    $('#cuerpo_tabla_productos').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){
                        cod=registro[z].cod;
                        template+=
                        '<tr><td>'+registro[z].cat+
                        '</td><td>'+registro[z].nom+
                        '</td><td>'+registro[z].sa+
                        '</td><td>'+registro[z].uni+
                        '</td><td>'+registro[z].pre+
                        '</td><td>'+registro[z].actual+
                        '</td><td id="icon"><img src="img/editar.svg" width="40" id="bmod" class="color" data-cod="'+registro[z].cod+'"><img src="img/eliminar.svg" width="40" id="bir" class="color" data-cod="'+registro[z].cod+'"></td></tr>';
                    }
                    $('#cuerpo_tabla_productos').html(template);

                }
            }

        })
    }
    function listar_productos_por_sabores(){
        const sabores = $('#bus_sa').val().trim();
        const datos={
            sabor:sabores,
            opcion:'listar_sabores'
        };
        $.get('php/controlador_productos.php', datos,function(response){
            if(response=='vacio'){
                $('#cuerpo_tabla_productos').html('');
            }else{
                var registro=JSON.parse(response);
                var template='';
                for(z in registro){
                    cod=registro[z].cod;
                    template+=
                    '<tr><td>'+registro[z].cat+
                    '</td><td>'+registro[z].nom+
                    '</td><td>'+registro[z].sa+
                    '</td><td>'+registro[z].uni+
                    '</td><td>'+registro[z].pre+
                    '</td><td>'+registro[z].actual+
                    '</td><td id="icon"><img src="img/editar.svg" width="40" id="bmod" class="color" data-cod="'+registro[z].cod+'"><img src="img/eliminar.svg" width="40" id="bir" class="color" data-cod="'+registro[z].cod+'"></td></tr>';
                }
                $('#cuerpo_tabla_productos').html(template);
            }
        })
        
    }
    function listar_productos_por_categorias(){
        const categoria = $('#tcategoria').val().trim();
        const datos={
            categoria:categoria,
            opcion:'listar_por_categorias'
        };
        $.get('php/controlador_productos.php', datos,function(response){
            if(response=='vacio'){
                $('#cuerpo_tabla_productos').html('');
            }else{
                var registro=JSON.parse(response);
                var template='';
                for(z in registro){
                    cod=registro[z].cod;
                    template+=
                    '<tr><td>'+registro[z].cat+
                    '</td><td>'+registro[z].nom+
                    '</td><td>'+registro[z].sa+
                    '</td><td>'+registro[z].uni+
                    '</td><td>'+registro[z].pre+
                    '</td><td>'+registro[z].actual+
                    '</td><td id="icon"><img src="img/editar.svg" width="40" id="bmod" class="color" data-cod="'+registro[z].cod+'"><img src="img/eliminar.svg" width="40" id="bir" class="color" data-cod="'+registro[z].cod+'"></td></tr>';
                }
                $('#cuerpo_tabla_productos').html(template);
            }
        })
        
    }
    function llenar_categorias(){
        $.ajax({
            async:true,
            type: "GET",
            data:{opcion:'listar_categorias'},
            url: "php/controlador_categorias.php",
            success: function(response){
                $('#tcat').html(response);
                $('#tcategoria').html(response);
            }
        });
    }
    function llenar_unidades(){
        $.ajax({
            async:true,
            type: "GET",
            data:{opcion:'listar_unidades'},
            url: "php/controlador_unidades.php",
            success: function(response){
                $('#tuni').html(response);
            }
        });
    }
    //buscar en la caja de texto
    $(document).on('keyup','#bus_nom',function(){
        var valor=$(this).val();
        if(valor !=""){
            listar_productos(valor);
        }else{
            listar_productos();
        }
    })
    //buscar en la caja de texto sabores    
    $(document).on('keyup','#bus_sa',function(){
        var valor=$(this).val();
        if(valor !=""){
            listar_productos_por_sabores(valor);
        }else{
            listar_productos_por_sabores();
        }
    })
    //buscar prouctos por categorias
    $(document).on('change','#tcategoria',function(){
        var valor=$(this).val();
        if(valor !=0){
            listar_productos_por_categorias(valor);
        }else{
            listar_productos();
        }
    })
    //bloqueo de cajas en mantenimiento
    function BloquearCajas(){
        $('#tcat').css('pointer-events', 'none');
        $('.ir_cat').prop('disabled', true);
        $('#tnom_pro').prop('disabled', true);
        $('#tsabor').prop('disabled', true);
        $('#tuni').css('pointer-events', 'none');
        $('.ir_uni').prop('disabled', true);
        $('#tpre').prop('disabled', true);
        $('#tstock_min').prop('disabled', true);
        $('#tstock').prop('disabled', true);
    }
    function DesbloquearCajas(){
        $('#tcat').css('pointer-events', 'auto');
        $('.ir_cat').prop('disabled', false);
        $('#tnom_pro').prop('disabled', false);
        $('#tsabor').prop('disabled', false);
        $('#tuni').css('pointer-events', 'auto');
        $('.ir_uni').prop('disabled', false);
        $('#tpre').prop('disabled', false);
        $('#tstock_min').prop('disabled', false);
        $('#tstock').prop('disabled', false);
    }
    function limpiacajas(){
        $('#tcat').val(0);
        $('#tnom_pro').val('');
        $('#tsabor').val('');
        $('#tuni').val(0);
        $('#tpre').val('');
        $('#tstock_min').val('');
        $('#tstock').val('');
    }

    $('#bnuevo_pro').click(function(){
        DesbloquearCajas();
        $('#bguardar_pro').css('display','block');
        $('#bcancelar_pro').css('display','block');
        $('#bnuevo_pro').css('display','none');
    })

    //Cancelar
    $(document).on('click', '#bcancelar_pro', function() {
            limpiacajas();
            BloquearCajas();
            $('#bguardar_pro').css('display','none');
            $('#bcancelar_pro').css('display','none');
            $('#bmodificar_pro').css('display','none');
            $('#bnuevo_pro').css('display','block');
         
    })

    //Agregar producto nuevo
    $(document).on('click', '#bguardar_pro', function() {

        // Obtener los valores de las cajas de texto
        const cat = $('#tcat').val().trim();
        const nom = $('#tnom_pro').val().trim();
        const sabor = $('#tsabor').val().trim();
        const uni = $('#tuni').val().trim();
        const pre = $('#tpre').val().trim();
        const minimo = $('#tstock_min').val().trim();
        const actual= $('#tstock').val().trim();
        
        //Validaciones
        if (cat==0) {
            alert('Seleccione Categoria!');
            $('#tcat').focus();
            return;
        }

        if (nom==="") {
            alert('Ingrese Nombre del Producto!');
            $('#tnom_pro').focus();
            return;
        }

        if (sabor==="") {
            alert('Ingrese sabor del Producto!');
            $('#tsabor').focus();
            return;
        }

        if (uni==0) {
            alert('Seleccione Unidad de Medida!');
            $('#tuni').focus();
            return;
        }

        if (pre==="") {
            alert('Ingrese Precio del Producto!');
            $('#tpre').focus();
            return;
        }

        if (minimo==="") {
            alert('Ingrese Stock Minimo del Producto!');
            $('#tstock_min').focus();
            return;
        }

        if (actual==="") {
            alert('Ingrese Stock Actual del Producto!');
            $('#tstock').focus();
            return;
        }
        
            
        // Crear el objeto de datos para enviar la solicitud
        const datos = {
            cat: cat,
            nom: nom,
            sabor : sabor,
            uni: uni,
            pre: pre,
            minimo: minimo,
            actual: actual,
            opcion: 'agregar'
          };
        
          // Enviar la solicitud AJAX
          $.get('php/controlador_productos.php', datos, function(response) {
            alert(response);
            listar_productos();
            limpiacajas();
            BloquearCajas();
            $('#bguardar_pro').css('display','none');
            $('#bcancelar_pro').css('display','none');
            $('#bnuevo_pro').css('display','block');
          });
    })

    //Seleccionar producto a modificar
    $(document).on('click', '#bmod', function() {
        DesbloquearCajas();
        $('#bmodificar_pro').css('display','block');
        $('#bcancelar_pro').css('display','block');
        $('#bnuevo_pro').css('display','none');

        const cod = $(this).data('cod');

        const datos={
        cod:cod,
        opcion:'buscar'
        };
        $.get('php/controlador_productos.php', datos,function(response){

            var registro=JSON.parse(response);
            $('#tcod').val(registro[0].cod);
            $('#tcat').val(registro[0].cat);
            $('#tnom_pro').val(registro[0].nom);
            $('#tsabor').val(registro[0].sabor);
            $('#tuni').val(registro[0].uni);
            $('#tpre').val(registro[0].pre);
            $('#tstock_min').val(registro[0].minimo);
            $('#tstock').val(registro[0].actual);
        });
      })

    //actualizar Producto
    $(document).on('click', '#bmodificar_pro', function() {
        const cod = $('#tcod').val().trim();
        const cat = $('#tcat').val().trim();
        const nom = $('#tnom_pro').val().trim();
        const sabor = $('#tsabor').val().trim();
        const uni = $('#tuni').val().trim();
        const pre = $('#tpre').val().trim();
        const minimo = $('#tstock_min').val().trim();
        const actual= $('#tstock').val().trim();
        //Validaciones
        //Validaciones
        if (cat==0) {
            alert('Seleccione Categoria!');
            $('#tcat').focus();
            return;
        }

        if (nom==="") {
            alert('Ingrese Nombre del Producto!');
            $('#tnom_pro').focus();
            return;
        }

        if (sabor==="") {
            alert('Ingrese sabor del Producto!');
            $('#tsabor').focus();
            return;
        }

        if (uni==0) {
            alert('Seleccione Unidad de Medida!');
            $('#tuni').focus();
            return;
        }

        if (pre==="") {
            alert('Ingrese Precio del Producto!');
            $('#tpre').focus();
            return;
        }

        if (minimo==="") {
            alert('Ingrese Stock Minimo del Producto!');
            $('#tstock_min').focus();
            return;
        }

        if (actual==="") {
            alert('Ingrese Stock Actual del Producto!');
            $('#tstock').focus();
            return;
        }
        
        // Crear el objeto de datos para enviar la solicitud
        const datos = {
            cod: cod,
            cat: cat,
            nom: nom,
            sabor : sabor,
            uni: uni,
            pre: pre,
            minimo: minimo,
            actual: actual,
            opcion: 'actualizar'
          };
        
          // Enviar la solicitud AJAX
          $.get('php/controlador_productos.php', datos, function(response) {
            alert(response);
            listar_productos();
            limpiacajas();
            BloquearCajas();
            $('#bmodificar_pro').css('display','none');
            $('#bcancelar_pro').css('display','none');
            $('#bnuevo_pro').css('display','block');
          });
    })

     //Abrir modal de agregar categorias
     $(document).on('click', '#ir_cat', function() {
        $('.fondo').css('display','block');
        $('.modal').css('margin-top','-30%');
    })
    //Cerrar modal de agregar categorias
    $(document).on('click', '.cerrar_modal', function() {
        $('.modal').css('margin-top','-90%');
        $('.fondo').css('display','none');
    })

    //Abrir modal de agregar unidades de medidas
    $(document).on('click', '#ir_uni', function() {
        $('.fondo').css('display','block');
        $('.modal_uni').css('margin-top','-30%');
    })
    //Cerrar modal de agregar unidades de medidas
    $(document).on('click', '.cerrar_modal_uni', function() {
        $('.modal_uni').css('margin-top','-90%');
        $('.fondo').css('display','none');
    })

    //Agregar neuva categoria  
    $(document).on('click', '#bguardar_cat', function() {
        const nom=$('#tnom_cat').val().trim();
        //Validar
        if (nom==="") {
            alert("Ingrese Nombre de Categoria");
            $('#tnom_cat').focus();
            return;
        }
        //Crear objeto de datos para enviar la solicitud
        const datos ={
            nom:nom,
            opcion:'agregar'
        };
        //Enviar la solicitud a ajax
        $.get('php/controlador_categorias.php',datos,function(response){
            alert(response);
            $('#tnom_cat').val("");
            $('.modal').css('margin-top','-90%');
            $('.fondo').css('display','none');
            llenar_categorias();
        })
    })

    //Agregar nueva unidad de medida
    $(document).on('click', '#bguardar_uni', function() {
        const nom=$('#tnom_uni').val().trim();
        //Validar
        if (nom==="") {
            alert("Ingrese Nombre de Unidad de Medida");
            $('#tnom_uni').focus();
            return;
        }
        //Crear objeto de datos para enviar la solicitud
        const datos ={
            nom:nom,
            opcion:'agregar'
        };
        //Enviar la solicitud a ajax
        $.get('php/controlador_unidades.php',datos,function(response){
            alert(response);
            $('#tnom_uni').val("");
            $('.modal_uni').css('margin-top','-90%');
            $('.fondo').css('display','none');
            llenar_unidades();
        })
    })

    // ---------------------------------------------------------------- CODIGO PARA VALIDAR MAYUSCULAS
    $('.cajas-pro').on('input', function() {
        let currentValue = $(this).val();
        let newValue = currentValue.replace(/[^a-zA-Z0-9\sÑñ]/g, '');
        $(this).val(newValue.toUpperCase());
    });


})