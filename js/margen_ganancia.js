$(document).ready(function(){
    listar_pro();
    function listar_pro(nombre,f1,f2,f3){
        // console.log(nombre);
        // console.log(f1);
        // console.log(f2);
        if(f3==""){
            f3=undefined;
        }
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_mganancia.php",
            data:{
                nombre:nombre,
                f1:f1,
                f2:f2,
                f3:f3,
                opcion:"listar"
            },
            success:function(response){
                // console.log(response);
                response = response.trim();
                if(response=='vacio'){
                    $('#cuerpo_tabla_rema').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){
                        
                        let mar = registro[z].prep - registro[z].prec;
                        let net= registro[z].prep * registro[z].stop;
                        // if(est==1){  nomest="PAGADO"; clien=registro[z].nomc}
                        // if(est==2){  nomest="PENDIENTE"; clien=registro[z].nomd}

                        template+=
                        '<tr><td>'+registro[z].idp+
                        '</td><td>'+registro[z].nomp+
                        '</td><td>S/. '+registro[z].prep+
                        '</td><td>'+registro[z].stop+
                        '</td><td>S/. '+registro[z].prec+
                        '</td><td> S/. '+mar.toFixed(1)+
                        '</td><td>S/. '+net.toFixed(1)+
                        '</td></tr>';
                    }
                    $('#cuerpo_tabla_rema').html(template);

                }
            }
        })
    }
    llenar_categorias();
    function llenar_categorias(){
        $.ajax({
            async:true,
            type: "GET",
            data:{opcion:'listar_categorias'},
            url: "php/controlador_categorias.php",
            success: function(response){
                $('#tcatpro').html(response);
                // $('#tcategoria').html(response);
            }
        });
    }


    // titulo de reportes
    $(document).on('input','#titrpv',function(){
        let valor=$(this).val();
        $('#vtit_rpv').html(''+valor+'');
        if(valor===""){
            $('#titrpv').css('border','1px solid red');
        }else{
            $('#titrpv').css('border','1px solid green');   
        }
    })

    //filtro por nombre de productos

    $(document).on('input','#fnomp',function(){
        let  val=$(this).val();
        if(val==""){
            listar_pro('',$('#est_pago').val(),$('#tcatpro').val(),$('#testado').val());
        }else{
            listar_pro(val,$('#est_pago').val(),$('#tcatpro').val(),$('#testado').val());
        }
        
    });

    // filtro pro stock 
    $(document).on('input','#est_pago',function(){
        let  val=$(this).val();
        if(val==""){
            listar_pro($('#fnomp').val(),'',$('#tcatpro').val(),$('#testado').val());
        }else{
            listar_pro($('#fnomp').val(),val,$('#tcatpro').val(),$('#testado').val());
        }
        
    });

    // filtro por categoria
    $(document).on('input','#tcatpro',function(){
        let  val=$(this).val();
        if(val==""){
            listar_pro($('#fnomp').val(),$('#est_pago').val(),'',$('#testado').val());
        }else{
            listar_pro($('#fnomp').val(),$('#est_pago').val(),val,$('#testado').val());
        }
        
    });

    // filtro por estado de producto
    $(document).on('input','#testado',function(){
        let  val=$(this).val();
        if(val===""){
            listar_pro($('#fnomp').val(),$('#est_pago').val(),$('#tcatpro').val(),'');
        }else{
            listar_pro($('#fnomp').val(),$('#est_pago').val(),$('#tcatpro').val(),val);
        }
        
    });

    // mayusculas
    $('.MAYR').on('input', function() {
        let currentValue = $(this).val();
        // Ahora la expresión regular permite letras, números, espacios, puntos y comas
        let newValue = currentValue.replace(/[^a-zA-Z0-9\sÑñ.,-]/g, '');
        $(this).val(newValue.toUpperCase());
    });
    // boton de cancelar venta
    $(document).on('click','#bcancelar_ven',function(){
        $('#fnomp').val('');
        $('#est_pago').prop('selectedIndex', 0);
        $('#testado').prop('selectedIndex', 0);
        $('#tcatpro').prop('selectedIndex', 0);
        listar_pro();
        $('#vtit_rpv').html('');
        $('#titrpv').val('');
    })

    //--------------------------------------imprimir reporte
    $(document).on('click','#bimprimirv',function(){    
        if($('#titrpv').val()==""){
            alert("POR FAVOR AGREGA TITULO A TU REPORTE");
                return;
        }

        $('#contenido_reporte_venta').css('overflow','hidden');
        $('#contenido_reporte_venta').height('auto');
        $('#contenido_reporte_venta').width('100vh');
        $("#contenido_reporte_venta").print();
        $('#contenido_reporte_venta').width('100%');
        // $('#conteiner').height('65vh');
        $('#conteiner').css('overflow','auto'); 
        $('#fnomp').val('');
        $('#est_pago').prop('selectedIndex', 0);
        $('#testado').prop('selectedIndex', 0);
        $('#tcatpro').prop('selectedIndex', 0);
        listar_pro();
        $('#vtit_rpv').html('');
        $('#titrpv').val('');
        
    })

});