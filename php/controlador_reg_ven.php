<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];
//buscar ultima venta y sumarle uno
if($opcion=="ultimo"){
    $buscar="SELECT MAX(id_venta) as ultimo
    from venta";
    $res=mysqli_query($cnn,$buscar);
    $num=mysqli_num_rows($res);
    if($num>=1){
    while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod"=>$f['ultimo']+1
            );
        }
    $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="Nada";
    }
    echo $jsonresponse;
}
if($opcion=="Buscar_ClienteGeneral"){
    $buscar="SELECT CONCAT(nom_cli,' ',ape_cli) as cliente
                    FROM cliente
                    WHERE dni_cli='11111111'";
    $res=mysqli_query($cnn,$buscar);
    $num=mysqli_num_rows($res);
    if($num>=1){
    while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cli"=>$f['cliente']
            );
        }
    $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="Nada";
    }
    echo $jsonresponse;
}
if ($opcion=="deudorGeneral") {
    $listar="SELECT * fROM deudores WHERE id_deudor=1";
    $resultado=mysqli_query($cnn,$listar) or die("Error en listar");    
    while ($fila=mysqli_fetch_array($resultado)) {
       $cod=$fila['id_deudor'];    
       $nom=$fila['nom_deudor'];
       $ape=$fila['apellidos_deudor'];
       echo "<option value='".$cod."'>".$nom." ".$ape."</option>";
    }
}

if ($opcion=="deudores") {
    $listar="SELECT * fROM deudores WHERE estado=0 ORDER BY apellidos_deudor";
    $resultado=mysqli_query($cnn,$listar) or die("Error en listar"); 
    echo "<option value='0'> SELECCIONE DEUDOR</option>";   
    while ($fila=mysqli_fetch_array($resultado)) {
       $cod=$fila['id_deudor'];    
       $nom=$fila['nom_deudor'];
       $ape=$fila['apellidos_deudor'];
       echo "<option value='".$cod."'>".$nom." ".$ape."</option>";
    }
}


?>