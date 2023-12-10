<?php

require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 

} else {

function dataC ($var1, $var2) {
		
		
		$ano = substr($var1, 0, 4);
		$mes = substr($var1, 4, 2);
		$dia = substr($var1, 6, 2);
		//echo $dia.$mes.$ano."<br>";
		$res=checkdate($mes,$dia,$ano);
	
		if ($res==1) do {
		
			$dias_do_mes = date ("t", mktime (0,0,0,$mes,$dia,$ano));
			$diaV = $dia + $var2;
			if ($diaV > $dias_do_mes) {
				$diaV = $diaV - $dias_do_mes;
				$mesV = $mes + 1;
				if ($mesV<10){ $mesV = "0".$mesV; }
			} else { 
				$mesV = $mes;
			}
			if ($mesV > 12){
				$mesV = "01";
				$anoV = $ano + 1;
			} else { 
				$anoV = $ano;
			}
		
			if ($diaV<10){ $diaV = "0".$diaV; }
			if ($diaV == 07 && $anoV == 2006 && $mesV == 09) { $diaV = 08; }
			return $anoV."-".$mesV."-".$diaV; // vencimento
			//$emicao = $ano."-".$mes."-".$dia; // emissao
		
		} while ((date("w", mktime(0,0,0,$mesV,$diaV,$anoV)) != 0) && (date("w", mktime(0,0,0,$mesV,$diaV,$anoV)) != 6));
		
	}
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



mysql_select_db($database_Emolumentos, $Emolumentos);

$query_rsGuias = "SELECT '1' `ID_LINHA`, guias.*, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
				 JOIN entidades ON guias.id_entidade = entidades.id
				WHERE guias.situacaoEmolumento >= '4' 
				AND (guias.id_entidade <> 26 OR guias.tipo = 'Registro')
				UNION
				SELECT '2', guias.*, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
				JOIN entidades ON guias.id_entidade = entidades.id
				WHERE guias.situacaoSDJ >= '4'
				UNION
				SELECT '3', guias.*, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
				JOIN entidades ON guias.id_entidade = entidades.id
				WHERE guias.situacaoEmolumento >= '4' 
				AND (guias.id_entidade = 26 AND guias.tipo <> 'Registro')";



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
		$d_SNR = formatarNumero ($row_rsGuias['dataMovEmolumento']);

		if ($d_SNR == 20060907) $d_SNR = 20060909;
		if ($row_rsGuias['ID_LINHA'] == '3' && $d_SNR <= 20060928) { // bug entidade 26 Vieira Batista
			
			$row_rsGuias['dataMovEmolumento'] = dataC (formatarNumero($row_rsGuias['dataMovEmolumento']), 1);
			$d_SNR = formatarNumero ($row_rsGuias['dataMovEmolumento']);

		}
		
		if (($row_rsGuias['ID_LINHA'] == 1 || $row_rsGuias['ID_LINHA'] == 3) && ($d_SNR >= $d_i && $d_SNR <= $d_f)) {
			
	
			if ($row_rsGuias['tipo'] == "Registro") { 
				$id_entidade = $row_rsGuias['idReg'];
				$qtdReg = $qtdReg + 1;
			} else {
				$qtdEsc = $qtdEsc + 1;
				$id_entidade = $row_rsGuias['id_entidade'];	
			}

			$vF = $row_rsGuias['velorRetornoFEPJ'];
			
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
			
			$id_entidade = $row_rsGuias['id_entidade'];	
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsConveniosSN = "SELECT entidades.id, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_entidade'";
			$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
			$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
			$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
		
			$vSDJ_FEPJ = $row_rsGuias['valorRetornoSdjFEPJ']; 
			$id_SDT = $row_rsConveniosSN['id_sdt'];
			
			
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
	$query_rsEntidadeGuia = "SELECT entidades.id, entidades.nome, entidades.farpen FROM entidades WHERE entidades.id = '$chave'";
	$rsEntidadeGuia = mysql_query($query_rsEntidadeGuia, $Emolumentos) or die(mysql_error());
	$row_rsEntidadeGuia = mysql_fetch_assoc($rsEntidadeGuia);
	$totalRows_rsEntidadeGuia = mysql_num_rows($rsEntidadeGuia);
		?>
		
		<tr>
    <td width="100" bgcolor="#FFFFFF" class="texto"><div align="center"><?php echo $row_rsEntidadeGuia['farpen']; ?></div></td>
    <td height="15" bgcolor="#FFFFFF" class="texto">&nbsp;<?php echo $row_rsEntidadeGuia['nome']; ?></td>
    <td width="50" bgcolor="#FFFFFF" class="texto">&nbsp;<? echo $qtd_FEPJ["$chave"]; ?></td>

    <td width="110" bgcolor="#FFFFFF" class="texto">&nbsp;R$ <? echo number_format($valor,2, ",", "."); ?></td>
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