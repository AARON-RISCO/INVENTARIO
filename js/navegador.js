$(document).ready(function(){
    $(document).off("click","**");
    $('#continuar').click(function(){
        $('#opacar').css("display","none");
        $('#caja').css("margin-top","-100%");
    });
    $('.cerrar').click(function(){
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
        $('.fil').css("background-color","white");
    });
    $('#mostrar_menu').click(function(){
        $('#nav').css("margin-left","0%");
        $('#opacar2').css("display","block");
        $('.fil').css("background-color","transparent");
    });
    $('#mpro').click(function(){
        $('.contenedor').load("productos.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });
    $('#mcat').click(function(){
        $('.contenedor').load("categorias.php");
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
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
<<<<<<< HEAD
    $('#mreve').click(function(){
        $('.contenedor').load("reporte_ventas.php");
=======
    $('#mpromo').click(function(){
        $('.contenedor').load("promociones.php");
>>>>>>> 4852380798a5ce244fcf18d1f4f0a90bb2dfacd2
        $('#nav').css("margin-left","-90%");
        $('#opacar2').css("display","none");
    });
    // $('#mhome').click(function(){
    //     $('body').load("home.php");
    //     $('#nav').css("margin-left","-90%");
    //     $('#opacar2').css("display","none");
    // });
});