<?php

	include '../PHPExcel/Classes/PHPExcel/IOFactory.php'; //Agregamos la librería
	include("conexion_db_mdo_2018.php"); //Agregamos la conexión
	$conexion = $conn;

	//Variable con el nombre del archivo
	$nombreArchivo = 'c:\Users\juanpa\aaa_personal.xls';
	// Cargo la hoja de cálculo
	$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);

	//Asigno la hoja de calculo activa
	$objPHPExcel->setActiveSheetIndex(0);
	//Obtengo el numero de filas del archivo
	$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

	//echo '<table border=1><tr><td>Cedula</td><td>Nombres</td><td>Sueldo</td></tr>';
	$registros_ingresados=0;
	$registros_modificados=0;
	for ($i = 2; $i <= $numRows; $i++) {

		$cedula 	= $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$nombres 	= $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$sueldo 	= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();

		/*echo '<tr>';
		echo '<td>'. $cedula.'</td>';
		echo '<td>'. $nombres.'</td>';
		echo '<td>'. $sueldo.'</td>';
		echo '</tr>';*/

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

	//echo '<table>';
	echo ("<br />".'Total de registros insertados: '.$registros_ingresados."<br />".'Total registros modificados: '.$registros_modificados);
?>
