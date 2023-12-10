<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso != 1) {
	if ($acesso != 1) { $_SESSIeON['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
}else {


include ("../funcoes/padrao.php");
include ("../funcoes/data.php");
$_SESSION['tarifaFEPJ_Total'] = 0;
$_SESSION['tarifaSdjFEPJ_Total'] = 0;
$_SESSION['TotalFarpen'] = 0;
$_SESSION['tarifaSdjFEPJ_Total'] = 0;
if (!isset($_SESSION['erro_retorno'])) { $_SESSION['erro_retorno'] = ""; }
if (!isset($_SESSION['rel'])) $_SESSION['rel'] = "";
$tarifaFEPJ = 0;
$tarifaSdjFEPJ = 0;
$_SESSION['logfim'] = "";
$qt1 = 0;
$qt2 = 0;
$n = 0;
$distErro = 0;
if (isset($_GET['arquivo'])) {
	$nomeFile = "../../dados/".$_GET['arquivo'];
	$arquivo = fopen ($nomeFile, "r");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
		   <span class="texto">
<? if (isset($_GET['arquivo'])) { 

	include ("../inc/arquivoUpdt.php");	

?>
<table width="710" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td  bgcolor="#DCE0E9"><? 
	$linhasT = 0;
	$linhasU = 0;
	$TotalFarpen = 0;
	$nFdist= 0;
	$nFemo = 0;
	$linhasA = 0;
	$linhaT = 0;
	$linhaU = 0;
	$tarifaSdjFEPJ_Total = 0;
	$tarifaFEPJ_Total = 0;
	$tarifaTotalG = 0;
	while ($scanear = fscanf ($arquivo, "%s\t%s\t%s\t%s\t%s\t%s\t%s\n")) { 
	$linhasA = $linhasA + 1;
	?>
	
        
            <? 
	list ($n1, $n2, $n3, $n4, $n5, $n6, $n7) = $scanear;
   $TipoDetalhe = substr($n1, 13, 1);
 $n = $n + 1;
	if ($TipoDetalhe == "T") {
	
		$linhaT = $linhaT+1;
		
		$tarifaRetTJ = substr($n6, 26, 8);
		$tarifaSdjTJ = substr($n6, 42, 8);
		
		$_SESSION['tarifaRetTJ']   = substr($n6, 26, 8);
	    $_SESSION['convenioRetTJ'] = substr($n6, 18, 7);
		$_SESSION['tarifaSdjTJ']   = substr($n6, 42, 8);
	    $_SESSION['convenioSdjTJ'] = substr($n6, 34, 7);
					   
		
		$tarifa = substr($n7, 12, 13);
		$conv = substr($n4, 1, 7);
		$tarifa = $tarifa / 100;
		$_SESSION['convenio'] = substr($n3, 0, 7);
		if ($_SESSION['convenio'] == "1281929") { $_SESSION['convenio'] = "1281371"; }
		if ($_SESSION['convenio'] == "1281958") { $_SESSION['convenio'] = "1281378"; }
		if ($conv== "1281929") { $conv= "1281371"; }
		if ($conv== "1281958") { $conv= "1281378"; }
		$_SESSION['conv'] = $conv;
		$id_entiR = substr($n3, 7, 3);
		$anoR = substr($n3, 10, 2);
		$anoR2 = $anoR;
		$anoR = "20".$anoR;
		$numeroR = substr($n3, 12, 5);
		$linha = "0";
		$qt2 = $qt2 + 1;
		
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rsGuiasRetorno = "SELECT guias.situacaoEmolumento, guias.situacaoFarpen, guias.situacaoSDJ, guias.situacaoFARPEN_SDJ, guias.situacao_FEPJ_Emolumento, guias.situacao_FEPJ_SDJ, guias.id, guias.id_entidade, situacaoMovFarpen_emoCred FROM guias WHERE guias.id_entidade = '$id_entiR' AND guias.ano = '$anoR' AND guias.numero = '$numeroR'";
		$rsGuiasRetorno = mysql_query($query_rsGuiasRetorno, $Emolumentos) or die(mysql_error());
		$row_rsGuiasRetorno = mysql_fetch_assoc($rsGuiasRetorno);
		$totalRows_rsGuiasRetorno = mysql_num_rows($rsGuiasRetorno);
				
		$_SESSION['id_guiaRetorno'] = $row_rsGuiasRetorno['id'];
		$_SESSION['id_enti'] = $row_rsGuiasRetorno['id_entidade'];
		
		$_SESSION['situacaoFarpen'] = $row_rsGuiasRetorno['situacaoFarpen'];
		$_SESSION['situacaoFARPEN_SDJ'] = $row_rsGuiasRetorno['situacaoFARPEN_SDJ'];
		$_SESSION['situacaoSDJ'] = $row_rsGuiasRetorno['situacaoSDJ'];
		$_SESSION['situacaoEmolumento'] = $row_rsGuiasRetorno['situacaoEmolumento'];
		$_SESSION['situacaoMovFarpen_emoCred'] = $row_rsGuiasRetorno['situacaoMovFarpen_emoCred'];
//			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FGFGFG\"> gia encontrada: ".$totalRows_rsGuiasRetorno."</td>";
		
			
		if (isset($_SESSION['convenio']) && $_SESSION['convenio'] == "1275763"){
			$qt1 = $qt1+1;
//			echo "<td align=\"rigth\" calss=\"texto\" bgcolor=\"FLFLFL\"> FARPEN</td>";
		}		
		$_SESSION['id_guiaRetorno'] = $row_rsGuiasRetorno['id'];
		$_SESSION['situacao_FEPJ_Emolumento'] = $row_rsGuiasRetorno['situacao_FEPJ_Emolumento'];
		$_SESSION['situacao_FEPJ_SDJ'] = $row_rsGuiasRetorno['situacao_FEPJ_SDJ'];
	}

	if ($TipoDetalhe == "U") { // o seguimento do arquivo for U <- arquivo do retorno do BB
		
		$linhaU =     $linhaU+1;
		$diaPG =      substr($n2, 130, 2);
		$mesPG =      substr($n2, 132, 2);
		$anoPG =      substr($n2, 134, 4);
		$vp =         substr($n2, 64, 13);
		$valorComp =  $vp / 100;
		$tarifa =     number_format($tarifa, 2, ",", ".");
		$valorComp =  number_format($valorComp, 2, ",", ".");
		$convenio =   $_SESSION['convenio'];
		$idGuia =     $_SESSION['id_guiaRetorno'];
		$idEntidade = $_SESSION['id_enti'];
		$conv =       $_SESSION['conv'];
		$d =          $ano."-".$mes."-".$dia;			
		$d2 =         $anoPG."-".$mesPG."-".$diaPG;
		
		include("retorno/emolumento.php");
		include("retorno/farpen.php");
		include("retorno/sdj.php");
	//	include("retorno/retFarpen5.php");			
		include("retorno/tj.php");
		$linha = "1";
//			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FFFFFF\"> Data do pagamento: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$diaPG."/".$mesPG."/".$anoPG."</td>";
	}
	
 } 
		  $n = $n / 2 - 2;
//echo "Registros FARPEN com defeito encontrado: ".$distErro."<BR>";
//echo "Registros nao farpen = ".$qt1."<BR>";
//echo "Regiostros farpen = ".$qt2."<BR>";
//echo "Encontrato ".$n." Registro";
fclose($arquivo);

echo "<BR>--------------------------------------------<BR><BR>";
//echo "Total de linhas: ".$linhasA."<br>Linhas válidas: ".($linhasA - 4)."<br>Numero de linhas T: ".$linhaT."<BR>Numero de linhas U: ".$linhaU."<br>Valor total do farpen no arquivo: R$ ". number_format($TotalFarpen, 2, ",", ".")."<br>registros FARPEM: ".$nFemo."<br>registros FarpenDist: ".$nFdist;
//echo "<BR>--------------------------------------------<BR>";		
//$tarifaTotalG = $tarifaFEPJ_Total + $tarifaSdjFEPJ_Total;
//echo "Valor do FEPJ SNR e SDT - R$ ".$tarifaTotalG;
$TOT1 = $tarifaFEPJ_Total + $tarifaSdjFEPJ_Total;
echo "Valor do Retorno FEPJ:<BR>------------------------------<BR>Tarifa SNR:..... R$".$tarifaFEPJ_Total."<BR>Tarifa SDJ:..... R$".$tarifaSdjFEPJ_Total."<br>-----------------<br>Total:....... R$".$TOT1."<BR><BR>--------------------------------------------------<BR><BR>";
//echo "Valor Total Retorno FARPEN........ R$".$_SESSION['TotalFarpen'];
echo "<BR><BR>--------------------------------------------<BR><BR>".$_SESSION['logfim'];
if (isset($_SESSION['erro_retorno'])) echo "<BR>".$_SESSION['erro_retorno'];
//$_SESSION['tarifaSdjFEPJ_Total']

$_SESSION['rel'] .= $d3." --> ".$TOT1."<br>";
/*
$query_rsGuias2via = "SELECT guias.situacao_FEPJ_SDJ, guias.dataRetornoFEPJ, guias.tipo, guias.idReg, guias.velorRetornoFEPJ, guias.id, guias.id_entidade, guias.valorRetornoSdjFEPJ, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
				 JOIN entidades ON entidades.id = guias.id_entidade 
				 WHERE guias.id = '14626'";
			
			$rsGuias2via = mysql_query($query_rsGuias2via, $Emolumentos) or die(mysql_error());
			$row_rsGuias2via = mysql_fetch_assoc($rsGuias2via);
			$totalRows_rsGuias2via = mysql_num_rows($rsGuias2via);

echo "situacao: ".$row_rsGuias2via['situacao_FEPJ_SDJ']." Data: ".$row_rsGuias2via['dataRetornoFEPJ']." Valor: ".$row_rsGuias2via['valorRetornoSdjFEPJ'];
*/
if (isset($_SESSION['erro_retorno']) && $_SESSION['erro_retorno'] != "") { ?>
<script language="javascript" type="text/javascript">
window.alert('<? echo $_SESSION['erro_retorno']; ?>');
</script>
<? }
?>
<? } else { ?><table width="710" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><?


$caminho = "../../dados/";
$dir = opendir($caminho); 
while ($i = readdir($dir)) {
if(!preg_match('/^\./',$i) && ((strstr($i,'.txt') || strstr($i,'.TXT')) || (strstr($i,'.ret') || strstr($i,'.RET')))) {
echo "<a href=\"arquivoRetorno.php?arquivo=".$i."\" class=\"LinkNoticia\">".$i."</a><br>";
}
}
closedir($dir); 


	
	 ?></td>
  </tr>
</table>
<? }




 ?>
</body>
</html>
<? 
$_SESSION['t'] = $_GET['cont'] + 1;
//echo $_SESSION['t'];
unset ($checaReload);
//exit;
} ?>
<script language="javascript" type="text/javascript">
window.opener.location.reload();
window.close();
</script>