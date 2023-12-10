<?


$tarifaRetTJ   = $_SESSION['tarifaRetTJ'];
$convenioRetTJ = $_SESSION['convenioRetTJ'];
$tarifaSdjTJ   = $_SESSION['tarifaSdjTJ'];
$convenioSdjTJ = $_SESSION['convenioSdjTJ'];


if ($convenioRetTJ == 1276021) {

	if (!isset($d_) && $id_entiR != 26) {
		$d_ = $d2;
	}
				
	if (formatarNumero ($d2) != formatarNumero ($d_)) { // bug entidade 26 Vieira Batista
		if ($id_entiR == 26){ 
			echo $d2;
			$d3 = $d_;
			echo "-->".$d3."-->".$id_entiR."<br>";
		} else {
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsEntiErro = "SELECT entidades.id, entidades.nome, entidades.convenio, entidades.convenio2 FROM entidades WHERE entidades.id = '$id_entiR'";
			$rsEntiErro = mysql_query($query_rsEntiErro, $Emolumentos) or die(mysql_error());
			$row_rsEntiErro = mysql_fetch_assoc($rsEntiErro);
			$totalRows_rsEntiErro = mysql_num_rows($rsEntiErro);
		
			$_SESSION['erro_retorno'] .= "Ouve uma ocorrencia de \"Float\" diferente do padrão na entidade: ".$row_rsEntiErro['nome']."\nConvenios: ".$row_rsEntiErro['convenio']." e ".$row_rsEntiErro['convenio2']."\n"; 
			$d3 = $d2;
		}
		
	} else {
		$d3 = $d2;
	}
	$tarifaFEPJ = $tarifaRetTJ * 0.01;
	$tarifaFEPJ_Total = $tarifaFEPJ + $tarifaFEPJ_Total;
	
	if ($_SESSION['situacao_FEPJ_Emolumento'] >= 4){
	
	
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rs2viaCheck = "SELECT id_guia FROM guias2fepj WHERE guias2fepj.id_guia = '$idGuia' AND guias2fepj.linha_fepj_snr = '$n'";
		$rs2viaCheck = mysql_query($query_rs2viaCheck, $Emolumentos) or die(mysql_error());
		$row_rs2viaCheck = mysql_fetch_assoc($rs2viaCheck);
		$totalRows_rs2viaCheck = mysql_num_rows($rs2viaCheck);
		
		if ($totalRows_rs2viaCheck == 0) {
		
			$insertSQL = sprintf("INSERT INTO guias2fepj (id_guia, data_FEPJ_Emolumento, tarifaFEPJ_SNR, linha_fepj_snr) VALUES (%s, %s, %s, %s)",
			   GetSQLValueString($idGuia, "int"),
			   GetSQLValueString($d3, "date"),
			   GetSQLValueString($tarifaFEPJ, "text"),
			   GetSQLValueString($n, "int"));
	
			  mysql_select_db($database_Emolumentos, $Emolumentos);
			$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
			
			$_SESSION['logfim'] .= "SNR - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d3."<BR>";
			
		} else {
		
			$_SESSION['logfim'] .= "SNR - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d3." - NAO ALTERADO - <BR>";
		
		}
	}else{	
					
		
		$updateSQL = sprintf("UPDATE guias SET situacao_FEPJ_Emolumento=4, velorRetornoFEPJ=%s, dataRetornoFEPJ=%s, arquivoNomeFEPJ_SNR=%s WHERE id=%s",          
		   GetSQLValueString($tarifaFEPJ, "text"),
		   GetSQLValueString($d3, "date"),
		   GetSQLValueString($_GET['arquivo'], "text"),
		   GetSQLValueString($idGuia, "int"));
		
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
			
	$_SESSION['logfim'] .=  $idGuia." --> EMO   |   ".$d3."    |     ".$tarifaFEPJ."<br>";
	
	}
	
} else if ($convenioSdjTJ == 1276021) {
	$tarifaSdjFEPJ = $tarifaSdjTJ * 0.01;
	$tarifaSdjFEPJ_Total = $tarifaSdjFEPJ + $tarifaSdjFEPJ_Total; 
	
	if (!isset($d_) && $id_entiR != 26) {
		$d_ = $d2;
	}
				
	if (formatarNumero ($d2) != formatarNumero ($d_)) { // bug entidade 26 Vieira Batista
		if ($id_entiR == 26){ 
			echo $d2;
			$d3 = $d_;
			echo "-->".$d3."-->".$id_entiR."<br>";
		} else {
		
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsEntiErro = "SELECT entidades.id, entidades.nome, entidades.convenio, entidades.convenio2 FROM entidades WHERE entidades.id = '$id_entiR'";
			$rsEntiErro = mysql_query($query_rsEntiErro, $Emolumentos) or die(mysql_error());
			$row_rsEntiErro = mysql_fetch_assoc($rsEntiErro);
			$totalRows_rsEntiErro = mysql_num_rows($rsEntiErro);
		
			$_SESSION['erro_retorno'] .= "Ouve uma ocorrencia de \"Float\" diferente do padrão na entidade: ".$row_rsEntiErro['nome']."\nConvenios: ".$row_rsEntiErro['convenio']." e ".$row_rsEntiErro['convenio2']."\n"; 
			$d3 = $d2;
		}
	} else {
		$d3 = $d2;
	}
	
	if ($_SESSION['situacao_FEPJ_SDJ'] >= 4){
			
			
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rs2viaCheck = "SELECT id_guia FROM guias2fepj WHERE guias2fepj.id_guia = '$idGuia' AND guias2fepj.linha_fepj_sdj = '$n'";
		$rs2viaCheck = mysql_query($query_rs2viaCheck, $Emolumentos) or die(mysql_error());
		$row_rs2viaCheck = mysql_fetch_assoc($rs2viaCheck);
		$totalRows_rs2viaCheck = mysql_num_rows($rs2viaCheck);
		
		if ($totalRows_rs2viaCheck == 0) {
		
		
			$insertSQL = sprintf("INSERT INTO guias2fepj (id_guia, data_FEPJ_SDJ, tarifaFEPJ_SDJ, linha_fepj_sdj) VALUES (%s, %s, %s, %s)",
			   GetSQLValueString($idGuia, "int"),
			   GetSQLValueString($d2, "date"),
			   GetSQLValueString($tarifaSdjFEPJ, "text"),
			   GetSQLValueString($n, "int"));

			  mysql_select_db($database_Emolumentos, $Emolumentos);
			$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
			
			$_SESSION['logfim'] .= "SDJ - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d2."<BR>";
		
		} else {
		
			$_SESSION['logfim'] .= "SDJ - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d2." - NAO ALTERADO -<BR>";
		
		} 
	}else{
		
		$updateSQL = sprintf("UPDATE guias SET situacao_FEPJ_SDJ=%s , valorRetornoSdjFEPJ=%s, dataRetornoFEPJ_SDJ=%s, arquivoNomeFEPJ_SDJ=%s WHERE id=%s",          
		   GetSQLValueString('4', "int"),
		   GetSQLValueString($tarifaSdjFEPJ, "text"),
		   GetSQLValueString($d2, "date"),
		   GetSQLValueString($_GET['arquivo'], "text"),
		   GetSQLValueString($idGuia, "int"));
		
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
		
		$_SESSION['logfim'] .=  $idGuia." --> SDJ   |   ".$d2."    |     ".$tarifaSdjFEPJ." GRAVADO<br>";
	}
} else {
//echo "nao snr e sdj";
//	$_SESSION['erro_retorno'] .= "";
}

?>