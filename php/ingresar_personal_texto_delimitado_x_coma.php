<?php
    include("conexion_db_mdo_2018.php"); //Agregamos la conexión
    $conexion = $conn;
    $registros_ingresados=0;
    $registros_modificados=0;
    //cuando el archivo texto es delimitado por coma (,)
    $filas=file("c:\Users\juanpa\aaa_personal.txt");
    foreach($filas as $value)
    {
        list($cedula, $nombres, $sueldo) = explode(",", $value);

        $sql = "SELECT cedula FROM aaa_personal WHERE cedula='".$cedula."'";
    		$result = pg_query($conexion,$sql);
    		$existe = pg_num_rows($result);
    		if ($existe==0)
    		{
    			$sql = "INSERT INTO aaa_personal (cedula, nombres, sueldo) VALUES('$cedula','$nombres',$sueldo);";
          $result = pg_query($conexion,$sql);
    			echo 'Ingresando al personal: '.$cedula.'-'.$nombres.'-'.$sueldo."<br />";
    			$registros_ingresados=$registros_ingresados+1;
    		}
    		if ($existe==1)
    		{
    			$sql="UPDATE aaa_personal SET nombres='".$nombres."', sueldo=".$sueldo." WHERE cedula='".$cedula."';";
    			$result = pg_query($conexion,$sql);
    			echo 'Modificando al personal: '.$cedula.'-'.$nombres.'-'.$sueldo."<br />";
    			$registros_modificados=$registros_modificados+1;
    		}
    }
    echo ("<br />".'Total de registros insertados: '.$registros_ingresados."<br />".'Total registros modificados: '.$registros_modificados);
?>
