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

//buscar producto para agregar a temporal
if($opcion=="buscar"){
    $cod=$_GET['cod'];
    $buscar="select* from producto where id_pro='$cod'";
    $res=mysqli_query($cnn,$buscar);
    $num=mysqli_num_rows($res);
    while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod"=>$f['id_pro'],
                "nom"=>$f['nom_pro'],
                "sa"=>$f['sabores'],
                "pre"=>$f['pre_uni']

            );}
    $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    echo $jsonresponse;
}

//agregar a temporal
if($opcion=="agregar_temporal"){
    $cod_ven=$_GET['ven'];
    $cod=$_GET['cod'];
    $can=$_GET['can'];
    $pre=$_GET['pre'];
    $tot=$_GET['tot'];
    // Consultar el stock actual del producto
    $consulta = "SELECT stock_actual FROM producto WHERE id_pro = '$cod'";
    $resultado = mysqli_query($cnn, $consulta);
    $fila = mysqli_fetch_assoc($resultado);
    $stockActual = $fila['stock_actual'];
    
    // Verificar si hay suficiente stock para agregar el producto
    if ($can > $stockActual) {
        echo "Error: Producto Agotado !";
        return;
    } else {
    $agregar="insert temporal_venta
    values('$cod_ven',$cod,$can,$pre,$tot)";
    mysqli_query($cnn,$agregar)or die("Error en registrar producto");
    echo("Producto agregado correctamente");
    }

}

if($opcion=="listar_temporal"){
    $con_listar="SELECT t1.*, t2.nom_pro, t2.sabores
    FROM temporal_venta t1, producto t2  
    WHERE t1.id_pro=t2.id_pro ";          
    $res=mysqli_query($cnn,$con_listar);
    $num=mysqli_num_rows($res);
    if($num>=1){
        while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "nom"=>$f['nom_pro'],
                "sabor"=>$f['sabores'],
                "can"=>$f['cantidad'],
                "pre"=>$f['precio'],
                "tot"=>$f['total_venta'],
            );}
        $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="vacio";
    }  
    echo $jsonresponse;
}
?>