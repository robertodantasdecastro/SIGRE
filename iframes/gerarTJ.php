<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
	//if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
}else {

if ($mes < 10) { $mes = "0".$mes; }
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

function fc ($v) {
		if (strpos($v,",") > 0){
			$v = str_replace(".","",$v);
			$v = str_replace(",",".",$v);
			return $v;
		}
		return $v;
	}
	
function formatarExportacao($var, $m, $tam, $branco)	{
//	$tam = '20';
	$sizeName = strlen($var);	
	$a="1234567890ÁáÉéÍíÓóÚúÇçÃãÀàÂâÊêÎîÔôÕõÛûü& !#$%¨&*_+}=}{[]^~?:;><'´`";
	$b="1234567890AAEEIIOOUUCCAAAAAAEEIIOOOOUUUE _________________________";
	$var = strtr($var,$a,$b);
	if ($sizeName>$tam)	{ 
         $var = substr($var,0,$tam); 
	} else {
	
		for ($i = $sizeName; $i < $tam ; $i++) {
		$var = "$branco".$var;	
		}
	
	}
	if (isset($m) && $m == "up") { 
		$var = strtoupper($var);
	}
	if (isset($m) && $m == "down") { 
		$var = strtolower($var);
	}
	return $var;
}
function formatarExportacao2($var, $m, $tam, $branco)	{
//	$tam = '20';
	$sizeName = strlen($var);	
	$a="1234567890ÁáÉéÍíÓóÚúÇçÃãÀàÂâÊêÎîÔôÕõÛûü& !#$%¨&*_+}=}{[]^~?:;><'´`";
	$b="1234567890AAEEIIOOUUCCAAAAAAEEIIOOOOUUUE _________________________";
	$var = strtr($var,$a,$b);
	if ($sizeName>$tam)	{ 
         $var = substr($var,0,$tam); 
	} else {
	
		for ($i = $sizeName; $i < $tam ; $i++) {
		$var = $var."$branco";
		}
	
	}
	if (isset($m) && $m == "up") { 
		$var = strtoupper($var);
	}
	if (isset($m) && $m == "down") { 
		$var = strtolower($var);
	}
	return $var;
}
function formatarNumero ($var) { 
	$var = str_replace(".","",$var);
	$var = ereg_replace("0","0",$var); 
	$var = ereg_replace("/","",$var); 
	$var = ereg_replace("-","",$var); 
	$var = ereg_replace("\.","",$var); 
	$var = ereg_replace(",","",$var); 
	return $var;

}

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsGuia = "SELECT guias.*, entidades.farpen, entidades.convenio2, entidades.convenio, entidades.id_sdt, date_format(guias.`dataMovFarpen`, '%d%m%Y') as dataMovFarpen, date_format(guias.`emicao`, '%d%m%Y') as emicao FROM entidades, guias WHERE entidades.id = guias.id_entidade AND guias.situacaoFarpen = '4'";
$rsGuia = mysql_query($query_rsGuia, $Emolumentos) or die(mysql_error());
$row_rsGuia = mysql_fetch_assoc($rsGuia);
$totalRows_rsGuia = mysql_num_rows($rsGuia);
$vFEPJ = formatarNumero ($row_rsGuia['valorRetornoFARPEN_SDJ']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arquivo de retorno</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="../estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="710" border="0" cellspacing="0" cellpadding="0">
  <? if ($totalRows_rsGuia > 1){ 
  		
		do {  ?><tr>
    <td class="texto"><? 
		
	
	if ($row_rsGuia['id_entidade'] < 10){ $id_entidade = "00".$row_rsGuia['id_entidade']; } else if ($row_rsGuia['id_entidade'] < 100) { $id_entidade = "0".$row_rsGuia['id_entidade']; } else if ($row_rsGuia['id_entidade'] < 1000) { $id_entidade = $row_rsGuia['id_entidade']; }
	if ($row_rsGuia['numero'] < 10){ $numeros = "0000".$row_rsGuia['numero']; } else if ($row_rsGuia['numero'] < 100) { $numeros = "000".$row_rsGuia['numero']; } else if ($row_rsGuia['numero'] < 1000) { $numeros = "00".$row_rsGuia['numero']; } else if ($row_rsGuia['numero'] < 10000) { $numeros = "0".$row_rsGuia['numero']; } 
	$anos = substr($row_rsGuia['ano'], 2, 2);
	
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	
/*	if ($row_rsGuia['tipo'] == "Escritura") { 
		if ($row_rsGuia['declarado'] == 's') {
		
			$query_rsFarpen = "SELECT * FROM `farpen` WHERE id = '1'";
			
		} else {
		
			$query_rsFarpen = "SELECT * FROM `farpen` WHERE id = '2'";
			
		}
		
	} else if ($row_rsGuia['tipo'] == "Registro") { 
	
		if ($row_rsGuia['tipoRegistro'] == "7" || $row_rsGuia['tipoRegistro'] == "18" || $row_rsGuia['tipoRegistro'] == "20") { // farpen valor nao declarado
				
			$query_rsFarpen = "SELECT * FROM `farpen` WHERE id = '3'";
				
		} else if ($row_rsGuia['tipoRegistro'] == "1" || $row_rsGuia['tipoRegistro'] == "14" || $row_rsGuia['tipoRegistro'] == "15" || $row_rsGuia['tipoRegistro'] == "5" || $row_rsGuia['tipoRegistro'] == "8" || $row_rsGuia['tipoRegistro'] == "10") { // farpen com valor declarado
		
			$query_rsFarpen = "SELECT * FROM `farpen` WHERE id = '4'";
			
		} else if ($row_rsGuia['tipoRegistro'] == "2" || $row_rsGuia['tipoRegistro'] == "3" || $row_rsGuia['tipoRegistro'] == "17" || $row_rsGuia['tipoRegistro'] == "4" || $row_rsGuia['tipoRegistro'] == "6" || $row_rsGuia['tipoRegistro'] == "16" || $row_rsGuia['tipoRegistro'] == "9" || $row_rsGuia['tipoRegistro'] == "19" || $row_rsGuia['tipoRegistro'] == "21") { // farpen averbacao com valor declarado
				
			$query_rsFarpen = "SELECT * FROM `farpen` WHERE id = '6'";
			
		}
	}
	
	$rsFarpen = mysql_query($query_rsFarpen, $Emolumentos) or die(mysql_error());
	$row_rsFarpen = mysql_fetch_assoc($rsFarpen);
	$totalRows_rsFarpen = mysql_num_rows($rsFarpen); */
	
	if ($row_rsGuia['tipo'] == 'Escritura') {
		$id_sdt = $row_rsGuia['id_sdt'];
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rsEntidadeSDT = "SELECT entidades.convenio, entidades.farpen FROM entidades WHERE entidades.id_sdt = '$id_sdt'";
		$rsEntidadeSDT = mysql_query($query_rsEntidadeSDT, $Emolumentos) or die(mysql_error());
		$row_rsEntidadeSDT = mysql_fetch_assoc($rsEntidadeSDT);
		$totalRows_rsEntidadeSDT = mysql_num_rows($rsEntidadeSDT);
		
		
		$vFarpenSDT = formatarNumero ($row_rsGuia['valorRetornoFARPEN_SDJ']);
		$farpenSDT = formatarNumero ($row_rsEntidadeSDT['farpen']);
		
		$vFEPJ_SDT = fc ($row_rsEntidadeSDT['farpen']) * 0.03;
		
		$valorLinhaSDT['convenio'] = formatarExportacao ($row_rsEntidadeSDT['convenio'], "up", "7", "0");
		$valorLinhaSDT['numeroDocumento'] = $id_entidade.$anos.$numeros; 
		$valorLinhaSDT['farpen'] = formatarExportacao ($farpenSDT, "up", "7", "0");
		$valorLinhaSDT['emissao'] = $row_rsGuia['emicao'];
		$valorLinhaSDT['compencacao'] = $row_rsGuia['dataMovFarpen'];
		$valorLinhaSDT['valor'] = formatarExportacao ($vFarpenSDT, "up", "8", "0");
		$valorLinhaSDT['valorFEPJ'] = formatarExportacao ($vFEPJ_SDT, "up", "8", "0");
		$linha2 = $valorLinhaSDT['convenio'].$valorLinhaSDT['numeroDocumento'].$valorLinhaSDT['farpen'].$valorLinhaSDT['emissao'].$valorLinhaSDT['compencacao'].$valorLinhaSDT['valor'].$valorLinhaSDT['valorFEPJ']."\r\n";
		
	} else {
		
		$linha2 = '';
		
	}
	
	
	

	$vFarpen = formatarNumero ($row_rsGuia['valorRetornoFARPEN']);

	
	$numeroFarpen = formatarNumero ($row_rsGuia['farpen']);
	

	
	$valorLinha['convenio'] = formatarExportacao ($row_rsGuia['convenio2'], "up", "7", "0");
	$valorLinha['numeroDocumento'] = $id_entidade.$anos.$numeros; 
	$valorLinha['farpen'] = formatarExportacao ($numeroFarpen, "up", "7", "0");
	$valorLinha['emissao'] = $row_rsGuia['emicao'];
	$valorLinha['compencacao'] = $row_rsGuia['dataMovFarpen'];
	$valorLinha['valor'] = formatarExportacao ($vFarpen, "up", "8", "0");
	$valorLinha['valorFEPJ'] = formatarExportacao ($vFEPJ, "up", "8", "0");
	
	echo $valorLinha['convenio'].$valorLinha['numeroDocumento'].$valorLinha['farpen'].$valorLinha['emissao'].$valorLinha['compencacao'].$valorLinha['valor'].$valorLinha['valorFEPJ']."<BR>";
	$linha = $linha2.$valorLinha['convenio'].$valorLinha['numeroDocumento'].$valorLinha['farpen'].$valorLinha['emissao'].$valorLinha['compencacao'].$valorLinha['valor'].$valorLinha['valorFEPJ'];
	$arquivo2 = "../../dados/tj/".$dia."_".$mes."_".$ano.".txt";
	$fp2 = fopen($arquivo2, "a"); 
	fwrite($fp2, $linha."\r\n"); 
	fclose($fp2); 	
	
	
	if ($row_rsGuia['tipo'] == "Escritura") { 
	
		// farpen distribuidor
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rsFarpenDist = "SELECT * FROM `farpen` WHERE id = '5'";
		$rsFarpenDist = mysql_query($query_rsFarpenDist, $Emolumentos) or die(mysql_error());
		$row_rsFarpenDist = mysql_fetch_assoc($rsFarpenDist);
		$totalRows_rsFarpenDist = mysql_num_rows($rsFarpenDist);
	
		$valorFARPEN = fc ($row_rsFarpenDist['valor']);
		$valorFARPEN = $valorFARPEN * (95 / 100);
		$vFarpen = formatarNumero ($valorFARPEN);
	
		$id_sdt = $row_rsGuia['id_sdt'];
	
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rsConvenioDistribuidor = "SELECT entidades.convenio, entidades.farpen FROM entidades WHERE entidades.id = '$id_sdt'";
		$rsConvenioDistribuidor = mysql_query($query_rsConvenioDistribuidor, $Emolumentos) or die(mysql_error());
		$row_rsConvenioDistribuidor = mysql_fetch_assoc($rsConvenioDistribuidor);
		$totalRows_rsConvenioDistribuidor = mysql_num_rows($rsConvenioDistribuidor);
	
		$numeroFarpen = formatarNumero ($row_rsConvenioDistribuidor['farpen']);

		$valorLinha['convenio'] = formatarExportacao ($row_rsConvenioDistribuidor['convenio'], "up", "7", "0");
		$valorLinha['farpen'] = formatarExportacao ($numeroFarpen, "up", "7", "0");

		
		// fim farpen distribuidor
		
		$valorLinha['valor'] = formatarExportacao ($vFarpen, "up", "8", "0");
		$valorLinha['valorFEPJ'] = formatarExportacao ($vFEPJ, "up", "8", "0");
		
		
		echo $valorLinha['convenio'].$valorLinha['numeroDocumento'].$valorLinha['farpen'].$valorLinha['emissao'].$valorLinha['compencacao'].$valorLinha['valor']."<BR>";
		$linha = $valorLinha['convenio'].$valorLinha['numeroDocumento'].$valorLinha['farpen'].$valorLinha['emissao'].$valorLinha['compencacao'].$valorLinha['valor'].$valorLinha['valorFEPJ'];
		$arquivo2 = "../../dados/tj/".$dia."_".$mes."_".$ano.".txt";
		$fp2 = fopen($arquivo2, "a"); 
		fwrite($fp2, $linha."\r\n"); 
		fclose($fp2); 	
	
	
	}
	
	$id_guia = $row_rsGuia['id'];
	
/*	$updateSQL = sprintf("UPDATE guias SET situacaoFarpen=%s WHERE id=%s",
					   GetSQLValueString("5", "int"),
					   GetSQLValueString($id_guia, "int"));
					
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
	*/
	
	unset ($valorLinha);
	unset ($valorLinhaSDT);
	/*<iframe frameborder="0" height="1" id="salvar" scrolling="no" width="1" src="salvarArquivo.php?arquivo=<? echo "farpen".$dia."_".$mes."_".$ano.".txt"; ?>"></iframe>*/ 
	
	
	

	?></td>
  </tr><? } while ($row_rsGuia = mysql_fetch_assoc($rsGuia)); 
  ?><iframe frameborder="0" height="1" id="salvar" scrolling="no" width="1" src="salvarArquivo.php?arquivo=<? echo $dia."_".$mes."_".$ano.".txt"; ?>&onde=tj"></iframe><?
	echo $totalRows_rsGuia;

  } else {?>
  <tr>
  	<td height="200" align="center" class="Erro1">N&atilde;o existem arquivos a serem gerados. </td>
  </tr><? } ?>
</table>
</body>
</html>
<? } ?>