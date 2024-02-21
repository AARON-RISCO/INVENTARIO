<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];

// obtener fecha actual y obetener el id de la caja de hoy
date_default_timezone_set('America/Lima');
$fecha_actual = date('Y-m-d');

$sacaridca="SELECT id_caja as cajita FROM caja WHERE fecha_caja='$fecha_actual'";
$ressacar=mysqli_query($cnn,$sacaridca);
$idcajahoy=mysqli_fetch_assoc($ressacar)['cajita'];

// Listar deudores
if ($opcion == "listar") {
    $nombre = $_GET['nom'];
    $apellido = $_GET['ape'];

    $con_listar = "SELECT t1.id_deudor, t1.nom_deudor, t1.apellidos_deudor, t1.estado, ROUND(SUM(IFNULL(t2.deuda, 0)), 2) AS total
    FROM deudores t1
    LEFT JOIN venta t2 ON t2.id_deudor = t1.id_deudor
    WHERE t1.estado = 0";

    if ($nombre != '') {
        // Búsqueda solo por nombre
        $con_listar .= " AND t1.nom_deudor LIKE '" . $nombre . "%'";
    } elseif ($apellido != '') {
        // Búsqueda solo por apellido
        $con_listar .= " AND t1.apellidos_deudor LIKE '" . $apellido . "%'";
    }

    // Agrega GROUP BY justo antes de la finalización de la consulta
    $con_listar .= " GROUP BY t1.id_deudor, t1.nom_deudor, t1.apellidos_deudor, t1.estado";

    // Ordenar por total en orden descendente
    $con_listar .= " ORDER BY total DESC";

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

    $dniu=$_GET['dniu'];
    $nomd=$_GET['nomd'];
    $moti="PAGO DE ".$nomd;
    // insertar pago en detalle caja
    $con_cp="INSERT INTO detalle_caja VALUES($idcajahoy,'','$dniu','$moti',$pago,'PAGO DEUDA')";
    mysqli_query($cnn, $con_cp);
    // Verificar si la deuda es ahora igual a 0 y actualizar el estado
    $verificar_deuda = "SELECT deuda FROM venta WHERE id_venta = '$cod'";
    $resultado = mysqli_query($cnn, $verificar_deuda) or die("Error al verificar deuda");

    $fila = mysqli_fetch_assoc($resultado);
    $deuda_actualizada = $fila['deuda'];

    if ($deuda_actualizada == 0) {
        // La deuda es igual o menor que 0, actualizar el estado a 1
        $actualizar_estado = "UPDATE venta SET estado = 1, id_deudor = 1, tipo_pago = 'EFECTIVO'  WHERE id_venta = '$cod'";
        mysqli_query($cnn, $actualizar_estado) or die("Error al actualizar estado");
    }
}

if ($opcion=="eliminar") {
    $cod=$_GET['cod'];
    $eliminar="DELETE FROM deudores WHERE id_deudor=$cod";
    mysqli_query($cnn,$eliminar)or die("ERROR EN ELIMINAR DEUDOR");
    echo("DEUDOR ELIMINADO CORRECTAMENTE");
}

if($opcion=="agregar_deu"){
    $nom=$_GET['nom'];
    $ape=$_GET['ape'];
    $agregar="insert into deudores
    values(' ', '$nom','$ape',' ')";
    mysqli_query($cnn,$agregar)or die("ERROR DEUDOR");
    echo "REGISTRADO CORRECTAMENTE";
}


?>