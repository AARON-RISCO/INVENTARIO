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
    values('$cod_ven',$cod,$can,$pre,' ',$tot)";
    mysqli_query($cnn,$agregar)or die("Error en registrar producto");
    echo("Producto agregado correctamente");
    }

}

if($opcion=="listar_temporal"){
    $con_listar="SELECT t1.*, t2.id_pro ,t2.nom_pro, t2.sabores
    FROM temporal_venta t1, producto t2  
    WHERE t1.id_pro=t2.id_pro ";          
    $res=mysqli_query($cnn,$con_listar);
    $num=mysqli_num_rows($res);
    if($num>=1){
        while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod"=>$f['id_pro'],
                "nom"=>$f['nom_pro'],
                "sabor"=>$f['sabores'],
                "can"=>$f['cantidad'],
                "pre"=>$f['precio'],
                "ex"=>$f['extra'],
                "tot"=>$f['total_venta'],
            );}
        $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="vacio";
    }  
    echo $jsonresponse;
}
if($opcion=="listar_temporal_cod"){
    $cod=$_GET['cod'];
    $con_listar="SELECT t2.id_pro, t1.extra
    FROM temporal_venta t1, producto t2  
    WHERE t2.id_pro=$cod AND t1.id_pro=t2.id_pro ";          
    $res=mysqli_query($cnn,$con_listar);
    $num=mysqli_num_rows($res);
    if($num>=1){
        while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod"=>$f['id_pro'],
                "ex"=>$f['extra']
            );}
        $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="vacio";
    }  
    echo $jsonresponse;
}

//EXTRA
if($opcion=="extra"){
$cod=$_GET['cod'];
$ex=$_GET['ex'];
// $modificar="UPDATE temporal_venta SET extra=$ex, total_venta=total_venta+$ex WHERE id_pro='$cod'";
// mysqli_query($cnn,$modificar)or die("Error en modificar producto");
// echo "Producto Actualizado";
$recorre="SELECT* FROM temporal_venta WHERE id_pro='$cod'";
            $rre=mysqli_query($cnn,$recorre)or die("Error en recorrido");
            while($f=mysqli_fetch_array($rre)) {
                $cod_pro=$f['id_pro'];
                $can=$f['cantidad'];
                $total_extra=$can*$ex;
                $actualizar="UPDATE temporal_venta SET extra=$total_extra, total_venta=total_venta+$total_extra WHERE id_pro='$cod'";
                mysqli_query($cnn,$actualizar)or die("Error en act. producto");
            }
}

//MENOS EXTRA
if($opcion=="menos_extra"){
    $cod=$_GET['cod'];
    $ex=$_GET['ex'];
    $recorre="SELECT* FROM temporal_venta WHERE id_pro='$cod'";
            $rre=mysqli_query($cnn,$recorre)or die("Error en recorrido");
            while($f=mysqli_fetch_array($rre)) {
                $cod_pro=$f['id_pro'];
                $can=$f['cantidad'];
                $total_extra=$can*$ex;
                $actualizar="UPDATE temporal_venta SET extra=$total_extra-$total_extra, total_venta=total_venta-$total_extra WHERE id_pro='$cod'";
                mysqli_query($cnn,$actualizar)or die("Error en act. producto");
            }
}

// //cancelar ventas
// if($opcion=="cancelar"){
//     $eliminar="delete from temporal";
//     mysqli_query($conexion,$eliminar)or die("Error en cancelar");
//     echo "La venta fue cancelada";
// }

// //Registrar venta
// if($opcion=="agregar_venta"){
//     $idven=$_GET['cod_ven'];
//     $fech=$_GET['fecha_ven'];
//     $idcli=$_GET['dni_cli'];
//     $idusu=$_GET['dni_usu'];
//     $subtot=$_GET['subtot'];
//     $igv=$_GET['igv'];
//     $neto=$_GET['tot'];
//     //validacion
//     /*if(empty($dni)||empty($ape)||empty($nom)||empty($tel)||empty($dir)){
//         echo "Debe completar todos los campos";
//     }else{*/
//     $agregar="insert into venta 
//     values('$idven','$fech','$idcli','$idusu',$subtot,$igv,$neto)";
//     mysqli_query($conexion,$agregar)or die("Error en agregar Venta");
//     echo "Venta registrada correctamente";
//     /*}*/
//     //pasar temporal a detalle
//     $pasar="insert into detalle_venta 
//     select* from temporal
//     where id_vent='$idven'";
//     mysqli_query($conexion,$pasar)or die("Error en pasar temporal a detalle");
//   //PARA ACTUALIZAR EL STOCK
//     $recorre="select* from temporal where id_vent='$idven'";
//     $rre=mysqli_query($conexion,$recorre)or die("Error en recorrido");
//     while($f=mysqli_fetch_array($rre)) {
//         $cod_pro=$f['cod_pro'];
//         $can_pro=$f['cantidad'];
//         $actualizar="update producto set stock_pro=stock_pro-$can_pro where cod_pro='$cod_pro'";
//         mysqli_query($conexion,$actualizar)or die("Error en act. stock");
//     }
// }

// //eliminar temporal
// if($opcion=="limpiar"){
//     $eliminar="delete from temporal";
//     mysqli_query($conexion,$eliminar)or die("Error en limiar");
// }

//eliminar producto de temporal
if($opcion=="eliminar"){
    $cod=$_GET['cod'];
    $eliminar="delete from temporal_venta where id_pro='$cod'";
    mysqli_query($cnn,$eliminar)or die("Error en eliminar producto");
    echo ("PRODUCTO ELIMINADO CORRECTAMENTE");
}

?>