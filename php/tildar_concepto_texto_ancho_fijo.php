<?php
    include("conexion_db_mdo_2019.php"); //Agregamos la conexión
    $conexion = $conn;
    $registros_modificados=0;
    //cuando el archivo texto es de tipo ancho fijo
    $archivo=fopen('c:\xampp\htdocs\migrar_data_desde_excel_textos\archivos_textos\tildar_concepto.txt','r') or die ('error al leer archivo');
    while(!feof($archivo))
    {
        $registro=fgets($archivo);
        $codemp=substr($registro,0,4);
        $codnom=substr($registro,4,4);
        $codper=substr($registro,8,10);
        $codconc=substr($registro,18,10);
        $monto=substr($registro,28,10);
        $monto01=substr($registro,38,10);

      	$sql="UPDATE sno_conceptopersonal SET aplcon=".$monto." WHERE codemp='".$codemp."' AND ".
             "codnom='".$codnom."' AND codper='".$codper."' AND codconc='".$codconc."'";
  			$result = pg_query($conexion,$sql);
  			echo 'Actualizando el Concepto Personal: '.$codemp.'-'.$codnom.'-'.$codper.'-'.$codconc.'-'.$monto.'-'.$monto01."<br />";
  			$registros_modificados=$registros_modificados+1;
    }
    echo ("<br />".'Total registros modificados: '.$registros_modificados);

    fclose($archivo);

?>
