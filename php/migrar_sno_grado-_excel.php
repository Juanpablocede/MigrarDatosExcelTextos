<?php

	include '../PHPExcel/Classes/PHPExcel/IOFactory.php'; //Agregamos la librería
	include("conexion_db_mdo_2019.php"); //Agregamos la conexión
	$conexion = $conn;

	//Variable con el nombre del archivo
	$nombreArchivo = 'c:\xampp\htdocs\migrar_data_desde_excel_textos\archivos_excel\sno_grado.xls';
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

		$campo01 	= $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$campo02 	= $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$campo03 	= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$campo04 	= $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		$campo05 	= $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		$campo06 	= $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
		$campo07 	= $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
		$campo08 	= $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
		$campo09 	= $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();

		/*echo '<tr>';
		echo '<td>'. $campo01.'</td>';
		echo '<td>'. $campo02.'</td>';
		echo '<td>'. $campo03.'</td>';
		echo '</tr>';*/

		$sql = "SELECT codemp, codnom, codtab, codpas, codgra FROM sno_grado ".
					 "WHERE codemp='".$campo01."' AND codnom='".$campo02."' AND codtab='".$campo03."' AND codpas='".$campo04."' AND codgra='".$campo05."'";
		//echo $sql;die();
		$result = pg_query($conexion,$sql);
		$existe = pg_num_rows($result);
		if ($existe==0)
		{
			$sql = "INSERT INTO sno_grado (codemp,codnom,codtab,codpas,codgra,monsalgra,moncomgra,aniodes,aniohas) ".
						 "VALUES('$campo01','$campo02','$campo03','$campo04','$campo05','$campo06','$campo07','$campo08','$campo09');";
 			$result = pg_query($conexion,$sql);
			echo 'Ingresando Tabulador: '.$campo01.'-'.$campo02.'-'.$campo03.'-'.$campo04.'-'.$campo05.'-'.$campo06."<br />";
			$registros_ingresados=$registros_ingresados+1;
		}
		if ($existe==1)
		{
			$sql="UPDATE sno_grado SET monsalgra='".$campo06."', moncomgra='".$campo07."', aniodes='".$campo08."', aniohas='".$campo09."' ".
			 	 	 "WHERE codemp='".$campo01."' AND codnom='".$campo02."' AND codtab='".$campo03."' AND codpas='".$campo04."' AND codgra='".$campo05."'";
			$result = pg_query($conexion,$sql);
			echo 'Modificando Tabulador: '.$campo01.'-'.$campo02.'-'.$campo03.'-'.$campo04.'-'.$campo05.'-'.$campo06."<br />";
			$registros_modificados=$registros_modificados+1;
		}
	}

	//echo '<table>';
	echo ("<br />".'Total de registros insertados: '.$registros_ingresados."<br />".'Total registros modificados: '.$registros_modificados);
?>
