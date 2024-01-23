<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];

//Listar categorias
if ($opcion == "listar") {
    $nombre=$_GET['nom'];
    $apellido=$_GET['ape'];
    $con_listar = "SELECT * FROM deudores WHERE estado = 0";

    if ($nombre != '') {
        // Búsqueda solo por nombre
        $con_listar .= " AND nom_deudor LIKE CONCAT('$nombre','%')";
    } elseif ($apellido != '') {
        // Búsqueda solo por apellido
        $con_listar .= " AND apellidos_deudor LIKE CONCAT('$apellido','%')";
    }

    $res = mysqli_query($cnn, $con_listar);
    $num = mysqli_num_rows($res);
    if ($num >= 1) {
        while ($f = mysqli_fetch_array($res)) {
            $json[] = array(
                "cod" => $f['id_deudor'],
                "nom" => $f['nom_deudor'],
                "ape" => $f['apellidos_deudor']
            );
        }
        $jsonresponse = json_encode($json, JSON_UNESCAPED_UNICODE);
    } else {
        $jsonresponse = "vacio";
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
    
// //buscar categoria a modificar
// if($opcion=="buscar"){
//     $cod=$_GET['cod'];
//     $buscar="SELECT* FROM categoria WHERE id_cat='$cod'";
//     $res=mysqli_query($cnn,$buscar);
//     $num=mysqli_num_rows($res);
//     while($f=mysqli_fetch_array($res)){
//             $json[]=array(
//                 "cod"=>$f['id_cat'],
//                 "nom"=>$f['nom_cat'],
//                 "esc"=>$f['estado']
//             );}
//     $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
//     echo $jsonresponse;
// }
    
    
//     //Actualizar categoria
//     if($opcion=="actualizar"){
//         $cod=$_GET['cod'];
//         $nom=$_GET['nom'];
//         $modificar="update categoria set nom_cat='$nom' where id_cat='$cod'";
//         mysqli_query($cnn,$modificar)or die("Error en modificar categoria");
//         echo "Categoria Actualizado";
//     }
//     if($opcion=="deshabilitar"){
//         $code=$_GET['code'];
//         $esta=$_GET['esta'];
//         if($esta==1){
//             $modificarc="update categoria set estado=0 where id_cat='$code'";
//             $msj="CATEGORIA HABILITADA CORRECTAMENTE";
//         }elseif($esta==0){
//             $modificarc="update categoria set estado=1 where id_cat='$code'";
//             $msj="CATEGORIA DESHABILITADA CORRECTAMENTE";
//         }

//         mysqli_query($cnn,$modificarc)or die("Error en modificar categoria");
//         echo $msj;
//     }

?>