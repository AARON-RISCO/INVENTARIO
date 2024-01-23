<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];

// Listar deudores
if ($opcion == "listar") {
    $nombre = $_GET['nom'];
    $apellido = $_GET['ape'];

    $con_listar = "SELECT t1.id_deudor, t1.nom_deudor, t1.apellidos_deudor, t1.estado, ROUND(SUM(t2.deuda), 2) as total
    FROM deudores t1
    JOIN venta t2 ON t2.id_deudor = t1.id_deudor 
    WHERE t1.estado = 0 AND t2.deuda > 0";

    if ($nombre != '') {
        // Búsqueda solo por nombre
        $con_listar .= " AND t1.nom_deudor LIKE '" . $nombre . "%'";
    } elseif ($apellido != '') {
        // Búsqueda solo por apellido
        $con_listar .= " AND t1.apellidos_deudor LIKE '" . $apellido . "%'";
    }

    // Agrega GROUP BY al final de la consulta
    $con_listar .= " GROUP BY t1.id_deudor, t1.nom_deudor, t1.apellidos_deudor, t1.estado";

    $res = mysqli_query($cnn, $con_listar);
    $num = mysqli_num_rows($res);
    if ($num >= 1) {
        while ($f = mysqli_fetch_array($res)) {
            $json[] = array(
                "cod" => $f['id_deudor'],
                "nom" => $f['nom_deudor'],
                "ape" => $f['apellidos_deudor'],
                "deu" => $f['total']
            );
        }
        $jsonresponse = json_encode($json, JSON_UNESCAPED_UNICODE);
    } else {
        $jsonresponse = "vacio";
    }
    echo $jsonresponse;
}
// Listar ventas
if ($opcion == "listar_ventas") {
    $cod = $_GET['cod'];
    $con_listar = "SELECT t1.id_venta,t1.fecha_venta, CONCAT(t2.nom_per,' ',t2.ape_per) as personal,t1.deuda 
	FROM venta t1, personal t2
	WHERE t1.dni_per=t2.dni_per AND id_deudor=$cod";

    $res = mysqli_query($cnn, $con_listar);
    $num = mysqli_num_rows($res);
    if ($num >= 1) {
        while ($f = mysqli_fetch_array($res)) {
            $json[] = array(
                "cod" => $f['id_venta'],
                "fecha" => $f['fecha_venta'],
                "ven" => $f['personal'],
                "deu" => $f['deuda']
            );
        }
        $jsonresponse = json_encode($json, JSON_UNESCAPED_UNICODE);
    } else {
        $jsonresponse = "vacio";
    }
    echo $jsonresponse;
}

// Listar ventas
if ($opcion == "buscar_deuda") {
    $cod = $_GET['cod'];
    $con_listar = "SELECT deuda FROM venta WHERE id_venta=$cod";

    $res = mysqli_query($cnn, $con_listar);
    $num = mysqli_num_rows($res);
    if ($num >= 1) {
        while ($f = mysqli_fetch_array($res)) {
            $json[] = array(
                "deu" => $f['deuda']
            );
        }
        $jsonresponse = json_encode($json, JSON_UNESCAPED_UNICODE);
    } else {
        $jsonresponse = "vacio";
    }
    echo $jsonresponse;
}

// Pagar
if ($opcion == "pagar") {
    $cod = $_GET['cod'];
    $pago = $_GET['pago'];
    $pagar="UPDATE venta SET deuda= deuda - $pago  WHERE id_venta='$cod'";
    mysqli_query($cnn,$pagar)or die("Error en Pagar");
    echo "Pagado Correctamente";

    // Verificar si la deuda es ahora igual a 0 y actualizar el estado
    $verificar_deuda = "SELECT deuda FROM venta WHERE id_venta = '$cod'";
    $resultado = mysqli_query($cnn, $verificar_deuda) or die("Error al verificar deuda");

    $fila = mysqli_fetch_assoc($resultado);
    $deuda_actualizada = $fila['deuda'];

    if ($deuda_actualizada == 0) {
        // La deuda es igual o menor que 0, actualizar el estado a 1
        $actualizar_estado = "UPDATE venta SET estado = 1, id_deudor = 1  WHERE id_venta = '$cod'";
        mysqli_query($cnn, $actualizar_estado) or die("Error al actualizar estado");
    }
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