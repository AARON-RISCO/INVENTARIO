<?php 
include("../conexion/conexion.php");
$opcion=$_GET['opcion'];

if($opcion=="listar"){

    $consulta="SELECT * FROM producto ";
                    
        if(isset($_GET['nombre'])){
            $cod = $_GET['nombre'];
            $consulta .= " WHERE nom_pro LIKE '$cod%'";
        }

        if(isset($_GET['f1']) && $_GET['f1']==1){
            // $codi = $_GET['f1'];
            $consulta .= " AND stock_min >= stock_actual";
        }

        if(isset($_GET['f1']) && $_GET['f1']==2){
            // $codi = $_GET['f1'];
            $consulta .= " AND stock_min <= stock_actual";
        }

        if(isset($_GET['f2']) && $_GET['f2']>0){
            $codca = $_GET['f2'];
            $consulta .= " AND id_cat=$codca";
        }

        if(isset($_GET['f3'])){
            $codes = $_GET['f3'];
            $consulta .= " AND estado=$codes";
        }
                
    $consulta .= " ORDER BY id_pro";
  
    $res=mysqli_query($cnn,$consulta);
    $num=mysqli_num_rows($res);

    if($num>0){
        while($f=mysqli_fetch_array($res)){
            $json[]=array(
                "idp"=>$f['id_pro'],
                "nomp"=>$f['nom_pro'],
                "catp"=>$f['id_cat'],
                "prep"=>$f['pre_uni'],
                "stop"=>$f['stock_actual'],
                "prec"=>$f['pre_co'],   
            );
        }
        $jsonencode=json_encode($json,JSON_UNESCAPED_UNICODE);
    }else{
        $jsonencode="vacio";
    }
    echo $jsonencode;
}   

?>