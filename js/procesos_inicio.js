$(document).ready(function(){
$(document).off("click","**");
contar();
function contar(){
    const datos={
        opcion:'contarPro'
    }
    $.get('php/controlador_inicio.php',datos,function(response){
        let registro = JSON.parse(response);
        $('#pro').html(registro[0].tot_pro);  
    })
    const datos2={
        opcion:'contarVen'
    }
    $.get('php/controlador_inicio.php',datos2,function(response){
        let registro = JSON.parse(response);
        $('#ven').html(registro[0].tot_ven);  
    })
    const datos3={
        opcion:'contarCom'
    }
    $.get('php/controlador_inicio.php',datos3,function(response){
        let registro = JSON.parse(response);
        $('#com').html(registro[0].tot_com);  
    })
    const datos4={
        opcion:'contarDeu'
    }
    $.get('php/controlador_inicio.php',datos4,function(response){
        let registro = JSON.parse(response);
        $('#deu').html(registro[0].tot_deu);  
    })
    const datos5={
        opcion:'contarPer'
    }
    $.get('php/controlador_inicio.php',datos5,function(response){
        let registro = JSON.parse(response);
        $('#per').html(registro[0].tot_per);  
    })
}


})