$(document).ready(function(){
    listar_compras();
    function listar_compras(name,fe1){
        
        $.ajax({
            async:true,
            type:"GET",
            url:"php/controlador_vcompras.php",
            data:{name:name,fe1:fe1,opcion:"listar"},
            success:function(response){
                console.log(response);
                if(response=='vacio'){
                    $('#cuerpo_tabla_vcompras').html('');
                }else{
                    var registro=JSON.parse(response);
                    var template='';
                    for(z in registro){
                        

                        template+=
                        '<tr><td>'+registro[z].codc+
                        '</td><td>'+registro[z].nomp+
                        '</td><td>'+registro[z].fecc+
                        '</td><td>S/. '+registro[z].totc+
                        '</td><td id="icon" style="display:flex; justify-content: center; gap: 10px"><img src="img/verv.svg"  width="30" id="bir" class="color" data-cod="'+registro[z].codc+'"></td></tr>';
                    }
                    $('#cuerpo_tabla_vcompras').html(template);

                }



            }
        })

    }

 // codigo para el manejo de ver detalle de la Compra

 $(document).on('click','#bir',function(){
    $('#sombra_modal_vcompras').css("display","block");
    $('#caja_modal_vcompras').css("margin-top","-25%");
    $('#bacvv').css("display","none");
   
    const codi = $(this).data('cod');
    // console.log(codi)
    $(".iddv").html( "DETALLE DE LA COMPRA N°: "+codi);
    $("#tcodc").val(codi);
    $.ajax({
        async:true,
        type:"GET",
        url:"php/controlador_vcompras.php",
        data:{
            cod:codi,
            opcion:"listar_detalle"
        },
        success:function(respon){
            if(respon=='vacio'){
                $('#cuerpo_tabla_vdcompra').html('');
            }else{
                var registro=JSON.parse(respon);
               
                var template='';
                var g=0;
                var tot=0;
                for(z in registro){
                    g+=1;
                    tot+=parseFloat(registro[z].totco);
                    template+=
                    '<tr><td>'+g+
                    '</td><td>'+registro[z].nompr+
                    '</td><td>'+registro[z].canti+
                    '</td><td>S/. '+registro[z].preco+
                    '</td><td>S/. '+registro[z].totco+
                    '</td></tr>';
                }
                 $('#ttdv').val("S/. "+tot);
                $('#cuerpo_tabla_vdcompra').html(template);

            }
        }
    });
    // alert("funciona ver ");
});

// codigo para cerrar detalle de compra
$(document).on('click','#bcavv',function(){
    $('#sombra_modal_vcompras').css("display","none");
    $('#caja_modal_vcompras').css("margin-top","-90%");
    
});

 //codigo para ver el tipo de filtro que desea hacer :v 
 $(document).on('change','#ttfil',function(){
    var valor=$(this).val();
    console.log(valor);
    if(valor==1){
        $(".uni").css("display","none");
        $(".uni2").css("display","block"); 
        $('#bus_fec').val(''); 
        $('#bus_fec2').val('');
        // $('#tdesav').val(0);
        
    }
    if(valor==2){
        $(".uni2").css("display","none");
        $('#bus_nom').val('');
        $(".uni").css("display","block");
        // $('#tdesav').val(0);  
        
    }
    listar_compras('');
})


// codigo para buscar por nombre de personal
$(document).on('keyup','#bus_nom',function(){
    var valor=$(this).val();
    listar_compras(valor);
})


 // codigo para manejar la validacion de fechas
 $(document).on('change', '#bus_fec, #bus_fec2', function() {
    var fechai = $('#bus_fec').val();
    var fechaf = $('#bus_fec2').val();

    if (fechaf.length > 0 && fechai.length > 0 && fechai <= fechaf) {
        listar_compras(fechai,fechaf);
        // console.log(fechai+" ---"+fechaf);
    } else {
        listar_compras('');
        $('#bus_fec2').val('');
    }
});



})