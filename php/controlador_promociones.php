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

?>