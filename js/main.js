let icono=document.getElementById("icono");
let clave=document.getElementById("clave");
let slash=document.getElementById("slash");
let con=true;
icono.addEventListener("click", function(){
    if (con==true) {
        clave.type="text"
        slash.style.display="none";
        con=false
    } else {
        clave.type="password"
        slash.style.display="block";
        con=true
    }
})

function soloNumeros(e){
    var key = window.Event ? e.which : e.keyCode
    return (key >= 48 && key <= 57)
}
