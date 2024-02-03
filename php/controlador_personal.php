<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];

//Listar categorias
if($opcion=="listar"){
        $con_listar="SELECT* FROM personal"; 
    
            if(isset($_GET['dni'])){
                $dni=$_GET['dni'];
                $con_listar="SELECT * FROM personal
                WHERE dni_per LIKE CONCAT('$dni','%')";
            }
            
            
        $res=mysqli_query($cnn,$con_listar);
        $num=mysqli_num_rows($res);
        if($num>=1){
            while($f=mysqli_fetch_array($res)){
                $json[]=array(
                    "dni"=>$f['dni_per'],
                    "per"=>$f['nom_per'].' '.$f['ape_per'],
                    "car"=>$f['tipo_per'],
                    "estado"=>$f['estado_per'],
                    "clave"=>$f['clave_per']
                );}
            $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
        }else{
            $jsonresponse="vacio";
        }
        echo $jsonresponse;
}
// //agregar nuevo categoria
// if($opcion=="agregar"){
//         $nom=$_GET['nom'];
//         $agregar="insert into categoria
//         values(' ', '$nom',' ')";
//         mysqli_query($cnn,$agregar)or die("Error en registrar categoria");
//         echo "Categoria registrada correctamente";
// }
    
//buscar categoria a modificar
if($opcion=="buscar"){
    $cod=$_GET['cod'];
    $buscar="SELECT* FROM personal WHERE dni_per='$cod'";
    $res=mysqli_query($cnn,$buscar);
    $num=mysqli_num_rows($res);
    while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "dni"=>$f['dni_per'],
                "ape"=>$f['ape_per'],
                "nom"=>$f['nom_per'],
                "estado"=>$f['estado_per'],
                "car"=>$f['tipo_per'],
                "cla"=>$f['clave_per']
            );}
    $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    echo $jsonresponse;
}
    
    
//     //Actualizar categoria
//     if($opcion=="actualizar"){
//         $cod=$_GET['cod'];
//         $nom=$_GET['nom'];
//         $modificar="update categoria set nom_cat='$nom' where id_cat='$cod'";
//         mysqli_query($cnn,$modificar)or die("Error en modificar categoria");
//         echo "Categoria Actualizado";
//     }
    if($opcion=="deshabilitar"){
        $code=$_GET['code'];
        $esta=$_GET['esta'];
        if($esta=="ACTIVO"){
            $modificarc="UPDATE personal set estado_per='INACTIVO' where dni_per='$code'";
            $msj="PERSONAL DESACTIVADO CORRECTAMENTE";
        }elseif($esta=="INACTIVO"){
            $modificarc="UPDATE personal set estado_per='ACTIVO' where dni_per='$code'";
            $msj="PERSONAL ACTIVADO CORRECTAMENTE";
        }

        mysqli_query($cnn,$modificarc)or die("ERROR EN ACTUALIZAR ESTADO");
    }

?>