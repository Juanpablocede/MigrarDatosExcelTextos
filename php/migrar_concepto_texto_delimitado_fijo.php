<?php
    include("conexion_db_mdo_2019.php"); //Agregamos la conexión
    $conexion = $conn;
    $registros_ingresados=0;
    $registros_modificados=0;
    //cuando el archivo texto es de tipo ancho fijo
    $archivo=fopen('c:\xampp\htdocs\migrar_data_desde_excel_textos\archivos_textos\cargar_concepto.txt','r') or die ('error al leer archivo');
    while(!feof($archivo))
    {
        $registro=fgets($archivo);
        $codemp=substr($registro,0,4);
        $codnom=substr($registro,4,4);
        $codper=substr($registro,8,10);
        $codcons=substr($registro,18,10);
        $monto=substr($registro,28,12);
        $monto01=substr($registro,40,10);

        $monto = str_replace(",", ".", $monto);

        $sql = "SELECT codemp, codnom, codper, codcons FROM sno_constantepersonal WHERE codemp='".$codemp."' AND ".
               "codnom='".$codnom."' AND codper='".$codper."' AND codcons='".$codcons."'";
    		$result = pg_query($conexion,$sql);
    		$existe = pg_num_rows($result);
    		if ($existe==0)
    		{
    			$sql = "INSERT INTO sno_constantepersonal (codemp, codnom, codper, codcons, moncon, montopcon) VALUES".
          "('$codemp','$codnom','$codper','$codcons',$monto,$monto01);";
          $result = pg_query($conexion,$sql);
    			echo 'Ingresando la constante Personal: '.$codemp.'-'.$codnom.'-'.$codper.'-'.$codcons.'-'.$monto.'-'.$monto01."<br />";
    			$registros_ingresados=$registros_ingresados+1;
    		}
    		if ($existe==1)
    		{
    			$sql="UPDATE sno_constantepersonal SET moncon=".$monto.", montopcon=".$monto01." WHERE codemp='".$codemp."' AND ".
               "codnom='".$codnom."' AND codper='".$codper."' AND codcons='".$codcons."'";
    			$result = pg_query($conexion,$sql);
    			echo 'Modificando la constante Personal: '.$codemp.'-'.$codnom.'-'.$codper.'-'.$codcons.'-'.$monto.'-'.$monto01."<br />";
    			$registros_modificados=$registros_modificados+1;
    		}
    }
    echo ("<br />".'Total de registros insertados: '.$registros_ingresados."<br />".'Total registros modificados: '.$registros_modificados);

    fclose($archivo);

?>
