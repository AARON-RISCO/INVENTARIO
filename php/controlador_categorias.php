<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];
//LLENAR CATEGORIAS
if ($opcion=="listar_categorias") {
        $listar="SELECT * fROM categoria ORDER BY nom_cat";
        $resultado=mysqli_query($cnn,$listar) or die("Error en listar");    
        echo "<option value='0'> SELECCIONE CATEGORIA </option>";
        while ($fila=mysqli_fetch_array($resultado)) {
           $cod=$fila['id_cat'];    
           $nom=$fila['nom_cat'];
           echo "<option value='".$cod."'>".$nom."</option>";
        }
}
//Listar categorias
if($opcion=="listar"){
        $con_listar="SELECT* FROM categoria"; 
    
            if(isset($_GET['nombre'])){
                $nombre=$_GET['nombre'];
                $con_listar="SELECT * FROM categoria
                WHERE nom_cat LIKE CONCAT('$nombre','%')";
            }
            
            
        $res=mysqli_query($cnn,$con_listar);
        $num=mysqli_num_rows($res);
        if($num>=1){
            while($f=mysqli_fetch_array($res)){
                $json[]=array(
                    "cod"=>$f['id_cat'],
                    "nom"=>$f['nom_cat'],
                    "estado"=>$f['estado']
                );}
            $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
        }else{
            $jsonresponse="vacio";
        }
        echo $jsonresponse;
}
//agregar nuevo categoria
if($opcion=="agregar"){
        $nom=$_GET['nom'];
        $agregar="insert into categoria
        values(' ', '$nom',' ')";
        mysqli_query($cnn,$agregar)or die("Error en registrar categoria");
        echo "Categoria registrada correctamente";
}
    
//buscar categoria a modificar
if($opcion=="buscar"){
    $cod=$_GET['cod'];
    $buscar="SELECT* FROM categoria WHERE id_cat='$cod'";
    $res=mysqli_query($cnn,$buscar);
    $num=mysqli_num_rows($res);
    while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod"=>$f['id_cat'],
                "nom"=>$f['nom_cat']
            );}
    $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    echo $jsonresponse;
}
    
    
    //Actualizar categoria
    if($opcion=="actualizar"){
        $cod=$_GET['cod'];
        $nom=$_GET['nom'];
        $modificar="update categoria set nom_cat='$nom' where id_cat='$cod'";
        mysqli_query($cnn,$modificar)or die("Error en modificar categoria");
        echo "Categoria Actualizado";
    }

?>