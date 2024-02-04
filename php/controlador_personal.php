<?php
include "../conexion/conexion.php";
$opcion=$_GET['opcion'];

//Listar categorias
if($opcion=="listar"){
    $dni = $_GET['dni'];
    $apellido = $_GET['ape'];
    $nombre = $_GET['nom'];
    $cargo = $_GET['car'];

        $con_listar="SELECT* FROM personal WHERE 0=0"; 
        
        if ($dni != '') {
            // Búsqueda solo por dni
            $con_listar .= " AND dni_per LIKE '%" . $dni . "%'";
        } elseif ($apellido != '') {
            // Búsqueda solo por apellido
            $con_listar .= " AND ape_per LIKE '%" . $apellido . "%'";
        } elseif ($nombre != '') {
            // Búsqueda solo por nombre
            $con_listar .= " AND nom_per LIKE '%" . $nombre . "%'";
        } elseif ($cargo != '') {
            // Búsqueda solo por cargo
            $con_listar .= " AND tipo_per LIKE '%" . $cargo . "%'";
        }
            
        $res=mysqli_query($cnn,$con_listar);
        $num=mysqli_num_rows($res);
        if($num>=1){
            while($f=mysqli_fetch_array($res)){
                $json[]=array(
                    "dni"=>$f['dni_per'],
                    "per"=>$f['nom_per'].' '.$f['ape_per'],
                    "car"=>$f['tipo_per'],
                    "estado"=>$f['estado_per'],
                    "clave"=>$f['clave_per']
                );}
            $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
        }else{
            $jsonresponse="vacio";
        }
        echo $jsonresponse;
}
//agregar nuevo categoria
if($opcion=="agregar"){
        $dni=$_GET['dni'];
        $ape=$_GET['ape'];
        $nom=$_GET['nom'];
        $tipo=$_GET['tipo'];
        $clave=$_GET['clave'];
        $agregar="INSERT INTO personal
        VALUES(' $dni','$ape','$nom','ACTIVO','$tipo','$clave')";
        mysqli_query($cnn,$agregar)or die("ERROR EN REGISTRAR PERSONAL");
        echo "PERSONAL REGISTRADO CORRECTAMENTE";
}
    
//buscar categoria a modificar
if($opcion=="buscar"){
    $cod=$_GET['cod'];
    $buscar="SELECT* FROM personal WHERE dni_per='$cod'";
    $res=mysqli_query($cnn,$buscar);
    $num=mysqli_num_rows($res);
    while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "dni"=>$f['dni_per'],
                "ape"=>$f['ape_per'],
                "nom"=>$f['nom_per'],
                "estado"=>$f['estado_per'],
                "car"=>$f['tipo_per'],
                "cla"=>$f['clave_per']
            );}
    $jsonresponse=json_encode($json ,JSON_UNESCAPED_UNICODE);
    echo $jsonresponse;
}
    
    //Actualizar personal
    if($opcion=="actualizar"){
        $dni=$_GET['dni'];
        $ape=$_GET['ape'];
        $nom=$_GET['nom'];
        $tipo=$_GET['tipo'];
        $clave=$_GET['clave'];
        $modificar="UPDATE personal SET ape_per='$ape',nom_per='$nom',tipo_per='$tipo',clave_per='$clave' WHERE dni_per='$dni'";
        mysqli_query($cnn,$modificar)or die("ERROR, NO SE MODIFICO EL PERSONAL");
        echo "PERSONAL ACTUALIZADO CORRECTAMENTE";
    }

    if($opcion=="deshabilitar"){
        $code=$_GET['code'];
        $esta=$_GET['esta'];
        if($esta=="ACTIVO"){
            $modificarc="UPDATE personal set estado_per='INACTIVO' where dni_per='$code'";
            $msj="PERSONAL DESACTIVADO CORRECTAMENTE";
        }elseif($esta=="INACTIVO"){
            $modificarc="UPDATE personal set estado_per='ACTIVO' where dni_per='$code'";
            $msj="PERSONAL ACTIVADO CORRECTAMENTE";
        }

        mysqli_query($cnn,$modificarc)or die("ERROR EN ACTUALIZAR ESTADO");
    }

?>