<?php 
include("../conexion/conexion.php");

$opcion=$_GET['opcion'];
if($opcion=="listar_caja"){
    $consulca="SELECT* FROM caja ORDER BY id_caja ASC";

    if(isset($_GET['p1'])){
        $fe1=$_GET['p1'];
        $fe2=$_GET['p2'];
        $consulca = "SELECT* FROM caja 
                     WHERE fecha_caja BETWEEN '$fe1' and '$fe2'
                     ORDER BY id_caja ASC";
    }

    $resca=mysqli_query($cnn,$consulca);
    $num=mysqli_num_rows($resca);
    if($num>0){
        while($fi=mysqli_fetch_array($resca)){
            $json[]=array(
                "idcaj"=>$fi['id_caja'],
                "fecha"=>$fi['fecha_caja'],
                "apert"=>$fi['apertura'],
                "ingre"=>$fi['ingresos'],
                "egres"=>$fi['egresos'],
                "total"=>$fi['total'],
            );
        }
        $jsonresponse=json_encode($json,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="vacio";
    }

    echo $jsonresponse;
}

if($opcion=="listar_detalle_c"){
    $p1=$_GET['p1'];
    $listar_detalle="SELECT dc.*,pe.nom_per,pe.ape_per
                     FROM detalle_caja as dc, personal as pe
                     WHERE pe.dni_per=dc.dni_per 
                     AND  dc.id_caja=$p1
                     ORDER BY dc.nro_mov";
        
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


?>