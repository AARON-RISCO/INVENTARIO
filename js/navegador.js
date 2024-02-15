$(document).ready(function(){
    $(document).off("click","**");
    caja();
    function caja(){
        $.ajax({
            asyn:true,
            type:"GET",
            url:"php/controlador_vcaja.php",
            data:{
                opcion:"llenar_apertura" 
            },success:function(response){
                let respuesta=response.trim();
                // console.log(respuesta);
                if(respuesta=="aparecer"){
                    $('#opacar').css("display","flex");
                    $('#caja').css("margin-top","0");
                }else if(respuesta=="ocultar"){
                    $('#opacar').css("display","none");
                    $('#caja').css("margin-top","-100%");
                    $('.hijos').css('z-index','1');
                };
            }
        });
    }
    $(document).on('click','#continuar',function(){
        let per=$('#id_pero').val();
        let monto=$('#tinicio').val();
        if(monto==""){
            alert("INGRESA MONTO DE APERTURA");
            return;
        }
        
        $.ajax({
            asyn:true,
            type:"GET",
            url:"php/controlador_vcaja.php",
            data:{
                per:per,
                monto:monto,
                opcion:"apertura_caja" 
            },success:function(response){
                // console.log(response);
                $('#opacar').css("display","none");
                $('#caja').css("margin-top","-100%");
                $('.hijos').css('z-index','1');
                
            }
        })
        
    });
    $('.cerrar').click(function(){
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
        $('.fil').css("background-color","white");
        $('.bus_promo').css('z-index','1');
$('.hijos').css('z-index','1');
    });
    $('#mostrar_menu').click(function(){
        $('#nav').css("margin-left","0%");
        $('#opacar2').css("display","block");
        $('.fil').css("background-color","transparent");
        $('.bus_promo').css('z-index','-1');
$('.hijos').css('z-index','-1');
    });
    $('#mpro').click(function(){
        $('.contenedor').load("productos.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });
    $('#mpro2').click(function(){
        $('.contenedor').load("productos.php");
        });
    $('#mven2').click(function(){
        $('.contenedor').load("ver_ventas.php");
        });
    $('#mcom2').click(function(){
        $('.contenedor').load("ver_compras.php");
    });
    $('#mdeu2').click(function(){
        $('.contenedor').load("deudores.php");
    });
    $('#mper2').click(function(){
        $('.contenedor').load("personal.php");
    });
    $('#minfo').click(function(){
        $('#overlay').css("display","block");
    });
    $('.close-btn').click(function(){
        $('#overlay').css("display","none");
    });
    $('#muni').click(function(){
        $('.contenedor').load("unidades_medida.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });
    $('#mrven').click(function(){
        $('.contenedor').load("registrar_ventas.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });
    $('#mvven').click(function(){
        $('.contenedor').load("ver_ventas.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });
    $('#mrcom').click(function(){
        $('.contenedor').load("registrar_compras.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });
    $('#mvcom').click(function(){
        $('.contenedor').load("ver_compras.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });
    $('#mdeu').click(function(){
        $('.contenedor').load("deudores.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });
    
    $('#mreve').click(function(){
        $('.contenedor').load("reporte_ventas.php");  
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");  
    })
    $('#mreco').click(function(){
        $('.contenedor').load("reporte_compras.php");  
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");  
    })

    $('#mpromo').click(function(){
        $('.contenedor').load("promociones.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });

    $('#musu').click(function(){
        $('.contenedor').load("personal.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });

    $('#marga').click(function(){
        $('.contenedor').load("margen_ganancia.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });

    $('#mvcaja').click(function(){
        $('.contenedor').load("vcaja.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });
    $('#mhome').click(function(){
    $('.contenedor').load("inicio.php");
    $('#nav').css("margin-left","-90%");
    $('#opacar2').css("display","none");
    $('.hijos').css('z-index','1');
    });
});