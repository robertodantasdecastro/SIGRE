<?

	  function dataC ($var1, $var2) {
		
		
		$ano = substr($var1, 0, 4);
		$mes = substr($var1, 4, 2);
		$dia = substr($var1, 6, 2);
		//echo $dia.$mes.$ano."<br>";
		$res=checkdate($mes,$dia,$ano);
	
		if ($res==1) {
		
			$dias_do_mes = date ("t", mktime (0,0,0,$mes,$dia,$ano));
			$diaV = $dia+1; 
			
			if (date("w", mktime(0,0,0,$mes,$diaV,$ano)) == 6) { 
				$diaV = $diaV + 2; 
			} else if (date("w", mktime(0,0,0,$mes,$diaV,$ano)) == 0) { 
				$diaV = $diaV + 1; 
			}
			if ($diaV > $dias_do_mes) {
				$diaV = $diaV - $dias_do_mes;
				$mesV = $mes + 1;
				if ($mesV<10){ $mesV = "0".$mesV; }
			} else { 
				$mesV = $mes;
			}
			if ($mesV > 12){
				$mesV = "01";
				$anoV = $ano + 1;
			} else { 
				$anoV = $ano;
			}
			if ($diaV == 07 && $anoV == 2006 && $mesV == 09) { $diaV = 08; }
			if ($diaV<10){ $diaV = "0".$diaV; }
			
			if ($var2 == "aaaa-mm-dd"){ return $anoV."-".$mesV."-".$diaV; } else if ($var2 == "aaaammdd") { return $anoV.$mesV.$diaV; }
			if (!isset($var2)) return $anoV.$mesV.$diaV;
		
		} //while ((date("w", mktime(0,0,0,$mesV,$diaV,$anoV)) != 0) && (date("w", mktime(0,0,0,$mesV,$diaV,$anoV)) != 6));
		
	}

//echo dataC("20060930", "aaaa-mm-dd");
 
?>