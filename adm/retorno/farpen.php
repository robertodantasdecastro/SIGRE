<?

if ($convenio == "1275763"){ // convenio do farpen

	
	$valorComp = fc ($valorComp);
	$valorFarpen = $valorComp + ($valorComp * (5/100));
	$valorFarpenFormat = number_format ($valorFarpen, 2, ",", ".");
	if ($idEntidade == "") {
		$distErro = $distErro + 1;
		//				echo "Guia de distribuição repedita, ------ VALOR: R$ ".$valorFarpenFormat;
	} else {  
		
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rsEntiConvenio1 = "SELECT id, convenio2, tipo FROM `entidades` WHERE convenio2 = '$conv' OR convenio = '$conv'";
		$rsEntiConvenio1 = mysql_query($query_rsEntiConvenio1, $Emolumentos) or die(mysql_error());
		$row_rsEntiConvenio1 = mysql_fetch_assoc($rsEntiConvenio1);
		$totalRows_rsEntiConvenio1 = mysql_num_rows($rsEntiConvenio1);
		
		if ($row_rsEntiConvenio1['tipo'] == 'SN') {  // se for serviço notarial FARPEN
			//gera o retorno do farpen do SN 
			$_SESSION['TotalFarpen'] = fc ($valorComp) + $_SESSION['TotalFarpen'];
			$nFemo = $nFemo + 1;
			if ($_SESSION['situacaoFarpen'] >= 4) { 

				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rs2viaCheck = "SELECT id_guia FROM guias2farpen WHERE guias2farpen.id_guia = '$idGuia' AND guias2farpen.linha_snr = '$n'";
				$rs2viaCheck = mysql_query($query_rs2viaCheck, $Emolumentos) or die(mysql_error());
				$row_rs2viaCheck = mysql_fetch_assoc($rs2viaCheck);
				$totalRows_rs2viaCheck = mysql_num_rows($rs2viaCheck);
				
				if ($totalRows_rs2viaCheck == 0) {
					
					$insertSQL = sprintf("INSERT INTO guias2farpen (id_guia, data_FARPEN_Emolumento, tarifaFARPEN_SNR, linha_snr) VALUES (%s, %s, %s, %s)",
						   GetSQLValueString($idGuia, "int"),
						   GetSQLValueString($d2, "date"),
						   GetSQLValueString($valorComp, "text"),
						   GetSQLValueString($n, "int"));
			
						  mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
					
					$_SESSION['logfim'] .= "SNR FARPEN - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d2."<BR>"; 
				} else {
				
					$_SESSION['logfim'] .= "SNR FARPEN - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d2."- NÃO ALTERADO -<BR>"; 
				
				}
			} else {
			
			
			$updateSQL = sprintf("UPDATE guias SET situacaoFarpen=%s, dataMovFarpen=%s, dataAtulizacao=%s, valorRetornoFARPEN=%s, tarifaRetornoFARPEN=%s, nomeArquivoFarpenSNR=%s, linhaFARPEN=%s WHERE id=%s",
			   GetSQLValueString("4", "int"),
			   GetSQLValueString($d2, "date"),
			   GetSQLValueString($d, "date"),
			   GetSQLValueString($valorComp, "text"),
			   GetSQLValueString($tarifa, "text"),
			   GetSQLValueString($_GET['arquivo'], "text"),
			   GetSQLValueString($n, "text"),
			   GetSQLValueString($idGuia, "int"));
		
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
			
			}
			
		} else if ($row_rsEntiConvenio1['tipo'] == "SDT") { // FARPEN SDJ

			if ($_SESSION['situacaoFARPEN_SDJ'] >= 4) { 

				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rs2viaCheck = "SELECT id_guia FROM guias2farpen WHERE guias2farpen.id_guia = '$idGuia' AND guias2farpen.linha_sdj = '$n'";
				$rs2viaCheck = mysql_query($query_rs2viaCheck, $Emolumentos) or die(mysql_error());
				$row_rs2viaCheck = mysql_fetch_assoc($rs2viaCheck);
				$totalRows_rs2viaCheck = mysql_num_rows($rs2viaCheck);
				
				if ($totalRows_rs2viaCheck == 0) {

					$insertSQL = sprintf("INSERT INTO guias2farpen (id_guia, data_FARPEN_SDJ, tarifaFARPEN_SDJ, linha_sdj) VALUES (%s, %s, %s, %s)",
						   GetSQLValueString($idGuia, "int"),
						   GetSQLValueString($d2, "date"),
						   GetSQLValueString($valorComp, "text"),
						   GetSQLValueString($n, "int"));
			
						  mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
					
					$_SESSION['logfim'] .= "SDJ FARPEN- PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d2."<BR>"; 	
				} else {
					$_SESSION['logfim'] .= "SDJ FARPEN- PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d2." - NAO ALTERADO - <BR>"; 	
				}						
			} else {
			$updateSQL = sprintf("UPDATE guias SET situacaoFARPEN_SDJ=%s, dataMovFARPEN_SDJ=%s, dataAtulizacao=%s, valorRetornoFARPEN_SDJ=%s, tarifaRetornoFARPEN_SDJ=%s, nomeArquivoFarpenSDJ=%s, linhaFARPEN_sdj=%s WHERE id=%s",
			   GetSQLValueString("4", "int"),
			   GetSQLValueString($d2, "date"),
			   GetSQLValueString($d, "date"),
			   GetSQLValueString($valorComp, "text"),
			   GetSQLValueString($tarifa, "text"),
			   GetSQLValueString($_GET['arquivo'], "text"),
			   GetSQLValueString($n, "text"),
			   GetSQLValueString($idGuia, "int"));
		
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
			}
//			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"#ECAAD5\"> atualizado guia de serviço notarial CONVENIO FARPEN SDJ id:".$idEntidade." <br>entidade: ".$row_rsEntiConvenio1['nome']."<br>id guia: ".$idGuia."</td>";
			$_SESSION['TotalFarpen'] = fc ($valorComp) + $_SESSION['TotalFarpen'];
			$nFdist = $nFdist + 1;
		} else { 
		//erro		
		}
	}	
	$linha = "1";
} 
			
			
?>