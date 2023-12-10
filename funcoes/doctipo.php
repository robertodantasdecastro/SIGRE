<?
//include('../../Connections/Emolumentos.php');
	
	function TipoDocumento ($tipo, $declarado, $TipoImovel, $id_natuEsc, $ndescricao, $tipoRegistro) {
	
		$doctipo = "";
		$doctipo = substr(strtoupper($tipo), 0, 3).". ";
		if ($doctipo == 'ESC. ') { 
			if ($declarado == 's') { 
				if ($TipoImovel != 'N/D') { 
					$doctipo .="COM VALOR (IMOBILIARIA)";
				} else {
					
					$doctipo .="COM VALOR (".formatarExportacao ($id_natuEsc, "up", "23", "").")";
				}
			} else {
				if (strtoupper($ndescricao) == "OUTRAS (SEM VALOR DECLARADO)") { 
					$doctipo .= "SEM VALOR (OUTRAS)";
				}else{
					$doctipo .= "SEM VALOR (".formatarExportacao ($ndescricao, "up", "23", "").")";
				}
			}
		
		} else if ($doctipo == 'REG. ') { 
			include('../../Connections/Emolumentos.php');
			$idTipoReg = $tipoRegistro;
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsTipoRegistro = "SELECT * FROM tiporegistro WHERE tiporegistro.id = '$idTipoReg'";
			$rsTipoRegistro = mysql_query($query_rsTipoRegistro, $Emolumentos) or die(mysql_error());
			$row_rsTipoRegistro = mysql_fetch_assoc($rsTipoRegistro);
			$totalRows_rsTipoRegistro = mysql_num_rows($rsTipoRegistro);
			
			if ($idTipoReg == 7 || $idTipoReg == 20) { 
				$doctipo .= "DE IMOVEL "; 
			} else { 
				$doctipo .= "DE IMOVEL "; 
			}
			
			$doctipo .= "(".formatarExportacao ($row_rsTipoRegistro['nome'], "up", "23", "").")";
		} 
		
		return $doctipo;
	}

		//   TipoDocumento ($row_rsGuias['tipo'], $row_rsGuias['declarado'], $row_rsGuias['TipoImovel'], $row_rsGuias['id_natuEsc'], $row_rsGuias['ndescricao'], $row_rsGuias['tipoRegistro']);
?>