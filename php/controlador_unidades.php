<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];
//LLENAR UNIDADES
if ($opcion=="listar_unidades") {
        $listar="SELECT * fROM unidad_medida ORDER BY tipo_uni";
        $resultado=mysqli_query($cnn,$listar) or die("Error en listar");    
        echo "<option value='0'> SELECCIONE TIPO DE UNIDAD </option>";
        while ($fila=mysqli_fetch_array($resultado)) {
           $cod=$fila['id_uni'];    
           $nom=$fila['tipo_uni'];
           echo "<option value='".$cod."'>".$nom."</option>";
        }
}
//agregar nueva Unidad
if($opcion=="agregar"){
        $nom=$_GET['nom'];
        $agregar="insert into unidad_medida
        values(' ', '$nom',' ')";
        mysqli_query($cnn,$agregar)or die("Error en registrar Unidad de Medida");
        echo "Unidad de Medida registrada correctamente";
}

//Listar categorias
if($opcion=="listar"){
        $con_listar="SELECT* FROM unidad_medida"; 
    
            if(isset($_GET['nombre'])){
                $nombre=$_GET['nombre'];
                $con_listar="SELECT * FROM unidad_medida
                WHERE tipo_uni LIKE CONCAT('$nombre','%')";
            }
            
            
        $res=mysqli_query($cnn,$con_listar);
        $num=mysqli_num_rows($res);
        if($num>=1){
            while($f=mysqli_fetch_array($res)){
                $json[]=array(
                    "cod"=>$f['id_uni'],
                    "nom"=>$f['tipo_uni'],
                    "estado"=>$f['estado']
                );}
            $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
        }else{
            $jsonresponse="vacio";
        }
        echo $jsonresponse;
}
    
//buscar unidad_medida a modificar
if($opcion=="buscar"){
    $cod=$_GET['cod'];
    $buscar="SELECT* FROM unidad_medida WHERE id_uni='$cod'";
    $res=mysqli_query($cnn,$buscar);
    $num=mysqli_num_rows($res);
    while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "cod"=>$f['id_uni'],
                "nom"=>$f['tipo_uni'],
                "esc"=>$f['estado']
            );}
    $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    echo $jsonresponse;
}
    
    
    //Actualizar unidad_medida
    if($opcion=="actualizar"){
        $cod=$_GET['cod'];
        $nom=$_GET['nom'];
        $modificar="update unidad_medida set tipo_uni='$nom' where id_uni='$cod'";
        mysqli_query($cnn,$modificar)or die("Error en modificar Unidad de Medida");
        echo "UNIDAD DE MEDIDA ACTUALIZADA";
    }

    if($opcion=="deshabilitar"){
        $code=$_GET['code'];
        $esta=$_GET['esta'];
        if($esta==1){
            $modificarc="update unidad_medida set estado=0 where id_uni='$code'";
            $msj="UNIDAD HABILITADA CORRECTAMENTE";
        }elseif($esta==0){
            $modificarc="update unidad_medida set estado=1 where id_uni='$code'";
            $msj="UNIDAD DESHABILITADA CORRECTAMENTE";
        }

        mysqli_query($cnn,$modificarc)or die("Error en modificar UNIDAD");
        echo $msj;
    }   

?>