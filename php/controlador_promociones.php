<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];

// Listar promociones
if ($opcion == "listar") {
    $nom = $_GET['nom'];
    $sa = $_GET['sa'];

    $con_listar = "SELECT t1.id_promocion, t2.nom_pro, t2.sabores,t1.cantidad, t1.pre_venta
                   FROM promociones t1
                   INNER JOIN producto t2 ON t1.id_pro=t2.id_pro";

    if ($nom != '') {
        // Búsqueda solo por nombre
        $con_listar .= " WHERE t2.nom_pro LIKE '" . $nom . "%'";
    } elseif ($sa != '') {
        // Búsqueda solo por sabor
        $con_listar .= " WHERE t2.sabores LIKE '" . $sa . "%'";
    }

    $res = mysqli_query($cnn, $con_listar);
    $num = mysqli_num_rows($res);
    if ($num >= 1) {
        while ($f = mysqli_fetch_array($res)) {
            $json[] = array(
                "cod" => $f['id_promocion'],
                "nom" => $f['nom_pro'],
                "sa" => $f['sabores'],
                "can" => $f['cantidad'],
                "pre" => $f['pre_venta']
            );
        }
        $jsonresponse = json_encode($json, JSON_UNESCAPED_UNICODE);
    } else {
        $jsonresponse = "vacio";
    }
    echo $jsonresponse;
}

// Listar productos
if ($opcion == "listar_productos") {
    $con_listar = "SELECT id_pro, nom_pro, sabores, pre_uni
                   FROM producto 
                   ORDER BY nom_pro";
        if(isset($_GET['nom'])){
        $nom=$_GET['nom'];
        $con_listar="SELECT id_pro, nom_pro, sabores, pre_uni
        FROM producto
        WHERE nom_pro like CONCAT('$nom','%') ORDER BY nom_pro";
        }
       
    $res = mysqli_query($cnn, $con_listar);
    $num = mysqli_num_rows($res);
    if ($num >= 1) {
        while ($f = mysqli_fetch_array($res)) {
            $json[] = array(
                "cod" => $f['id_pro'],
                "nom" => $f['nom_pro'],
                "sa" => $f['sabores'],
                "pre" => $f['pre_uni']
            );
        }
        $jsonresponse = json_encode($json, JSON_UNESCAPED_UNICODE);
    } else {
        $jsonresponse = "vacio";
    }
    echo $jsonresponse;
}

//extraer producto por codigo
if ($opcion == "extraer_pro") {
    $cod=$_GET['cod'];
    $buscar = "SELECT id_pro, nom_pro, sabores
                FROM producto 
                WHERE id_pro=$cod";

    $res=mysqli_query($cnn,$buscar);
    $num=mysqli_num_rows($res);
    while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod"=>$f['id_pro'],
                "nom"=>$f['nom_pro'],
                "sa"=>$f['sabores']
            );}
    $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    echo $jsonresponse;
}

//agregar nueva promocion
if($opcion=="agregar_promo"){
    $cod=$_GET['cod'];
    $can=$_GET['can'];
    $pre=$_GET['pre'];
    $agregar="INSERT INTO promociones
    VALUES(' ', $cod,$can,$pre)";
    mysqli_query($cnn,$agregar)or die("Error en registrar Promocion");
    echo "Promocion registrada correctamente";
}
//buscar promocion a modificar
if($opcion=="buscar_promo"){
$cod=$_GET['cod'];
$buscar="SELECT t1.id_promocion,t1.id_pro, t2.nom_pro, t2.sabores,t1.cantidad, t1.pre_venta
        FROM promociones t1
        INNER JOIN producto t2 ON t1.id_pro=t2.id_pro
        WHERE t1.id_promocion='$cod'";
$res=mysqli_query($cnn,$buscar);
$num=mysqli_num_rows($res);
while($f=mysqli_fetch_array($res)){
        $json[]=array(
            "cod"=>$f['id_promocion'],
            "cod_pro"=>$f['id_pro'],
            "nom"=>$f['nom_pro'],
            "sa"=>$f['sabores'],
            "can"=>$f['cantidad'],
            "pre"=>$f['pre_venta']
        );}
$jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
echo $jsonresponse;
}
//Actualizar promocion
if($opcion=="actualizar"){
    $cod=$_GET['cod'];
    $cod_pro=$_GET['cod_pro'];
    $can=$_GET['can'];
    $pre=$_GET['pre'];
    $modificar="UPDATE promociones SET id_pro = $cod_pro, cantidad = $can, pre_venta=$pre
                WHERE id_promocion='$cod'";
    mysqli_query($cnn,$modificar)or die("ERROR EN MODIFICAR PROMOCION");
    echo "PROMOCION ACTUALIZADA";
}

//Eliminar Promocion
if($opcion=="eliminar"){
    $cod=$_GET['cod'];
    $eliminar="DELETE FROM promociones WHERE id_promocion=$cod";
    mysqli_query($cnn,$eliminar)or die("ERROR EN ELIMINAR PROMOCION");
    echo("PROMOCION ELIMINADA CORRECTAMENTE");
}

?>