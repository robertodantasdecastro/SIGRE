<?


			
if (!isset($pag2SDJ["$d_sd"])) $pag2SDJ["$d_sd"] = "no";
	
if ($pag2SDJ["$d_sd"] != "ok" && ($d_SDJ >= $d_i && $d_SDJ <= $d_f)) {

	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsGuias2RetSDJ = "SELECT id_guia, data_FARPEN_SDJ, tarifaFARPEN_SDJ FROM guias2farpen WHERE guias2farpen.data_FARPEN_SDJ = '$d_sd'";
	$rsGuias2RetSDJ = mysql_query($query_rsGuias2RetSDJ, $Emolumentos) or die(mysql_error());
	$row_rsGuias2RetSDJ = mysql_fetch_assoc($rsGuias2RetSDJ);
	$totalRows_rsGuias2RetSDJ = mysql_num_rows($rsGuias2RetSDJ);		  
	
	if ($totalRows_rsGuias2RetSDJ > 0) {
		do {
		
			$idg = $row_rsGuias2RetSDJ['id_guia'];
			$query_rsGuias2via = "SELECT guias.emicao, guias.dataMovFARPEN_SDJ, guias.dataMovFarpen, guias.tipo, guias.idReg, guias.id, guias.id_entidade, guias.numero, guias.ano, guias.declarado, guias.tipoImovel, guias.id_natuEsc, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
	                 JOIN entidades ON entidades.id = guias.id_entidade
					 WHERE guias.id = '$idg'";
			
			$rsGuias2via = mysql_query($query_rsGuias2via, $Emolumentos) or die(mysql_error());
			$row_rsGuias2via = mysql_fetch_assoc($rsGuias2via);
			$totalRows_rsGuias2via = mysql_num_rows($rsGuias2via);
			
			$n = $n + 1; 
			$qtdFarpenSDJ = $qtdFarpenSDJ + 1;
			$vFarpenSDJ = fc ($row_rsGuias2via['valorRetornoFARPEN_SDJ']) + $vFarpenSDJ;
		  	
			
			if ($row_rsGuias2via['id_entidade'] < 10){ $id_entidade2 = "00".$row_rsGuias2via['id_entidade']; } else if ($row_rsGuias2via['id_entidade'] < 100) { $id_entidade2 = "0".$row_rsGuias2via['id_entidade']; } else if ($row_rsGuias2via['id_entidade'] < 1000) { $id_entidade2 = $row_rsGuias2via['id']; }

if ($row_rsGuias2via['numero'] < 10){ $numeros2 = "0000".$row_rsGuias2via['numero']; } else if ($row_rsGuias2via['numero'] < 100) { $numeros2 = "000".$row_rsGuias2via['numero']; } else if ($row_rsGuias2via['numero'] < 1000) { $numeros2 = "00".$row_rsGuias2via['numero']; } else if ($row_rsGuias2via['numero'] < 10000) { $numeros2 = "0".$row_rsGuias2via['numero']; } 
		
			
			$id_sdt = $row_rsGuias2via['id_sdt'];	
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsEntidadeSDT = "SELECT entidades.convenio, entidades.farpen FROM entidades WHERE entidades.id = '$id_sdt'";
			$rsEntidadeSDT = mysql_query($query_rsEntidadeSDT, $Emolumentos) or die(mysql_error());
			$row_rsEntidadeSDT = mysql_fetch_assoc($rsEntidadeSDT);
			$totalRows_rsEntidadeSDT = mysql_num_rows($rsEntidadeSDT);
		
			$farpenSDT = formatarNumero ($row_rsEntidadeSDT['farpen']);

			$vSDJ_FEPJ = $row_rsGuias2RetSDJ['tarifaFEPJ_SDJ'] * 100;
			
					
			$vFarpenSDT = formatarNumero ($row_rsGuias2via['valorRetornoFARPEN_SDJ']);
			$farpenSDT = formatarNumero ($row_rsEntidadeSDT['farpen']);

			$valorLinhaSDT['convenio'] = formatarExportacao ($row_rsEntidadeSDT['convenio'], "up", "7", "0");
			$valorLinhaSDT['numeroDocumento'] = $id_entidade.$anos.$numeros; 
			$valorLinhaSDT['farpen'] = formatarExportacao ($farpenSDT, "up", "7", "0");
			$valorLinhaSDT['emissao'] = substr($row_rsGuias2via['emicao'], 8, 2).substr($row_rsGuias2via['emicao'], 5, 2).substr($row_rsGuias2via['emicao'], 0, 4);
			$valorLinhaSDT['compencacao'] = substr($row_rsGuias2RetSDJ['data_FARPEN_SDJ'], 8, 2).substr($row_rsGuias2RetSDJ['data_FARPEN_SDJ'], 5, 2).substr($row_rsGuias2RetSDJ['data_FARPEN_SDJ'], 0, 4);
			$valorLinhaSDT['valor'] = formatarExportacao ($vFarpenSDT, "up", "8", "0");
			
			$linha2 = $valorLinhaSDT['convenio'].$valorLinhaSDT['numeroDocumento'].$valorLinhaSDT['farpen'].$valorLinhaSDT['emissao'].$valorLinhaSDT['compencacao'].$valorLinhaSDT['valor'];
			
//			echo "<tr><td class=\"texto\">".$linha2."</td></tr>";
			$fp2 = fopen($arquivo2, "a"); 
			fwrite($fp2, $linha2."\r\n"); 
			fclose($fp2); 	
		} while ($row_rsGuias2RetSDJ = mysql_fetch_assoc($rsGuias2RetSDJ));	
	}
	$pag2SDJ["$d_sd"] = "ok";
}	


