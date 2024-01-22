<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];
//buscar ultima venta y sumarle uno
if($opcion=="ultimo"){
    $buscar="SELECT MAX(cod_compra) as ultimo
    from compra";
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
//Listar productos
if($opcion=="listar"){
    $con_listar="SELECT t1.*, t2.nom_cat, t3.tipo_uni
    FROM producto t1, categoria t2, unidad_medida t3
    WHERE t1.id_cat = t2.id_cat AND t1.id_uni = t3.id_uni"; 

        if(isset($_GET['nombre'])){
            $nombre=$_GET['nombre'];
            $con_listar="SELECT t1.*, t2.nom_cat, t3.tipo_uni
            FROM producto t1, categoria t2, unidad_medida t3
            WHERE nom_pro LIKE CONCAT('$nombre','%') AND 
            t1.id_cat = t2.id_cat AND t1.id_uni = t3.id_uni";
        }
        
        
    $res=mysqli_query($cnn,$con_listar);
    $num=mysqli_num_rows($res);
    if($num>=1){
        while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod" => $f['id_pro'],
                "nom" => $f['nom_pro'],
                "cat" => $f['nom_cat'],
                "sa" => $f['sabores'],
                "uni" => $f['tipo_uni'],
                "pre" => $f['pre_uni'],
                "min" => $f['stock_min'],
                "actual" => $f['stock_actual'],
                "esc" => $f['estado']
            );}
        $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="vacio";
    }
    echo $jsonresponse;
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
    $cod_com=$_GET['com'];
    $cod=$_GET['cod'];
    $can=$_GET['can'];
    $pre=$_GET['pre'];
    $tot=$_GET['tot'];

    $agregar="INSERT INTO temporal_compra
    VALUES(' ',$cod_com,$cod,$pre,$can,$tot)";
    mysqli_query($cnn,$agregar)or die("Error en registrar producto");
    echo("Producto agregado correctamente");

}

if($opcion=="listar_temporal"){
    $con_listar="SELECT t1.*, t2.id_pro ,t2.nom_pro, t2.sabores, t2.pre_uni
    FROM temporal_venta t1, producto t2  
    WHERE t1.id_pro=t2.id_pro ";          
    $res=mysqli_query($cnn,$con_listar);
    $num=mysqli_num_rows($res);
    if($num>=1){
        while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "item"=>$f['item'],
                "cod"=>$f['id_pro'],
                "nom"=>$f['nom_pro'],
                "sabor"=>$f['sabores'],
                "can"=>$f['cantidad'],
                "pre_com"=>$f['pre_compra'],
                "pre_ven"=>$f['pre_uni'],
                "tot"=>$f['total'],
            );}
        $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="vacio";
    }  
    echo $jsonresponse;
}

// //EXTRA
// if($opcion=="extra"){
// $cod=$_GET['cod'];
// $ex=$_GET['ex'];
// $recorre="SELECT* FROM temporal_venta WHERE item='$cod'";
//             $rre=mysqli_query($cnn,$recorre)or die("Error en recorrido");
//             while($f=mysqli_fetch_array($rre)) {
//                 $item=$f['item'];
//                 $can=$f['cantidad'];
//                 $total_extra=$can*$ex;
//                 $actualizar="UPDATE temporal_venta SET extra=$total_extra, total_venta=total_venta+$total_extra WHERE item='$item'";
//                 mysqli_query($cnn,$actualizar)or die("Error en act. producto");
//             }
// }

// //MENOS EXTRA
// if($opcion=="menos_extra"){
//     $cod=$_GET['cod'];
//     $ex=$_GET['ex'];
//     $recorre="SELECT* FROM temporal_venta WHERE item='$cod'";
//             $rre=mysqli_query($cnn,$recorre)or die("Error en recorrido");
//             while($f=mysqli_fetch_array($rre)) {
//                 $item=$f['item'];
//                 $can=$f['cantidad'];
//                 $total_extra=$can*$ex;
//                 $actualizar="UPDATE temporal_venta SET extra=$total_extra-$total_extra, total_venta=total_venta-$total_extra WHERE item='$item'";
//                 mysqli_query($cnn,$actualizar)or die("Error en act. producto");
//             }
// }

// //cancelar ventas
// if($opcion=="cancelar"){
//     $eliminar="DELETE FROM temporal_venta";
//     mysqli_query($cnn,$eliminar)or die("Error en cancelar");
//     echo "La venta fue cancelada";
// }

// //Registrar venta
// if($opcion=="agregar_venta"){
//     $cod=$_GET['cod'];
//     $fech=$_GET['fecha'];
//     $cli=$_GET['dni_cli'];  
//     $per=$_GET['dni_per'];
//     $est=$_GET['estado'];
//     $deu=$_GET['deudor'];
//     $neto=$_GET['neto'];

//     //Insertar a cabecera
//     $agregar="insert into venta 
//     values('$cod','$fech','$cli','$per',$est,$deu,$neto)";
//     mysqli_query($cnn,$agregar)or die("Error en agregar Venta");
//     echo "Venta registrada correctamente";

//     //pasar temporal a detalle
//     $pasar="INSERT INTO detalle_venta 
//     SELECT* FROM temporal_venta
//     WHERE id_venta=$cod";
//     mysqli_query($cnn,$pasar)or die("Error en pasar temporal a detalle");

//     //PARA ACTUALIZAR EL STOCK
//     $recorre="SELECT* FROM temporal_venta WHERE id_venta='$cod'";
//     $rre=mysqli_query($cnn,$recorre)or die("Error en recorrido");
//     while($f=mysqli_fetch_array($rre)) {
//         $cod_pro=$f['id_pro'];
//         $can_pro=$f['cantidad'];
//         $actualizar="UPDATE producto SET stock_actual=stock_actual-$can_pro WHERE id_pro='$cod_pro'";
//         mysqli_query($cnn,$actualizar)or die("Error en act. stock");
//     }
// }

// //eliminar temporal
// if($opcion=="limpiar"){
//     $eliminar="delete from temporal_venta";
//     mysqli_query($cnn,$eliminar)or die("Error en limpiar");
// }

// //eliminar producto de temporal
// if($opcion=="eliminar"){
//     $cod=$_GET['cod'];
//     $eliminar="delete from temporal_venta where item='$cod'";
//     mysqli_query($cnn,$eliminar)or die("Error en eliminar producto");
//     echo ("PRODUCTO ELIMINADO CORRECTAMENTE");
// }

?>