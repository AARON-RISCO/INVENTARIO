$(document).ready(function(){
    listar_ventas(0);
    function listar_ventas(est="",name,fe1,tp){
        
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vventas.php",
            data:{esta:est,name:name,fe1:fe1,tp:tp,opcion:"listar"},
            success:function(response){
                // console.log(response);-
                response = response.trim();
                if(response=='vacio'){
                    $('#cuerpo_tabla_vventas').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){
                        
                        var est=registro[z].estd;
                        var el=""; var ac="";
                        var nomest;

                        if(est==1){ el="green"; ac="block"; nomest="PAGADO"}
                        if(est==2){ el="red";  ac="block"; nomest="PENDIENTE"}

                        template+=
                        '<tr><td>'+registro[z].cod+
                        '</td><td>'+registro[z].nomc+
                        '</td><td>'+registro[z].fec+
                        '</td><td>'+registro[z].nomp+
                        '</td><td>'+registro[z].tpve+
                        '</td><td style="color:'+el+';">'+nomest+
                        '</td><td id="icon" style="display:flex; justify-content: center; gap: 10px"><img src="img/pago.png" width="30" id="bmodv" class="color" style="display:none;" data-cod="'+registro[z].cod+'"><img src="img/verv.svg" style="display:'+ac+';" width="30" id="bir" class="color" data-cod="'+registro[z].cod+'"></td></tr>';
                    }
                    $('#cuerpo_tabla_vventas').html(template);

                }



            }
        })

    }

    // codigo para filtrar por estado de venta
    $(document).on('input','#tdesav',function(){
        $('#bus_nom').val('');
        var valor=$(this).val();
        listar_ventas(valor);
    })

    //codigo para ver el tipo de filtro que desea hacer :v 
    $(document).on('change','#ttfil',function(){
        var valor=$(this).val();
        // console.log(valor);
        if(valor==1){
            $(".uni").css("display","none");
            $(".uni3").css("display","none");
            $(".uni2").css("display","block"); 
            $('#bus_nom').val('');
            $('#bus_fec').val(''); 
            $('#bus_fec2').val('');
            $('#tdesav').val(0);  
            
        }
        if(valor==2){
            $(".uni2").css("display","none");
            $(".uni3").css("display","none");
            $('#bus_nom').val('');
            $(".uni").css("display","block");   
            $('#tdesav').val(0);  
            
        }
        if(valor==3){
            $(".uni2").css("display","none");
            $(".uni").css("display","none");
            $(".uni3").css("display","flex");
            
            $(".uni3").css("justify-content","center");
            $(".uni3").css("align-items","start");
            $(".uni3").css("gap","15px");
            $('#bus_nom').val('');
            $('#tdesav').val(0);  
            
        }
        listar_ventas(0);
    })

    // codigo para filtrar por tipo de pago

        $(document).on('click','#bototp',function(){
            $('#tdesav').val(0); 
            let valor = $(this).data('cod');
            listar_ventas('','','',valor);
        })

        $(document).on('click','#bototp2',function(){
            $('#tdesav').val(0); 
            let valor = $(this).data('cod');
            // console.log(valor)
            listar_ventas(0,'','',valor);
        })

    // codigo para filtrar por nombre
    $(document).on('keyup','#bus_nom',function(){
        var valor=$(this).val();
        listar_ventas($("#tdesav").val(),valor)
    })

    // codigo para manejar la validacion de fechas
    $(document).on('change', '#bus_fec, #bus_fec2', function() {
        var fechai = $('#bus_fec').val();
        var fechaf = $('#bus_fec2').val();
    
        if (fechaf.length > 0 && fechai.length > 0 && fechai <= fechaf) {
            listar_ventas('',fechai,fechaf);
            // console.log(fechai+" ---"+fechaf);
        } else {
            listar_ventas(0);
            $('#bus_fec2').val('');
        }
    });

    // codigo para el manejo de ver detalle de venta

    $(document).on('click','#bir',function(){
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
                    $('#ttdv').val("S/. "+registro[0].neto)
                    var template='';
                    for(z in registro){
                        
                        var est=registro[z].icev;
                        // var el=""; var ac="";
                        var nomest;

                        if(est==0){  nomest="NO"}
                        if(est>0){  nomest="SI"}
                        if(registro[z].deud>0){$('#ttes').val(" VENTA PENDIENTE"); $('#ttes').css("color","red");}
                        if(registro[z].deud==0){$('#ttes').val(" VENTA FINALIZADA"); $('#ttes').css("color","green");}
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

    // codigo para el pago de la deuda pendiente
    $(document).on('click','#bmodv',function(){
        // alert("funciona pagar ");
        $('#sombra_modal_vventas').css("display","block");
        $('#caja_modal_vventas').css("margin-top","-25%");
        $('#bacvv').css("display","block");
        
        $('#ttes').css("color","red");
        const codi = $(this).data('cod');
        // console.log(codi)
        $(".iddv").html( "DETALLE DE LA VENTA N°: "+codi);
        $("#teve").val(codi);
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
                    $('#tnee').val(registro[0].neto);
                    $('#ttdv').val("S/. "+registro[0].neto);
                    $('#tdeu').val(registro[0].deud);
                    $('#ttes').val(" DEUDA PENDIENTE DE: S/. "+registro[0].deud+"");
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
        
    });

    // boton para cerrar la ventana modal de ver ventas
    $(document).on('click','#bcavv',function(){
        $('#sombra_modal_vventas').css("display","none");
        $('#caja_modal_vventas').css("margin-top","-90%");
        
    });

    $(document).on('click','#bacvv',function(){

        let de = $("#tdeu").val();
        let pago;
        do {
            pago = prompt("PAGAR", de);
            if (pago === null) {
                alert("PAGO NO REALIZADO");
                return;
            }
            if (pago <= 0 || pago > de) {
                alert("LA CANTIDAD QUE INGRESASTE NO ES VALIDA");
            }
        } while (pago <= 0 || pago > de);
        let codv=$("#teve").val();
        let defi=de-pago;
        // console.log(defi);
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vventas.php",
            data:{
                cod:codv,
                defi:defi,
                pago:pago,
                opcion:"pagar_deuda"
            },
            success:function(response){
                alert(response);
                listar_ventas($("#tdesav").val());
                $('#sombra_modal_vventas').css("display","none");
                $('#caja_modal_vventas').css("margin-top","-90%");

            }
        })
       
        
    });
})