<?php

require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 

} else {

include ("../funcoes/padrao.php");
$qtd = 0;
$vTotal = 0;
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (!isset($_SESSION['df']) && isset($_SESSION['di'])) { $_SESSION['df'] = $_SESSION['di']; $_GET['df'] = $_SESSION['di']; }
if (isset($_SESSION['di']) && isset($_SESSION['df'])) {

$di_F = substr($_SESSION['di'], 6, 4).substr($_SESSION['di'], 3, 2).substr($_SESSION['di'], 0, 2);
$df_F = substr($_SESSION['df'], 6, 4).substr($_SESSION['df'], 3, 2).substr($_SESSION['df'], 0, 2);

$di_FF = substr($_SESSION['di'], 6, 4)."-".substr($_SESSION['di'], 3, 2)."-".substr($_SESSION['di'], 0, 2);
$df_FF = substr($_SESSION['df'], 6, 4)."-".substr($_SESSION['df'], 3, 2)."-".substr($_SESSION['df'], 0, 2);



mysql_select_db($database_Emolumentos, $Emolumentos);
$v2 = "";
$query_rsGuias = "SELECT 'SN' `ID_LINHA`, guias.tipoRegistro, guias.dataRetornoFEPJ_SDJ, guias.dataRetornoFEPJ, guias.tipo, guias.idReg, guias.velorRetornoFEPJ, guias.id, guias.id_entidade, guias.valorRetornoSdjFEPJ, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
	                 JOIN entidades ON entidades.id = guias.id_entidade
					WHERE guias.situacao_FEPJ_Emolumento >= '4' AND guias.dataRetornoFEPJ BETWEEN '$di_FF' AND '$df_FF'
					UNION
					SELECT 'SD', guias.tipoRegistro, guias.dataRetornoFEPJ_SDJ, guias.dataRetornoFEPJ, guias.tipo, guias.idReg, guias.velorRetornoFEPJ, guias.id, guias.id_entidade, guias.valorRetornoSdjFEPJ, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
					JOIN entidades ON entidades.id = guias.id_entidade
					WHERE guias.situacao_FEPJ_SDJ >= '4' AND guias.dataRetornoFEPJ_SDJ BETWEEN '$di_FF' AND '$df_FF'";



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
<? if ($totalRows_rsGuias > 0 && ($di_F >= 20060901 && $df_F >= 20060901)) { ?>
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
	
		
		
		
		$d_SDJ = formatarNumero ($row_rsGuias['dataRetornoFEPJ_SDJ']);
		$d_SNR = formatarNumero ($row_rsGuias['dataRetornoFEPJ']);
		$d_sd = $row_rsGuias['dataRetornoFEPJ_SDJ'];
		$d_fe = $row_rsGuias['dataRetornoFEPJ'];

		
		if (($row_rsGuias['ID_LINHA'] == "SN") && ($d_SNR >= $d_i && $d_SNR <= $d_f)) {

			if ($row_rsGuias['tipo'] == "Registro") { 
							
				
				$id_ent = $row_rsGuias['idReg'];
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsConveniosSN = "SELECT entidades.id, entidades.farpen, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_ent'";
				$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
				$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
				$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
				$id_entidade = $row_rsConveniosSN['farpen'];
				$qtdReg = $qtdReg + 1;
				
			} else {
				$qtdEsc = $qtdEsc + 1;

				$id_entidade = $row_rsGuias['farpen'];	
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
		
		if (($row_rsGuias['ID_LINHA'] == "SD") && ($d_SDJ >= $d_i && $d_SDJ <= $d_f)) {
		
			$qtdSdj = $qtdSdj + 1;
			  
			$id_ent = $row_rsGuias['id_sdt'];	
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsConveniosSDT = "SELECT entidades.id, entidades.farpen, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_ent'";
			$rsConveniosSDT = mysql_query($query_rsConveniosSDT, $Emolumentos) or die(mysql_error());
			$row_rsConveniosSDT = mysql_fetch_assoc($rsConveniosSDT);
			$totalRows_rsConveniosSDT = mysql_num_rows($rsConveniosSDT);
		
			$vSDJ_FEPJ = $row_rsGuias['valorRetornoSdjFEPJ']; 
			$id_SDT = $row_rsConveniosSDT['farpen'];

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
		
		include ("../inc/2pg.php");
		
	} while ($row_rsGuias = mysql_fetch_assoc($rsGuias));
	
	
	
	
	
	
	
	if (($qtdReg + $qtdEsc + $qtdSdj) > 0) {
	ksort($entidade_FEPJ);
	reset($entidade_FEPJ);
//	echo each($entidade_FEPJ);
//exit;	
	
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

	} else {
	?>
	 <td width="100%" height="250" bgcolor="#FFFFFF" class="texto"><div align="center">Não existem registros no periódo solicitado.</div></td>
	<? } ?>
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
<? //echo $v2; 
} else { ?>
<table width="729" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="729" height="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="TituloPagina">Periodos anteriores a 01/09/2006 n&atilde;o dispon&iacute;veis</td>
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
unset($pag2SNR);
unset($pag2SDJ);

}
?>