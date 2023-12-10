<?

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntiConvenio2 = "SELECT id, convenio2 FROM `entidades` WHERE convenio2 = '$convenio'";
$rsEntiConvenio2 = mysql_query($query_rsEntiConvenio2, $Emolumentos) or die(mysql_error());
$row_rsEntiConvenio2 = mysql_fetch_assoc($rsEntiConvenio2);
$totalRows_rsEntiConvenio2 = mysql_num_rows($rsEntiConvenio2);

if ($totalRows_rsEntiConvenio2 >= "1") {

	if ($_SESSION['situacaoMovFarpen_emoCred'] >= 4) {
	
		$insertSQL = sprintf("INSERT INTO guias2Farpen_emo_cred (id_guia, data_FARPEN_Emo_Cred, linha) VALUES (%s, %s, %s)",
		   GetSQLValueString($idGuia, "int"),
		   GetSQLValueString($d2, "date"),
		   GetSQLValueString($n, "int"));
		   
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
		
		$_SESSION['logfim'] .= "SNR EMOLUMENTO - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d2."<BR>"; 

	} else {
	
		/// gera o valor do RETORNO DO FARPEN DA ENTIDADE 5%
		$updateSQL = sprintf("UPDATE guias SET dataMovFarpen_emoCred =%s, situacaoMovFarpen_emoCred=%s, dataAtulizacao=%s, valorRetornoFARPEN_emoCred=%s, tarifaRetornoFARPEN_emoCred=%s, nomeArquivo=%s, linhaFARPEN2=%s WHERE id=%s",
		   GetSQLValueString($d2, "date"),
		   GetSQLValueString(4, "int"),
		   GetSQLValueString($d, "date"),
		   GetSQLValueString($valorComp, "text"),
		   GetSQLValueString($tarifa, "text"),
		   GetSQLValueString($_GET['arquivo'], "text"),
		   GetSQLValueString($n, "text"),
		   GetSQLValueString($idGuia, "int"));
		
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
		
//				echo "<td align=\"left\" calss=\"texto\" bgcolor=\"#8080FF\"> Crédito retorno FARPEN id:".$idEntidade."<br>entidade: ".$row_rsEntiConvenio2['nome']."<td>";
	}
}
			
			?>