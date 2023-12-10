<?


			
if (!isset($pag2SDJ["$d_sd"])) $pag2SDJ["$d_sd"] = "no";
	
if ($pag2SDJ["$d_sd"] != "ok" && ($d_SDJ >= $d_i && $d_SDJ <= $d_f)) {

	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsGuias2RetSDJ = "SELECT id_guia, tarifaFEPJ_SDJ FROM guias2fepj WHERE guias2fepj.data_FEPJ_SDJ = '$d_sd'";
	$rsGuias2RetSDJ = mysql_query($query_rsGuias2RetSDJ, $Emolumentos) or die(mysql_error());
	$row_rsGuias2RetSDJ = mysql_fetch_assoc($rsGuias2RetSDJ);
	$totalRows_rsGuias2RetSDJ = mysql_num_rows($rsGuias2RetSDJ);		  
	
	if ($totalRows_rsGuias2RetSDJ > 0) {
		do {
		
			$idg = $row_rsGuias2RetSDJ['id_guia'];
			$query_rsGuias2via = "SELECT guias.dataRetornoFEPJ_SDJ, guias.tipo, guias.idReg, guias.velorRetornoFEPJ, guias.id, guias.id_entidade, guias.valorRetornoSdjFEPJ, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
				 JOIN entidades ON entidades.id = guias.id_entidade 
				 WHERE guias.id = '$idg'";
			
			$rsGuias2via = mysql_query($query_rsGuias2via, $Emolumentos) or die(mysql_error());
			$row_rsGuias2via = mysql_fetch_assoc($rsGuias2via);
			$totalRows_rsGuias2via = mysql_num_rows($rsGuias2via);
			
			$qtdSdj = $qtdSdj + 1;
		  
			$id_ent = $row_rsGuias2via['id_sdt'];	
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsConveniosSN = "SELECT entidades.id, entidades.farpen, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_ent'";
			$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
			$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
			$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
		
			$vSDJ_FEPJ = $row_rsGuias2RetSDJ['tarifaFEPJ_SDJ']; 
			$id_SDT = $row_rsConveniosSN['farpen'];
	
			if (!isset($entidade_FEPJ["$id_SDT"])) {
				$entidade_FEPJ["$id_SDT"] = 0;	
				$qtd_FEPJ["$id_SDT"] = 0;
				$qtd_FEPJ["$id_SDT"] = $qtd_FEPJ["$id_SDT"] + 1;
				$entidade_FEPJ["$id_SDT"] = $entidade_FEPJ["$id_SDT"] + $vSDJ_FEPJ;
			} else {
				$qtd_FEPJ["$id_SDT"] = $qtd_FEPJ["$id_SDT"] + 1;
				$entidade_FEPJ["$id_SDT"] = $entidade_FEPJ["$id_SDT"] + $vSDJ_FEPJ;
			}
			
			echo "SDJ - Guia pag dub: ".$row_rsGuias2RetSDJ['id_guia']." Tarifa = R$".$vSDJ_FEPJ."<br>";
		} while ($row_rsGuias2RetSDJ = mysql_fetch_assoc($rsGuias2RetSDJ));	
	}
	$pag2SDJ["$d_sd"] = "ok";
}	


if (!isset($pag2SNR["$d_fe"])) $pag2SNR["$d_fe"] = "no";

if ($pag2SNR["$d_fe"] != "ok" && ($d_SNR >= $d_i && $d_SNR <= $d_f)) {

	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsGuias2RetSNR = "SELECT id_guia, tarifaFEPJ_SNR FROM guias2fepj WHERE guias2fepj.data_FEPJ_Emolumento = '$d_fe'";
	$rsGuias2RetSNR = mysql_query($query_rsGuias2RetSNR, $Emolumentos) or die(mysql_error());
	$row_rsGuias2RetSNR = mysql_fetch_assoc($rsGuias2RetSNR);
	$totalRows_rsGuias2RetSNR = mysql_num_rows($rsGuias2RetSNR);
	if ($totalRows_rsGuias2RetSNR > 0) {
//	echo $totalRows_rsGuias2RetSNR; 

		do {
//echo $d_fe;			
			$idg = $row_rsGuias2RetSNR['id_guia'];
			
			$query_rsGuias2via = "SELECT guias.dataRetornoFEPJ, guias.tipo, guias.idReg, guias.id, guias.id_entidade, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
				 JOIN entidades ON entidades.id = guias.id_entidade 
				 WHERE guias.id = '$idg'";
			
			$rsGuias2via = mysql_query($query_rsGuias2via, $Emolumentos) or die(mysql_error());
			$row_rsGuias2via = mysql_fetch_assoc($rsGuias2via);
			$totalRows_rsGuias2via = mysql_num_rows($rsGuias2via);
			
			
			if ($row_rsGuias2via['tipo'] == "Registro") { 
							
				
				$id_ent = $row_rsGuias2via['idReg'];
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsConveniosSN = "SELECT entidades.id, entidades.farpen, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_ent'";
				$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
				$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
				$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
				$id_entidade = $row_rsConveniosSN['farpen'];
				$qtdReg = $qtdReg + 1;
				
			} else {
				$qtdEsc = $qtdEsc + 1;
				$id_entidade = $row_rsGuias2via['farpen'];	
			}
			$vF = $row_rsGuias2RetSNR['tarifaFEPJ_SNR'];
			if (!isset($entidade_FEPJ["$id_entidade"])) {
				$entidade_FEPJ["$id_entidade"] = 0;	
				$qtd_FEPJ["$id_entidade"] = 0;
				$qtd_FEPJ["$id_entidade"] = $qtd_FEPJ["$id_entidade"] + 1;
				$entidade_FEPJ["$id_entidade"] = $entidade_FEPJ["$id_entidade"] + $vF;
			} else {
				$qtd_FEPJ["$id_entidade"] = $qtd_FEPJ["$id_entidade"] + 1;
				$entidade_FEPJ["$id_entidade"] = $entidade_FEPJ["$id_entidade"] + $vF;
			}
			echo "SNR - Guia pag dub: ".$row_rsGuias2RetSNR['id_guia']." Tarifa = R$".$vF."<br>";
		} while ($row_rsGuias2RetSNR = mysql_fetch_assoc($rsGuias2RetSNR));	
	}
	$pag2SNR["$d_fe"] = "ok";
}


?>