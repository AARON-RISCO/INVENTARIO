<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];
//LISTAR TODOS LOS PRODUCTOS Y FILTRAR POR NOMBRE
if($opcion=="listar"){
    $con_listar="SELECT t1.*, t2.nom_cat, t3.tipo_uni
                FROM producto t1, categoria t2, unidad_medida t3
                WHERE t1.estado=0 AND t1.id_cat=t2.id_cat AND t1.id_uni=t3.id_uni"; 

        if(isset($_GET['nombre'])){
            $nombre=$_GET['nombre'];
            $con_listar=" SELECT t1.*, t2.nom_cat, t3.tipo_uni
            FROM producto t1, categoria t2, unidad_medida t3
            WHERE nom_pro LIKE CONCAT('$nombre','%') AND
            t1.estado=0 AND t1.id_cat=t2.id_cat AND t1.id_uni=t3.id_uni";
        }
        
        
        
    $res=mysqli_query($cnn,$con_listar);
    $num=mysqli_num_rows($res);
    if($num>=1){
        while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod"=>$f['id_pro'],
                "nom"=>$f['nom_pro'],
                "cat"=>$f['nom_cat'],
                "sa"=>$f['sabores'],
                "uni"=>$f['tipo_uni'],
                "pre"=>$f['pre_uni'],
                "min"=>$f['stock_min'],
                "actual"=>$f['stock_actual'],
                "esc"=>$f['estado']
            );}
        $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="vacio";
    }
    echo $jsonresponse;
}
//LISTAR POR SABORES
if($opcion=="listar_sabores"){
    $sabor=$_GET['sabor'];

    $con_listar=" SELECT t1.*, t2.nom_cat, t3.tipo_uni
    FROM producto t1, categoria t2, unidad_medida t3
    WHERE sabores LIKE CONCAT('$sabor','%') AND
    t1.estado=0 AND t1.id_cat=t2.id_cat AND t1.id_uni=t3.id_uni";

    $res=mysqli_query($cnn,$con_listar);
    $num=mysqli_num_rows($res);
    if($num>=1){
        while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod"=>$f['id_pro'],
                "nom"=>$f['nom_pro'],
                "cat"=>$f['nom_cat'],
                "sa"=>$f['sabores'],
                "uni"=>$f['tipo_uni'],
                "pre"=>$f['pre_uni'],
                "min"=>$f['stock_min'],
                "actual"=>$f['stock_actual']
            );}
        $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="vacio";
    }
    echo $jsonresponse;
}
//LISTAR POR categorias
if($opcion=="listar_por_categorias"){
    $categoria=$_GET['categoria'];

    $con_listar=" SELECT t1.*, t2.nom_cat, t3.tipo_uni
    FROM producto t1, categoria t2, unidad_medida t3
    WHERE t1.id_cat = $categoria AND
    t1.estado=0 AND t1.id_cat=t2.id_cat AND t1.id_uni=t3.id_uni";

    $res=mysqli_query($cnn,$con_listar);
    $num=mysqli_num_rows($res);
    if($num>=1){
        while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod"=>$f['id_pro'],
                "nom"=>$f['nom_pro'],
                "cat"=>$f['nom_cat'],
                "sa"=>$f['sabores'],
                "uni"=>$f['tipo_uni'],
                "pre"=>$f['pre_uni'],
                "min"=>$f['stock_min'],
                "actual"=>$f['stock_actual']
            );}
        $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonresponse="vacio";
    }
    echo $jsonresponse;
}
//agregar nuevo producto
if($opcion=="agregar"){
    $nom=$_GET['nom'];
    $sabor=$_GET['sabor'];
    $cat=$_GET['cat'];
    $uni=$_GET['uni'];
    $pre=$_GET['pre'];
    $minimo=$_GET['minimo'];
    $actual=$_GET['actual'];
    $agregar="insert into producto
    values(' ', '$nom','$sabor',$cat,$uni,$pre,$minimo,$actual,' ')";
    mysqli_query($cnn,$agregar)or die("Error en registrar producto");
    echo "Producto registrado correctamente";
}

//buscar producto a modificar
if($opcion=="buscar"){
    $cod=$_GET['cod'];
    $buscar="SELECT* FROM producto WHERE id_pro='$cod'";
    $res=mysqli_query($cnn,$buscar);
    $num=mysqli_num_rows($res);
    while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod"=>$f['id_pro'],
                "nom"=>$f['nom_pro'], 
                "sabor"=>$f['sabores'], 
                "cat"=>$f['id_cat'],
                "uni"=>$f['id_uni'],
                "pre"=>$f['pre_uni'],
                "minimo"=>$f['stock_min'],
                "actual"=>$f['stock_actual'],
                "esc"=>$f['estado']
            );}
    $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    echo $jsonresponse;
}


//Actualizar producto
if($opcion=="actualizar"){
    $cod=$_GET['cod'];
    $nom=$_GET['nom'];
    $sabor=$_GET['sabor'];
    $cat=$_GET['cat'];
    $uni=$_GET['uni'];
    $pre=$_GET['pre'];
    $minimo=$_GET['minimo'];
    $actual=$_GET['actual'];
    $modificar="update producto set nom_pro='$nom',sabores='$sabor',
                id_cat='$cat', id_uni='$uni', pre_uni='$pre', stock_min='$minimo',
                stock_actual='$actual' where id_pro='$cod'";
    mysqli_query($cnn,$modificar)or die("Error en modificar producto");
    echo "Producto Actualizado";
}

if($opcion=="deshabilitar"){
    $code=$_GET['code'];
    $esta=$_GET['esta'];
    if($esta==1){
        $modificarc="update producto set estado=0 where id_pro='$code'";
        $msj="PRODUCTO HABILITADA CORRECTAMENTE";
    }elseif($esta==0){
        $modificarc="update producto set estado=1 where id_pro='$code'";
        $msj="PRODUCTO DESHABILITADA CORRECTAMENTE";
    }

    mysqli_query($cnn,$modificarc)or die("Error en modificar producto");
    echo $msj;
}
?>