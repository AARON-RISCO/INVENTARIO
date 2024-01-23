<?php
include("../conexion/conexion.php");
$opcion=$_GET['opcion'];
if($opcion=="listar"){
    $est=$_GET['esta'];
    if($_GET['esta']==3){
        $con_listar_v="SELECT t1.*,t2.ape_cli,t2.nom_cli,t3.ape_per,t3.nom_per, t4.nom_deudor,t4.apellidos_deudor
                   FROM venta as t1 , cliente as t2, personal as t3, deudores as t4
                   WHERE  t2.dni_cli=t1.dni_cli and t3.dni_per=t1.dni_per and t4.id_deudor=t1.id_deudor ORDER BY id_venta ASC";
        $res=mysqli_query($cnn,$con_listar_v);
        
        
    }else if($_GET['esta']==1 || $_GET['esta']==2){
        $con_listar_v="SELECT t1.*,t2.ape_cli,t2.nom_cli,t3.ape_per,t3.nom_per, t4.nom_deudor,t4.apellidos_deudor
                   FROM venta as t1 , cliente as t2, personal as t3, deudores as t4
                   WHERE t1.estado=? and t2.dni_cli=t1.dni_cli and t3.dni_per=t1.dni_per and t4.id_deudor=t1.id_deudor ORDER BY id_venta ASC";

        // Utilizar parámetros preparados para evitar inyección de SQL
        $stmt = mysqli_prepare($cnn, $con_listar_v);
        mysqli_stmt_bind_param($stmt, 'i' ,$est);
        mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt);
        
    }
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

if($opcion=="listar_detalle"){
    $cod=$_GET['cod'];
    $con_lisd="SELECT t1.*,t2.nom_pro,t.*
               FROM  detalle_venta as t1, producto as t2, venta as t
               WHERE t1.id_venta=$cod and t1.id_pro=t2.id_pro and t.id_venta=$cod";
    $res=mysqli_query($cnn,$con_lisd);
    $num = mysqli_num_rows($res);

    if ($num >= 1) {
        while ($f = mysqli_fetch_array($res)) {
            $json[] = array(
                "cant" => $f['cantidad'],
                "prec" => $f['precio'],
                "icev" => $f['extra'],
                "totv" => $f['total_venta'],
                "nopr" => $f['nom_pro'],
                "idve" => $f['id_venta'],
                "fecv" => $f['fecha_venta'],
                "esta" => $f['estado'],
                "neto" => $f['neto'],
                "deud" => $f['deuda'],
                // "nomc" => $f['nom_cli']." ".$f['ape_cli'],
                // "nomp" => $f['nom_per']." ".$f['ape_per'],
                // "nomd" => $f['nom_deudor']." ".$f['apellidos_deudor'],
            );
        }
        $jsonresponse = json_encode($json, JSON_UNESCAPED_UNICODE);
    } else {
        $jsonresponse = "vacio";
    }
    echo $jsonresponse;
}

if($opcion=="pagar_deuda"){
    $cod=$_GET['cod'];
    $defi=$_GET['defi'];
    $pago=$_GET['pago'];
    if($defi==0){
        $pagar="UPDATE venta SET deuda=0, estado=1   WHERE id_venta='$cod'";
        mysqli_query($cnn,$pagar)or die("Error en Pagar");
        echo "ADELANTO REGISTRADO CORRECTAMENTE";
    }else if($defi>0){
        $pagar="UPDATE venta SET deuda= deuda - $pago   WHERE id_venta='$cod'";
        mysqli_query($cnn,$pagar)or die("Error en Pagar");
        echo "VENTA PAGADA EN SU TOTALIDAD";
    }
}

?>