if (!isset($pag2SNR["$d_fe"])) $pag2SNR["$d_fe"] = "no";

if ($pag2SNR["$d_fe"] != "ok" && ($d_SNR >= $d_i && $d_SNR <= $d_f)) {

	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsGuias2RetSNR = "SELECT id_guia, data_FARPEN_Emolumento, tarifaFARPEN_SNR FROM guias2farpen WHERE data_FARPEN_Emolumento = '$d_fe'";
	$rsGuias2RetSNR = mysql_query($query_rsGuias2RetSNR, $Emolumentos) or die(mysql_error());
	$row_rsGuias2RetSNR = mysql_fetch_assoc($rsGuias2RetSNR);
	$totalRows_rsGuias2RetSNR = mysql_num_rows($rsGuias2RetSNR);
	if ($totalRows_rsGuias2RetSNR > 0) {
//	echo $totalRows_rsGuias2RetSNR; 

		do {
//echo $d_fe;			
			$idg = $row_rsGuias2RetSNR['id_guia'];
			
			$query_rsGuias2via = "SELECT guias.emicao, guias.dataMovFARPEN_SDJ, guias.dataMovFarpen, guias.tipo, guias.idReg, guias.id, guias.id_entidade, guias.numero, guias.ano, guias.declarado, guias.tipoImovel, guias.id_natuEsc, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
				                 JOIN entidades ON entidades.id = guias.id_entidade
								 WHERE guias.id = '$idg'";
			
			$rsGuias2via = mysql_query($query_rsGuias2via, $Emolumentos) or die(mysql_error());
			$row_rsGuias2via = mysql_fetch_assoc($rsGuias2via);
			$totalRows_rsGuias2via = mysql_num_rows($rsGuias2via);
			
			if ($row_rsGuias2via['id_entidade'] < 10){ $id_entidade2 = "00".$row_rsGuias2via['id_entidade']; } else if ($row_rsGuias2via['id_entidade'] < 100) { $id_entidade2 = "0".$row_rsGuias2via['id_entidade']; } else if ($row_rsGuias2via['id_entidade'] < 1000) { $id_entidade2 = $row_rsGuias2via['id_entidade']; }

if ($row_rsGuias2via['numero'] < 10){ $numeros2 = "0000".$row_rsGuias2via['numero']; } else if ($row_rsGuias2via['numero'] < 100) { $numeros2 = "000".$row_rsGuias2via['numero']; } else if ($row_rsGuias2via['numero'] < 1000) { $numeros2 = "00".$row_rsGuias2via['numero']; } else if ($row_rsGuias2via['numero'] < 10000) { $numeros2 = "0".$row_rsGuias2via['numero']; } 

			if ($row_rsGuias2via['tipo'] == "Registro") { 
			
				$id_reg = $row_rsGuias2via['idReg'];
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsEntidadeREGISTRAL = "SELECT entidades.convenio2, entidades.farpen FROM entidades WHERE entidades.id = '$id_reg'";
				$rsEntidadeREGISTRAL = mysql_query($query_rsEntidadeREGISTRAL, $Emolumentos) or die(mysql_error());
				$row_rsEntidadeREGISTRAL = mysql_fetch_assoc($rsEntidadeREGISTRAL);
				$totalRows_rsEntidadeREGISTRAL = mysql_num_rows($rsEntidadeREGISTRAL);
				
				$numeroFarpen = formatarNumero ($row_rsEntidadeREGISTRAL['farpen']);
				$valorLinha['convenio'] = formatarExportacao ($row_rsEntidadeREGISTRAL['convenio2'], "up", "7", "0");
				
				
			} else {
			
				$numeroFarpen = formatarNumero ($row_rsGuias2via['farpen']);
				$valorLinha['convenio'] = formatarExportacao ($row_rsGuias2via['convenio2'], "up", "7", "0");
			
			}
			
			
			$n = $n + 1; 
			$qtdFarpen = $qtdFarpen + 1;
			$vFarpenEmo = fc ($row_rsGuias2via['valorRetornoFARPEN']) + $vFarpenEmo;
						
			
			$vFarpen = formatarNumero ($row_rsGuias2via['valorRetornoFARPEN']);
			

			
			$valorLinha['numeroDocumento'] = $id_entidade.$anos.$numeros; 
			$valorLinha['farpen'] = formatarExportacao ($numeroFarpen, "up", "7", "0");
			$valorLinha['emissao'] = substr($row_rsGuias2via['emicao'], 8, 2).substr($row_rsGuias2via['emicao'], 5, 2).substr($row_rsGuias2via['emicao'], 0, 4);
			$valorLinha['compencacao'] = substr($row_rsGuias2RetSNR['data_FARPEN_Emolumento'], 8, 2).substr($row_rsGuias2RetSNR['data_FARPEN_Emolumento'], 5, 2).substr($row_rsGuias2RetSNR['data_FARPEN_Emolumento'], 0, 4);
			$valorLinha['valor'] = formatarExportacao ($vFarpen, "up", "8", "0");
			
			$linha = $valorLinha['convenio'].$valorLinha['numeroDocumento'].$valorLinha['farpen'].$valorLinha['emissao'].$valorLinha['compencacao'].$valorLinha['valor'];
//			echo "<tr><td class=\"texto\">".$linha."</td></tr>";
			$fp2 = fopen($arquivo2, "a"); 
			fwrite($fp2, $linha."\r\n"); 
			fclose($fp2);		
			
			
		} while ($row_rsGuias2RetSNR = mysql_fetch_assoc($rsGuias2RetSNR));	
	}
	$pag2SNR["$d_fe"] = "ok";
}


?>