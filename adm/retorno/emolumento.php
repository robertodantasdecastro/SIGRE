<?

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntiConvenio1 = "SELECT id, convenio, tipo FROM `entidades` WHERE convenio = '$convenio' && tipo = 'SN'";
$rsEntiConvenio1 = mysql_query($query_rsEntiConvenio1, $Emolumentos) or die(mysql_error());
$row_rsEntiConvenio1 = mysql_fetch_assoc($rsEntiConvenio1);
$totalRows_rsEntiConvenio1 = mysql_num_rows($rsEntiConvenio1);
		
if ($totalRows_rsEntiConvenio1 >= 1) {
	if ($valorComp > 0 && $valorComp != "") { // EMOLUMENTO SN
	 //gera o valor de retorno do emolumento do SN

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
//		echo $d3."<br>";
	if (formatarNumero ($d2) == 20060907) $d3 = "2006-09-08";
	
		if ($_SESSION['situacaoEmolumento'] >= 4) { 

			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rs2viaCheck = "SELECT id_guia FROM guias2snr WHERE guias2snr.id_guia = '$idGuia' AND guias2snr.linha_snr = '$n'";
			$rs2viaCheck = mysql_query($query_rs2viaCheck, $Emolumentos) or die(mysql_error());
			$row_rs2viaCheck = mysql_fetch_assoc($rs2viaCheck);
			$totalRows_rs2viaCheck = mysql_num_rows($rs2viaCheck);
			
			if ($totalRows_rs2viaCheck == 0) {
			
			
				$insertSQL = sprintf("INSERT INTO guias2snr (id_guia, data_SNR_Emolumento, tarifa_SNR, linha_snr) VALUES (%s, %s, %s, %s)",
					   GetSQLValueString($idGuia, "int"),
					   GetSQLValueString($d3, "date"),
					   GetSQLValueString($valorComp, "text"),
					   GetSQLValueString($n, "int"));
		
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
			
				$_SESSION['logfim'] .= "SNR EMOLUMENTO - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d2."---> Valor: R$".$valorComp."<BR>"; 
				
			} else {
			
				$_SESSION['logfim'] .= "SNR EMOLUMENTO - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d2."---> Valor: R$".$valorComp."<BR>"; 
			
			}
				
				
			} else {

		$updateSQL = sprintf("UPDATE guias SET situacaoEmolumento=%s, dataMovEmolumento=%s, dataAtulizacao=%s, valorRetornoEmo=%s, tarifaRetornoEmo=%s, nomeArquivo=%s, linhaEmo=%s WHERE id=%s",          
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
//					echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FFFFFF\"> atualizado guia de serviço notarial id:".$idEntidade."<br>entidade: ".$row_rsEntiConvenio1['nome']."<td>";			
	} else {
//					echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FF0000\"> NAO ATUALIZOU serviço notarial id:".$idEntidade."<br>entidade: ".$row_rsEntiConvenio1['nome']."<td>";			
	}
}

?>