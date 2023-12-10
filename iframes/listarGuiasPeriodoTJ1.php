<?php

require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 

} else {

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
function formatarNumero ($var) { 
		$var = str_replace(".","",$var);
		$var = ereg_replace("0","0",$var); 
		$var = ereg_replace("/","",$var); 
		$var = ereg_replace("-","",$var); 
		$var = ereg_replace("\.","",$var); 
		$var = ereg_replace(",","",$var); 
		return $var;
	
	}  
function fc ($v) {
		if (strpos($v,",") > 0){
			$v = str_replace(".","",$v);
			$v = str_replace(",",".",$v);
			return $v;
		}
		return $v;
	}
$qtd = 0;
$vTotal = 0;
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if (isset($_SESSION['di']) && isset($_SESSION['df'])) {

$di_F = substr($_SESSION['di'], 6, 4).substr($_SESSION['di'], 3, 2).substr($_SESSION['di'], 0, 2);
$df_F = substr($_SESSION['df'], 6, 4).substr($_SESSION['df'], 3, 2).substr($_SESSION['df'], 0, 2);
if ($di_F < 20060901) { $di_f = 20060901; $_SESSION['di'] = "01/09/2006"; }


mysql_select_db($database_Emolumentos, $Emolumentos);
$v2 = "";
$query_rsGuias = "SELECT '1' `ID_LINHA`, guias.*, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
	                 JOIN entidades ON guias.id_entidade = entidades.id
					WHERE guias.situacaoEmolumento >= '4' 
					AND (guias.tipo = 'Registro')
					UNION
					SELECT '2', guias.*, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
					JOIN entidades ON guias.id_entidade = entidades.id
					WHERE guias.situacaoSDJ >= '4'
					UNION
					SELECT '3', guias.*, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
					JOIN entidades ON guias.id_entidade = entidades.id
					WHERE guias.situacaoEmolumento >= '4' 
					AND (guias.tipo <> 'Registro')";



$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
$row_rsGuias = mysql_fetch_assoc($rsGuias);
$totalRows_rsGuias = mysql_num_rows($rsGuias);
 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Periodo</title>
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
<? if ($totalRows_rsGuias > 0 && $df_F >= 20060901) { ?>
<table width="729" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="dce0e9">
		<table width="100%" border="0" cellpadding="0" cellspacing="1">
		<? 
		$qtdReg = 0;
		$qtdEsc = 0;
		$qtdSdj = 0;
		
		if ($mes < 10) $mes = "0".$mes;
		if ($dia < 10) $dia = "0".$dia;
		$dataHoje = $ano.$mes.$dia;
		$d_i = formatarNumero ($di_F);
		$d_f = formatarNumero ($df_F);
		
	do { 
	
		
		
		
		$d_SDJ = formatarNumero ($row_rsGuias['dataMovSDJ']);
		$d_SNR = formatarNumero ($row_rsGuias['dataRetornoFEPJ']);
		$d_sd = $row_rsGuias['dataMovSDJ'];
		$d_fe = $row_rsGuias['dataRetornoFEPJ'];
		
		
		
		if (($row_rsGuias['ID_LINHA'] == 1 || $row_rsGuias['ID_LINHA'] == 3) && ($d_SNR >= $d_i && $d_SNR <= $d_f)) {
			
			$idGuia = $row_rsGuias['id'];
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsGuias2Ret = "SELECT * FROM guias2 WHERE guias2.id_guia = '$idGuia' AND dataRetornoFEPJ = '$d_fe'";
			$rsGuias2Ret = mysql_query($query_rsGuias2Ret, $Emolumentos) or die(mysql_error());
			$row_rsGuias2Ret = mysql_fetch_assoc($rsGuias2Ret);
			$totalRows_rsGuias2Ret = mysql_num_rows($rsGuias2Ret);
	
			if ($row_rsGuias['tipo'] == "Registro") { 
							
				
				$id_entidad = $row_rsGuias['idReg'];
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsConveniosSN = "SELECT entidades.id, entidades.farpen, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_entidad'";
				$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
				$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
				$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
				$id_entidade = $row_rsGuias['farpen'];
				$qtdReg = $qtdReg + 1;

			} else {
				$qtdEsc = $qtdEsc + 1;
				$id_entidade = $row_rsGuias['farpen'];	
			}

			$vF = $row_rsGuias['velorRetornoFEPJ'];
			if ($totalRows_rsGuias2Ret > 0) { $vF = $vF + ($vF * $totalRows_rsGuias2Ret); }
			
			if (!isset($entidade_FEPJ["$id_entidade"])) {
				$entidade_FEPJ["$id_entidade"] = 0;	
				$qtd_FEPJ["$id_entidade"] = 0;
				$qtd_FEPJ["$id_entidade"] = $qtd_FEPJ["$id_entidade"] + 1;
				$entidade_FEPJ["$id_entidade"] = $entidade_FEPJ["$id_entidade"] + $vF;
			} else {
				$qtd_FEPJ["$id_entidade"] = $qtd_FEPJ["$id_entidade"] + 1;
				$entidade_FEPJ["$id_entidade"] = $entidade_FEPJ["$id_entidade"] + $vF;
			}
				
		}
		
		if (($row_rsGuias['ID_LINHA'] == 2) && ($d_SDJ >= $d_i && $d_SDJ <= $d_f)) {
			
			$qtdSdj = $qtdSdj + 1;
			
			$idGuia = $row_rsGuias['id'];
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsGuias2Ret = "SELECT * FROM guias2 WHERE guias2.id_guia = '$idGuia' AND dataMovSdj = '$d_sd'";
			$rsGuias2Ret = mysql_query($query_rsGuias2Ret, $Emolumentos) or die(mysql_error());
			$row_rsGuias2Ret = mysql_fetch_assoc($rsGuias2Ret);
			$totalRows_rsGuias2Ret = mysql_num_rows($rsGuias2Ret);
			
			$id_entidade = $row_rsGuias['id_entidade'];	
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsConveniosSN = "SELECT entidades.id, entidades.farpen, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_entidade'";
			$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
			$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
			$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
		
			$vSDJ_FEPJ = $row_rsGuias['valorRetornoSdjFEPJ']; 
			$id_SDT = $row_rsConveniosSN['farpen'];
			if ($totalRows_rsGuias2Ret > 0) { $vSDJ_FEPJ = $vSDJ_FEPJ + ($vSDJ_FEPJ * $totalRows_rsGuias2Ret); }
			
			if (!isset($entidade_FEPJ["$id_SDT"])) {
				$entidade_FEPJ["$id_SDT"] = 0;	
				$qtd_FEPJ["$id_SDT"] = 0;
				$qtd_FEPJ["$id_SDT"] = $qtd_FEPJ["$id_SDT"] + 1;
				$entidade_FEPJ["$id_SDT"] = $entidade_FEPJ["$id_SDT"] + $vSDJ_FEPJ;
			} else {
				$qtd_FEPJ["$id_SDT"] = $qtd_FEPJ["$id_SDT"] + 1;
				$entidade_FEPJ["$id_SDT"] = $entidade_FEPJ["$id_SDT"] + $vSDJ_FEPJ;
			}
		}
			  
		 
	} while ($row_rsGuias = mysql_fetch_assoc($rsGuias));
	
	ksort($entidade_FEPJ);
	reset($entidade_FEPJ);
	while (list($chave, $valor) = each($entidade_FEPJ)) {
	
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsEntidadeGuia = "SELECT entidades.id, entidades.nome, entidades.farpen FROM entidades WHERE entidades.farpen = '$chave'";
	$rsEntidadeGuia = mysql_query($query_rsEntidadeGuia, $Emolumentos) or die(mysql_error());
	$row_rsEntidadeGuia = mysql_fetch_assoc($rsEntidadeGuia);
	$totalRows_rsEntidadeGuia = mysql_num_rows($rsEntidadeGuia);
		?>
		
		<tr>
    <td width="100" bgcolor="#FFFFFF" class="texto"><div align="center"><?php echo $row_rsEntidadeGuia['farpen']; ?></div></td>
    <td height="15" bgcolor="#FFFFFF" class="texto">&nbsp;<?php echo $row_rsEntidadeGuia['nome']; ?></td>
    <td width="50" bgcolor="#FFFFFF" align="right" class="texto">&nbsp;<? echo $qtd_FEPJ["$chave"]; ?></td>

    <td width="110" bgcolor="#FFFFFF" align="right" class="texto">&nbsp;R$ <? echo number_format($valor,2, ",", "."); $v2 = $v2 + fc ($valor); ?></td>
	</tr> <?
    	//echo "entidade = $chave    Valor = ".number_format($valor,2, ",", ".")."       Qtd Guias: ".$qtd_FEPJ["$chave"]."<br>";
		$qtd = $qtdEsc + $qtdReg + $qtdSdj;
		$vTotal = $vTotal + fc ($valor);
	}


	?>
	  </table>
	</td>
  </tr>
</table>
<script language="javascript" type="text/javascript" >


window.top.document.all.vTotal.value = "<? echo number_format($vTotal, 2, ",", "."); ?>";
window.top.document.all.qtd.value = "<? echo $qtd; ?>";
window.top.document.all.dis.value = "<? echo $_SESSION['di']; ?>";
window.top.document.all.dfs.value = "<? echo $_SESSION['df']; ?>";

</script>
<? echo $v2; } else { ?>
<table width="729" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="729" height="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="TituloPagina">N&atilde;o existem registros no per&iacute;odo de <? echo $_SESSION['di']." até ".$_SESSION['df']; ?></td>
      </tr>
    </table></td>
  </tr>
</table>

<? } ?>
</body>
</html>
<? } else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Periodo</title>
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
</head></head>

<body>
<table width="100%" height="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" class="TituloPagina">REALIZE A CONSULTA POR PERIODO </div></td>
  </tr>
</table>
<script language="javascript" type="text/javascript" >


window.top.document.all.vTotal.value = "";
window.top.document.all.qtd.value = "";
window.top.document.all.dis.value = "";
window.top.document.all.dfs.value = "";

</script>
</body>
</html>
<? } ?>
<? } 
if ($acesso != 1 && $acesso != 2 && $acesso != 3) { 
unset ($_SESSION['df']);
unset ($_SESSION['di']);
}
?>