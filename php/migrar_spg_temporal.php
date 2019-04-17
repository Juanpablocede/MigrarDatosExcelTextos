<?php

	include '../PHPExcel/Classes/PHPExcel/IOFactory.php'; //Agregamos la librería
	include("conexion_db_mdo_2018.php"); //Agregamos la conexión
	$conexion = $conn;

	//Variable con el nombre del archivo
	$nombreArchivo = 'c:\Users\juanpa\spg_temporal.xls';
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
		$campo10 	= $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
		$campo11 	= $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
		$campo12 	= $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
		$campo13 	= $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
		$campo14 	= $objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
		$campo15 	= $objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue();
		$campo16 	= $objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue();
		$campo17 	= $objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue();
		$campo18 	= $objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue();
		$campo19 	= $objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue();
		$campo20 	= $objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue();
		$campo21 	= $objPHPExcel->getActiveSheet()->getCell('U'.$i)->getCalculatedValue();
		$campo22 	= $objPHPExcel->getActiveSheet()->getCell('V'.$i)->getCalculatedValue();
		$campo23 	= $objPHPExcel->getActiveSheet()->getCell('W'.$i)->getCalculatedValue();
		$campo24 	= $objPHPExcel->getActiveSheet()->getCell('X'.$i)->getCalculatedValue();
		$campo25 	= $objPHPExcel->getActiveSheet()->getCell('Y'.$i)->getCalculatedValue();
		$campo26 	= $objPHPExcel->getActiveSheet()->getCell('Z'.$i)->getCalculatedValue();
		$campo27 	= $objPHPExcel->getActiveSheet()->getCell('AA'.$i)->getCalculatedValue();
		$campo28 	= $objPHPExcel->getActiveSheet()->getCell('AB'.$i)->getCalculatedValue();
		$campo29 	= $objPHPExcel->getActiveSheet()->getCell('AC'.$i)->getCalculatedValue();
		$campo30 	= $objPHPExcel->getActiveSheet()->getCell('AD'.$i)->getCalculatedValue();
		$campo31 	= $objPHPExcel->getActiveSheet()->getCell('AE'.$i)->getCalculatedValue();
		$campo32 	= $objPHPExcel->getActiveSheet()->getCell('AF'.$i)->getCalculatedValue();
		$campo33 	= $objPHPExcel->getActiveSheet()->getCell('AG'.$i)->getCalculatedValue();
		$campo34 	= $objPHPExcel->getActiveSheet()->getCell('AH'.$i)->getCalculatedValue();
		$campo35 	= $objPHPExcel->getActiveSheet()->getCell('AI'.$i)->getCalculatedValue();
		$campo36 	= $objPHPExcel->getActiveSheet()->getCell('AJ'.$i)->getCalculatedValue();
		$campo37 	= $objPHPExcel->getActiveSheet()->getCell('AK'.$i)->getCalculatedValue();
		$campo38 	= $objPHPExcel->getActiveSheet()->getCell('AL'.$i)->getCalculatedValue();
		$campo39 	= $objPHPExcel->getActiveSheet()->getCell('AM'.$i)->getCalculatedValue();
		$campo40 	= $objPHPExcel->getActiveSheet()->getCell('AN'.$i)->getCalculatedValue();

		/*echo '<tr>';
		echo '<td>'. $campo01.'</td>';
		echo '<td>'. $campo02.'</td>';
		echo '<td>'. $campo03.'</td>';
		echo '</tr>';*/

		$sql = "SELECT codemp,codestpro1,codestpro2,codestpro3,codestpro4,codestpro5,estcla FROM spg_temporal ".
		"WHERE codemp='".$campo01."' AND codestpro1='".$campo02."' AND codestpro2='".$campo04."' AND codestpro3='".$campo06."' AND ".
		" codestpro4='".$campo08."' AND codestpro5='".$campo10."' AND estcla='".$campo12."'";
		//echo $sql;die();
		$result = pg_query($conexion,$sql);
		$existe = pg_num_rows($result);
		if ($existe==0)
		{
			$sql = "INSERT INTO spg_temporal (codemp,codestpro1,denestpro1,codestpro2,denestpro2,codestpro3,denestpro3,codestpro4, ".
						 "denestpro4,codestpro5,denestpro5,estcla,spg_cuenta,denominacion,status,sc_cuenta,asignado,precomprometido, ".
						 "comprometido,causado,pagado,aumento,disminucion,distribuir,enero,febrero,marzo,abril,mayo,junio,julio,agosto, ".
						 "septiembre,octubre,noviembre,diciembre,nivel,referencia,scgctaint,sc_cuenta_art) ".
						 "VALUES('$campo01','$campo02','$campo03','$campo04','$campo05','$campo06','$campo07','$campo08','$campo09','$campo10',".
						 "'$campo11','$campo12','$campo13','$campo14','$campo15','$campo16',$campo17,$campo18,$campo19,$campo20,$campo21,$campo22,".
						 "$campo23,$campo24,$campo25,$campo26,$campo27,$campo28,$campo29,$campo30,$campo31,$campo32,$campo33,$campo34,$campo35,".
						 "$campo36,$campo37,'$campo38','$campo39','$campo40');";
 			$result = pg_query($conexion,$sql);
			echo 'Ingresando Estructura: '.$campo01.'-'.$campo02.'-'.$campo04.'-'.$campo06.'-'.$campo08.'-'.$campo10."<br />";
			$registros_ingresados=$registros_ingresados+1;
		}
		if ($existe==1)
		{
			$sql="UPDATE spg_temporal SET denestpro1='".$campo03."', denestpro2='".$campo05."' , denestpro3='".$campo07."',".
			 		 "denestpro4='".$campo09."', denestpro5='".$campo11."', spg_cuenta='".$campo13."', denominacion='".$campo14."',".
					 "status='".$campo15."',sc_cuenta='".$campo16."', asignado=$campo17, precomprometido=$campo18, comprometido=$campo19,".
					 "causado=$campo20,pagado=$campo21, aumento=$campo22, distribuir=$campo23, disminucion=$campo24, enero=$campo25, " .
			 	 	 "febrero=$campo26, marzo=$campo27, abril=$campo28, mayo=$campo29, junio=$campo30,julio=$campo31, agosto=$campo32,".
					 "septiembre=$campo33, octubre=$campo34, noviembre=$campo35, diciembre=$campo36,nivel=$campo37, referencia='".$campo38."',".
					 "scgctaint='".$campo39."', sc_cuenta_art='".$campo34."' ".
			 	 	 "WHERE codemp='".$campo01."' AND codestpro1='".$campo02."' AND codestpro2='".$campo04."' AND codestpro3='".$campo06."' AND ".
 			 		 "codestpro4='".$campo08."' AND codestpro5='".$campo10."' AND estcla='".$campo12."'";
			$result = pg_query($conexion,$sql);
			echo 'Modificando Estructura: '.$campo01.'-'.$campo02.'-'.$campo04.'-'.$campo06.'-'.$campo08.'-'.$campo10."<br />";
			$registros_modificados=$registros_modificados+1;
		}
	}

	//echo '<table>';
	echo ("<br />".'Total de registros insertados: '.$registros_ingresados."<br />".'Total registros modificados: '.$registros_modificados);
?>
