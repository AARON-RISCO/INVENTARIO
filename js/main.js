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

// let icono2=document.getElementById("icono2");
// let clave2=document.getElementById("tclave");
// let slash2=document.getElementById("slash2");
// let con2=true;
// icono2.addEventListener("click", function(){
//     if (con2==true) {
//         clave2.type="text"
//         slash2.style.display="none";
//         con2=false
//     } else {
//         clave2.type="password"
//         slash2.style.display="block";
//         con2=true
//     }
// })

function soloNumeros(e){
    var key = window.Event ? e.which : e.keyCode
    return (key >= 48 && key <= 57)
}
