<?php
include("../conexion/conexion.php");
$opcion=$_GET['opcion'];
if($opcion=="listar"){
    $est=$_GET['esta'];
        $con_listar_v="SELECT t1.*,t2.ape_cli,t2.nom_cli,t3.ape_per,t3.nom_per, t4.nom_deudor,t4.apellidos_deudor
                   FROM venta as t1 , cliente as t2, personal as t3, deudores as t4
                   WHERE t1.estado=? and t2.dni_cli=t1.dni_cli and t3.dni_per=t1.dni_per and t4.id_deudor=t1.id_deudor";

        // Utilizar parámetros preparados para evitar inyección de SQL
        $stmt = mysqli_prepare($cnn, $con_listar_v);
        mysqli_stmt_bind_param($stmt, 'i' ,$est);
        mysqli_stmt_execute($stmt);


    
    $res = mysqli_stmt_get_result($stmt);
    $num = mysqli_num_rows($res);
    

    
    if ($num >= 1) {
        while ($f = mysqli_fetch_array($res)) {
            $json[] = array(
                "cod" => $f['id_venta'],
                "fec" => $f['fecha_venta'],
                "dnic" => $f['dni_cli'],
                "dnip" => $f['dni_per'],
                "estd" => $f['estado'],
                "idde" => $f['id_deudor'],
                "neto" => $f['neto'],
                "nomc" => $f['nom_cli']." ".$f['ape_cli'],
                "nomp" => $f['nom_per']." ".$f['ape_per'],
                "nomd" => $f['nom_deudor']." ".$f['apellidos_deudor'],
            );
        }
        $jsonresponse = json_encode($json, JSON_UNESCAPED_UNICODE);
    } else {
        $jsonresponse = "vacio";
    }
    echo $jsonresponse;

}

?>