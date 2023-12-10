<?

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntiConvenioSDT = "SELECT id, convenio, tipo FROM `entidades` WHERE convenio = '$convenio' AND tipo = 'SDT'";
$rsEntiConvenioSDT = mysql_query($query_rsEntiConvenioSDT, $Emolumentos) or die(mysql_error());
$row_rsEntiConvenioSDT = mysql_fetch_assoc($rsEntiConvenioSDT);
$totalRows_rsEntiConvenioSDT = mysql_num_rows($rsEntiConvenioSDT);


if ($totalRows_rsEntiConvenioSDT >= 1) { // EMOLUMENTO SDJ	
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
	if ($_SESSION['situacaoSDJ'] >= 4) { 
		
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rs2viaCheck = "SELECT id_guia FROM guias2sdj WHERE guias2sdj.id_guia = '$idGuia' AND guias2sdj.linha = '$n'";
		$rs2viaCheck = mysql_query($query_rs2viaCheck, $Emolumentos) or die(mysql_error());
		$row_rs2viaCheck = mysql_fetch_assoc($rs2viaCheck);
		$totalRows_rs2viaCheck = mysql_num_rows($rs2viaCheck);
		
		if ($totalRows_rs2viaCheck == 0) {
		
			$insertSQL = sprintf("INSERT INTO guias2sdj (id_guia, data_SDJ_Emolumento, tarifa_SDJ, linha) VALUES (%s, %s, %s, %s)",
						   GetSQLValueString($idGuia, "int"),
						   GetSQLValueString($d3, "date"),
						   GetSQLValueString($valorComp, "text"),
						   GetSQLValueString($n, "int"));
						   
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
		
			$_SESSION['logfim'] .= "SDJ EMOLUMENTO - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d3."<BR>"; 	
			
		} else {
					
		$_SESSION['logfim'] .= "SDJ EMOLUMENTO - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d3." - NAO ALTERADO -<BR>"; 	
		
		}
	} else {
	
		$updateSQL = sprintf("UPDATE guias SET situacaoSDJ=%s, dataMovSDJ=%s, dataAtulizacao=%s, valorRetornoSDJ=%s, tarifaRetornoSDJ=%s, nomeArquivoSDJ=%s, linhaSDJ=%s WHERE id=%s",
			   GetSQLValueString("4", "int"),
			   GetSQLValueString($d3, "date"),
			   GetSQLValueString($d, "date"),
			   GetSQLValueString($valorComp, "text"),
			   GetSQLValueString($tarifa, "text"),
			   GetSQLValueString($_GET['arquivo'], "text"),
			   GetSQLValueString($n, "text"),
			   GetSQLValueString($idGuia, "int"));
			
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
	}
}

?>