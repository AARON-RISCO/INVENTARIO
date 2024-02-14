<?php
include("../conexion/conexion.php");
$opcion=$_GET['opcion'];

// if($opcion=="autocompletarid"){
//     $consultar="SELECT MAX(id_caja) as max_id FROM caja";
//     $result=mysqli_query($cnn,$consultar)or die("error en buscar numero mayor");
//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         $next_id = $row["max_id"] + 1;
//     } else {
//         $next_id = 1;
//     }
//     echo $next_id;

// }
// obtener fecha actual
date_default_timezone_set('America/Lima');
$fecha_actual = date('Y-m-d');


if($opcion=="llenar_apertura"){
    
    $buscar="SELECT* FROM caja WHERE fecha_caja='$fecha_actual'";
    $res=mysqli_query($cnn,$buscar);
    $num=mysqli_num_rows($res);
    if($num>=1){
        $response="ocultar";
    }else{
        $response="aparecer";
    }
    echo $response;
}

if($opcion=="apertura_caja"){
    $monto=$_GET['monto'];
    $id_per=$_GET['per'];
    $consultar="SELECT MAX(id_caja) as max_id FROM caja";
    $result=mysqli_query($cnn,$consultar)or die("error en buscar numero mayor");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $next_id = $row["max_id"] + 1;
    } else {
        $next_id = 1;
    }

    $insertar="INSERT INTO caja values($next_id,'$fecha_actual',$monto,0,0,0)";
    mysqli_query($cnn,$insertar);

    $insertar_detalle="INSERT INTO detalle_caja values($next_id,'','$id_per','GANANCIA DE VENTAS',0,'VENTA'),($next_id,'','$id_per','GASTO DE COMPRAS',0,'COMPRA')";
    mysqli_query($cnn,$insertar_detalle);

    echo "caja aperturada";
}

if($opcion=="listar_detalle_caja"){
    $listar_detalle="SELECT dc.*,pe.nom_per,pe.ape_per FROM detalle_caja as dc, personal as pe WHERE pe.dni_per=dc.dni_per ORDER BY dni_per";
    $res=mysqli_query($cnn,$listar_detalle);
    $num=mysqli_num_rows($res);
    if($num>0){
        while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "nro_mov"=>$f['nro_mov'],
                "nom_per"=>$f['nom_per']." ".$f['ape_per'],
                "movimi"=>$f['tipo_movimiento'],
                "motivo"=>$f['motivo'],
                "total"=>$f['total'],
            );
        }
        $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="vacio";
    }
    echo $jsonresponse;
}

if($opcion=="listar_cabe_caja"){
    $listar_cabe="SELECT * FROM caja ORDER BY id_caja";
    $res=mysqli_query($cnn,$listar_cabe);
    $num=mysqli_num_rows($res);
    if($num>0){
        while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "id_ca"=>$f['id_caja'],
                "fecha"=>$f['fecha_caja'],
                "apert"=>$f['apertura'],
                "ingre"=>$f['ingresos'],
                "egres"=>$f['egresos'],
                "total"=>$f['total'],
            );
        }
        $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="vacio";
    }
    echo $jsonresponse;
}
?>