<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso != 1) {
	if ($acesso != 1) { $_SESSIeON['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
}else {
function formatarNumero ($var) { 

	$var = ereg_replace("0","0",$var); 
	$var = ereg_replace("/","",$var); 
	$var = ereg_replace("-","",$var); 
	$var = ereg_replace("\.","",$var); 
	$var = ereg_replace(",","",$var); 
	return $var;

}
function dataC ($var1, $var2) {
		
		
		$ano = substr($var1, 0, 4);
		$mes = substr($var1, 4, 2);
		$dia = substr($var1, 6, 2);
		//echo $dia.$mes.$ano."<br>";
		$res=checkdate($mes,$dia,$ano);
	
		if ($res==1) {
		
			$dias_do_mes = date ("t", mktime (0,0,0,$mes,$dia,$ano));
			$diaV = $dia+1; 
			
			if (date("w", mktime(0,0,0,$mes,$diaV,$ano)) == 6) { 
				$diaV = $diaV + 2; 
			} else if (date("w", mktime(0,0,0,$mes,$diaV,$ano)) == 0) { 
				$diaV = $diaV + 1; 
			}
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
			if ($diaV == 07 && $anoV == 2006 && $mesV == 09) { $diaV = 08; }
			if ($diaV<10){ $diaV = "0".$diaV; }
			
			if ($var2 == "aaaa-mm-dd"){ return $anoV."-".$mesV."-".$diaV; } else if ($var2 == "aaaammdd") { return $anoV.$mesV.$diaV; }
			if (!isset($var2)) return $anoV.$mesV.$diaV;
		
		} //while ((date("w", mktime(0,0,0,$mesV,$diaV,$anoV)) != 0) && (date("w", mktime(0,0,0,$mesV,$diaV,$anoV)) != 6));
		
	}
//include("../funcoes/data.php");
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

$qt1 = 0;
$qt2 = 0;
$n = 0;
$distErro = 0;
if (isset($_GET['arquivo'])) {
	$ar = $_GET['arquivo'];
	$nomeFile = "../../dados/".$_GET['arquivo'];
	$arquivo = fopen ($nomeFile, "r");


/*



	mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsGuiasRetorno = "SELECT nomeArquivo 
									 FROM guias 
									 WHERE nomeArquivo = '$ar'";
			$rsGuiasRetorno = mysql_query($query_rsGuiasRetorno, $Emolumentos) or die(mysql_error());
			$row_rsGuiasRetorno = mysql_fetch_assoc($rsGuiasRetorno);
			$totalRows_rsGuiasRetorno = mysql_num_rows($rsGuiasRetorno);

	if ($totalRows_rsGuiasRetorno > 0) {
	
		$updateSQL = sprintf("UPDATE guias SET situacao_FEPJ_SDJ= 2 AND  situacao_FEPJ_Emolumento= 2 WHERE nomeArquivo=%s",          
					   GetSQLValueString($ar, "text"));
					
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());


		


	}
	*/
	
	if (!isset($checaReload)) {
							
			$updateSQL = sprintf("UPDATE guias SET situacao_FEPJ_Emolumento= 2 WHERE situacao_FEPJ_Emolumento >= 4 AND arquivoNomeFEPJ_SNR=%s",          
							   GetSQLValueString($d2, "date"),
							   GetSQLValueString($ar, "text"));
							
							mysql_select_db($database_Emolumentos, $Emolumentos);
							$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());		
			
			$updateSQL = sprintf("UPDATE guias SET situacao_FEPJ_SDJ= 2 WHERE situacao_FEPJ_SDJ >= 4 AND arquivoNomeFEPJ_SDJ=%s",          
							   GetSQLValueString($d2, "date"),
							   GetSQLValueString($ar, "text"));
							
							mysql_select_db($database_Emolumentos, $Emolumentos);
							$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());		
			
			
				
			$checaReload = "ok";
							
	}
	
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
<? if (isset($_GET['arquivo'])) { ?>
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
		$id_entiR = substr($n3, 7, 3);
		$anoR = substr($n3, 10, 2);
		$anoR2 = $anoR;
		$anoR = "20".$anoR;
		$numeroR = substr($n3, 12, 5);
//			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FGFGFG\"> Número do documento: &nbsp;&nbsp;".$_SESSION['convenio'].".".$id_entiR.".".$anoR2.".".$numeroR."</td>";
//			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FGFGFG\">".$_SESSION['convenio']."</td>";
//			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FGFGFG\">".$id_entiR."</td>";
//			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FGFGFG\">".$anoR."</td>";
			$linha = "0";
			$qt2 = $qt2 + 1;
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsGuiasRetorno = "SELECT guias.situacao_FEPJ_SDJ, guias.situacao_FEPJ_Emolumento, guias.id FROM guias WHERE guias.id_entidade = '$id_entiR' AND guias.ano = '$anoR' AND guias.numero = '$numeroR'";
			$rsGuiasRetorno = mysql_query($query_rsGuiasRetorno, $Emolumentos) or die(mysql_error());
			$row_rsGuiasRetorno = mysql_fetch_assoc($rsGuiasRetorno);
			$totalRows_rsGuiasRetorno = mysql_num_rows($rsGuiasRetorno);
			$_SESSION['id_guiaRetorno'] = $row_rsGuiasRetorno['id'];
			$_SESSION['situacao_FEPJ_Emolumento'] = $row_rsGuiasRetorno['situacao_FEPJ_Emolumento'];
			$_SESSION['situacao_FEPJ_SDJ'] = $row_rsGuiasRetorno['situacao_FEPJ_SDJ'];
			
}
	if ($TipoDetalhe == "U") { // o seguimento do arquivo for U <- arquivo do retorno do BB
		
		$linhaU = $linhaU+1;
		$diaPG = substr($n2, 130, 2);
		$mesPG = substr($n2, 132, 2);
		$anoPG = substr($n2, 134, 4);
		$vp = substr($n2, 64, 13);
		$valorComp = $vp / 100;
		$tarifa = number_format($tarifa, 2, ",", ".");
		$valorComp = number_format($valorComp, 2, ",", ".");
		$convenio = $_SESSION['convenio'];
		$idGuia = $_SESSION['id_guiaRetorno'];
		$idEntidade = $_SESSION['id_enti'];
		$d = $ano."-".$mes."-".$dia;			
		$d2 = $anoPG."-".$mesPG."-".$diaPG;
		
		$tarifaRetTJ   = $_SESSION['tarifaRetTJ'];
	    $convenioRetTJ = $_SESSION['convenioRetTJ'];
		$tarifaSdjTJ   = $_SESSION['tarifaSdjTJ'];
	    $convenioSdjTJ = $_SESSION['convenioSdjTJ'];
		
		
		if ($convenioRetTJ == 1276021) {
			if (!isset($d_) && $id_entiR != 26) {
				$d_ = $d2;
			}
						
			if (formatarNumero ($d2) != formatarNumero ($d_)) { // bug entidade 26 Vieira Batista
				
				echo $d2;
				$d3 = $d_;
				echo "-->".$d3."-->".$id_entiR."<br>";
			} else {
				$d3 = $d2;
			}
			if ($_SESSION['situacao_FEPJ_Emolumento'] >= 4){
				$tarifaFEPJ = $tarifaRetTJ * 0.01;
				$tarifaFEPJ_Total = $tarifaFEPJ + $tarifaFEPJ_Total;
				$insertSQL = sprintf("INSERT INTO guias2fepj (id_guia, data_FEPJ_Emolumento) VALUES (%s, %s)",
				   GetSQLValueString($idGuia, "int"),
				   GetSQLValueString($d3, "date"));

				  mysql_select_db($database_Emolumentos, $Emolumentos);
				$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
				
		//		echo "SNR - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d3."<BR>";
				
			}else{				
							
				$tarifaFEPJ = $tarifaRetTJ * 0.01;
				$tarifaFEPJ_Total = $tarifaFEPJ + $tarifaFEPJ_Total;
				$updateSQL = sprintf("UPDATE guias SET situacao_FEPJ_Emolumento=4, velorRetornoFEPJ=%s, dataRetornoFEPJ=%s, arquivoNomeFEPJ_SNR=%s WHERE id=%s",          
				   GetSQLValueString($tarifaFEPJ, "text"),
				   GetSQLValueString($d3, "date"),
				   GetSQLValueString($ar, "text"),
				   GetSQLValueString($idGuia, "int"));
				
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
		//		echo $idGuia." --> EMO   |   ".$d3."    |     ".$tarifaFEPJ."<br>";
			}
		}
		
		
		if ($convenioSdjTJ == 1276021) {
			$tarifaSdjFEPJ = $tarifaSdjTJ * 0.01;
				$tarifaSdjFEPJ_Total = $tarifaSdjFEPJ + $tarifaSdjFEPJ_Total; 
			if ($_SESSION['situacao_FEPJ_SDJ'] >= 4){
				
					
					$insertSQL = sprintf("INSERT INTO guias2fepj (id_guia, data_FEPJ_SDJ) VALUES (%s, %s)",
					   GetSQLValueString($idGuia, "int"),
					   GetSQLValueString($d2, "date"));

					  mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
					
					echo "SDJ - PAGAMENTO DUPLICADO - ID GUIA:".$idGuia."    --> Data: ".$d2."<BR>";
					
				}else{
				
				$updateSQL = sprintf("UPDATE guias SET situacao_FEPJ_SDJ=4 , valorRetornoSdjFEPJ=%s, dataRetornoFEPJ_SDJ=%s, arquivoNomeFEPJ_SDJ=%s WHERE id=%s",          
				   GetSQLValueString($tarifaSdjFEPJ, "text"),
				   GetSQLValueString($d2, "date"),
				   GetSQLValueString($ar, "text"),
				   GetSQLValueString($idGuia, "int"));
				
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
			echo $idGuia." --> SDJ   |   ".$d2."    |     ".$tarifaSdjFEPJ."<br>";
			}
		}
	//		echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FFFFFF\"> Valor: ".$valorComp." id guia: ".$idGuia."<br>Tarifa: R$ ".$tarifa."<td>";
	$linha = "1";
	//echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FFFFFF\"> Data do pagamento: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$diaPG."/".$mesPG."/".$anoPG."</td>";
	}
	
	
  
   ?>   <? /* </span> </tr> if (isset($linha) && $linha == "1") { ?>
          <tr>
            <td bgcolor="#DCE0E9" height="1"></td>
          </tr>
          <? }  </table>
        <span class="texto">*/ ?>
       
      <? } 
echo "<BR>--------------------------------------------<BR>";		
$tarifaTotalG = $tarifaFEPJ_Total + $tarifaSdjFEPJ_Total;
echo "SNR: ".$tarifaFEPJ_Total."<BR>SDJ: ".$tarifaSdjFEPJ_Total;
echo "Valor do FEPJ SNR e SDT - R$ ".$tarifaTotalG;
fclose($arquivo);


//echo "Total de linhas: ".$linhasA."<br>Linhas válidas: ".($linhasA - 4)."<br>Numero de linhas T: ".$linhaT."<BR>Numero de linhas U: ".$linhaU."<br>Valor total do farpen no arquivo: R$ ". number_format($TotalFarpen, 2, ",", ".")."<br>registros FARPEM: ".$nFemo."<br>registros FarpenDist: ".$nFdist;
?>
<? } else { ?><table width="710" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><?


$caminho = "../../dados/";
$dir = opendir($caminho); 
while ($i = readdir($dir)) {
if(!preg_match('/^\./',$i) && ((strstr($i,'.txt') || strstr($i,'.TXT')) || (strstr($i,'.ret') || strstr($i,'.RET')))) {
echo "<a href=\"tjUpt.php?arquivo=".$i."\" class=\"LinkNoticia\">".$i."</a><br>";
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
$_SESSION['t'] = $_GET['cont'] - 1;
//echo $_SESSION['t'];
unset ($checaReload);
//exit;
} ?>
<script language="javascript" type="text/javascript">
window.opener.location.reload();
window.close();
</script>