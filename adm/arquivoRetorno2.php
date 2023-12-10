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
			$query_rsGuiasRetorno = "SELECT * FROM guias WHERE guias.id_entidade = '$id_entiR' AND guias.ano = '$anoR' AND guias.numero = '$numeroR'";
			$rsGuiasRetorno = mysql_query($query_rsGuiasRetorno, $Emolumentos) or die(mysql_error());
			$row_rsGuiasRetorno = mysql_fetch_assoc($rsGuiasRetorno);
			$totalRows_rsGuiasRetorno = mysql_num_rows($rsGuiasRetorno);
					
			$_SESSION['id_guiaRetorno'] = $row_rsGuiasRetorno['id'];
			$_SESSION['id_enti'] = $row_rsGuiasRetorno['id_entidade'];
			
			$_SESSION['situacaoFarpen'] = $row_rsGuiasRetorno['situacaoFarpen'];
			$_SESSION['situacaoFARPEN_SDJ'] = $row_rsGuiasRetorno['situacaoFARPEN_SDJ'];
			$_SESSION['situacaoSDJ'] = $row_rsGuiasRetorno['situacaoSDJ'];
			$_SESSION['situacaoEmolumento'] = $row_rsGuiasRetorno['situacaoEmolumento'];
			
//			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FGFGFG\"> gia encontrada: ".$totalRows_rsGuiasRetorno."</td>";
			
			
		if (isset($_SESSION['convenio']) && $_SESSION['convenio'] == "1275763"){
		$qt1 = $qt1+1;
//			echo "<td align=\"rigth\" calss=\"texto\" bgcolor=\"FLFLFL\"> FARPEN</td>";
		}
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
				
					$tarifaFEPJ = $tarifaRetTJ * 0.01;
					$tarifaFEPJ_Total = $tarifaFEPJ + $tarifaFEPJ_Total;
					$updateSQL = sprintf("UPDATE guias SET velorRetornoFEPJ=%s, dataRetornoFEPJ=%s WHERE id=%s",          
					   GetSQLValueString($tarifaFEPJ, "text"),
					   GetSQLValueString($d2, "date"),
					   GetSQLValueString($idGuia, "int"));
					
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
				
				}
				if ($convenioSdjTJ == 1276021) {
				
					$tarifaSdjFEPJ = $tarifaSdjTJ * 0.01;
					$tarifaSdjFEPJ_Total = $tarifaSdjFEPJ + $tarifaSdjFEPJ_Total; 
					$updateSQL = sprintf("UPDATE guias SET velorRetornoFEPJ=%s, dataRetornoFEPJ=%s WHERE id=%s",          
					   GetSQLValueString($tarifaSdjFEPJ, "text"),
					   GetSQLValueString($d2, "date"),
					   GetSQLValueString($idGuia, "int"));
					
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
				
				}
		
//		echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FFFFFF\"> Valor: ".$valorComp." id guia: ".$idGuia."<br>Tarifa: R$ ".$tarifa."<td>";
		
			if ($convenio == "1275763"){ // convenio do farpen

				
				$valorComp = fc ($valorComp);
				$valorFarpen = $valorComp + ($valorComp * (5/100));
				$valorFarpenFormat = number_format ($valorFarpen, 2, ",", ".");
				if ($idEntidade == "") {
					$distErro = $distErro + 1;
	//				echo "Guia de distribuição repedita, ------ VALOR: R$ ".$valorFarpenFormat;
				} else {  
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsEntiConvenio1 = "SELECT * FROM `entidades` WHERE convenio2 = '$conv' OR convenio = '$conv'";
				$rsEntiConvenio1 = mysql_query($query_rsEntiConvenio1, $Emolumentos) or die(mysql_error());
				$row_rsEntiConvenio1 = mysql_fetch_assoc($rsEntiConvenio1);
				$totalRows_rsEntiConvenio1 = mysql_num_rows($rsEntiConvenio1);
				
					if ($row_rsEntiConvenio1['tipo'] == 'SN') {  // se for serviço notarial FARPEN
						//gera o retorno do farpen do SN 
					/*	if ($_SESSION['situacaoFarpen'] >= 4) { 
			
							$insertSQL = sprintf("INSERT INTO guias2 (id_guia, dataMovFarpen) VALUES (%s, %s)",
							   GetSQLValueString($idGuia, "int"),
							   GetSQLValueString($d2, "text"));
		
							  mysql_select_db($database_Emolumentos, $Emolumentos);
							$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());  
							
						} else {
						*/
						
						$updateSQL = sprintf("UPDATE guias SET situacaoFarpen=%s, dataMovFarpen=%s, dataAtulizacao=%s, valorRetornoFARPEN=%s, tarifaRetornoFARPEN=%s, nomeArquivo=%s, linhaFARPEN=%s WHERE id=%s",
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
						
						//}


		//				echo "<td align=\"left\" calss=\"texto\" bgcolor=\"#ECDCD5\"> atualizado guia de serviço notarial CONVENIO FARPEN id:".$idEntidade." <br>entidade: ".$row_rsEntiConvenio1['nome']."<br>id guia: ".$idGuia."</td>";
					$TotalFarpen = fc ($valorComp) + $TotalFarpen;
					$nFemo = $nFemo + 1;
					} else if ($row_rsEntiConvenio1['tipo'] == "SDT") { // FARPEN SDJ
				//gera o retorno do farpen do SDJ
		/*					if ($_SESSION['situacaoFARPEN_SDJ'] >= 4) { 
			
						$insertSQL = sprintf("INSERT INTO guias2 (id_guia, dataMovFarpenSdj) VALUES (%s, %s)",
							   GetSQLValueString($idGuia, "int"),
							   GetSQLValueString($d2, "text"));
		
							  mysql_select_db($database_Emolumentos, $Emolumentos);
							$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
							
						} else {*/ 	
						$updateSQL = sprintf("UPDATE guias SET situacaoFARPEN_SDJ=%s, dataMovFARPEN_SDJ=%s, dataAtulizacao=%s, valorRetornoFARPEN_SDJ=%s, tarifaRetornoFARPEN_SDJ=%s, nomeArquivo=%s, linhaFARPEN_sdj=%s WHERE id=%s",
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
					//	}
			//			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"#ECAAD5\"> atualizado guia de serviço notarial CONVENIO FARPEN SDJ id:".$idEntidade." <br>entidade: ".$row_rsEntiConvenio1['nome']."<br>id guia: ".$idGuia."</td>";
						$TotalFarpen = fc ($valorComp) + $TotalFarpen;
						$nFdist = $nFdist + 1;
					} else { 
					
				//		echo "<td align=\"left\" calss=\"texto\" bgcolor=\"#AAAAAA\"> Convenio nao encontrato: ".$conv."</td>";
					
					}
				}
				
					$linha = "1";
			
			} 
			
			
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsEntiConvenioSDT = "SELECT * FROM `entidades` WHERE convenio = '$convenio' AND tipo = 'SDT'";
			$rsEntiConvenioSDT = mysql_query($query_rsEntiConvenioSDT, $Emolumentos) or die(mysql_error());
			$row_rsEntiConvenioSDT = mysql_fetch_assoc($rsEntiConvenioSDT);
			$totalRows_rsEntiConvenioSDT = mysql_num_rows($rsEntiConvenioSDT);


			if ($totalRows_rsEntiConvenioSDT >= 1) { // EMOLUMENTO SDJ	
			// gera o valor do retordo SDJ
		//	$tarifaSdjTJ = int($tarifaSdjTJ);
			$tarifaSdjFEPJ = $tarifaSdjTJ * 0.01;
//			$tarifaSdjFEPJ_Total = $tarifaSdjFEPJ + $tarifaSdjFEPJ_Total; 
//			echo "SDJ_FEPJ: ".number_format($tarifaSdjFEPJ, 2, ",", ".")."<br>";
/*
			if ($_SESSION['situacaoSDJ'] >= 4) { 
			
				$insertSQL = sprintf("INSERT INTO guias2 (id_guia, dataMovSdj) VALUES (%s, %s)",
				   GetSQLValueString($idGuia, "int"),
				   GetSQLValueString($d2, "text"));

				  mysql_select_db($database_Emolumentos, $Emolumentos);
				$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
				
			} else {
	*/		
			
			$updateSQL = sprintf("UPDATE guias SET situacaoSDJ=%s, dataMovSDJ=%s, dataAtulizacao=%s, valorRetornoSDJ=%s, tarifaRetornoSDJ=%s, valorRetornoSdjFEPJ=%s, nomeArquivo=%s, linhaSDJ=%s WHERE id=%s",
					   GetSQLValueString("4", "int"),
					   GetSQLValueString($d2, "date"),
					   GetSQLValueString($d, "date"),
					   GetSQLValueString($valorComp, "text"),
					   GetSQLValueString($tarifa, "text"),
					   GetSQLValueString($tarifaSdjFEPJ, "text"),
					   GetSQLValueString($_GET['arquivo'], "text"),
					   GetSQLValueString($n, "text"),
					   GetSQLValueString($idGuia, "int"));
					
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
					
	//				echo "<td align=\"left\" calss=\"texto\" bgcolor=\"#E1F7E4\"> atualizado guia de serviço de DISTRIBUIDOR id:".$row_rsEntiConvenioSDT['id']."<br>entidade: ".$row_rsEntiConvenioSDT['nome']."<td>";
		//		}
			}
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsEntiConvenio1 = "SELECT * FROM `entidades` WHERE convenio = '$convenio' && tipo = 'SN'";
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
					
				//	echo $d2;
					$d3 = $d_;
				//	echo "-->".$d3."-->".$id_entiR."<br>";
				} else {
					$d3 = $d2;
				}
		//		echo $d3."<br>";
				if (formatarNumero ($d2) == 20060907) $d3 = "2006-09-08";
				
					$tarifaFEPJ = $tarifaRetTJ * 0.01;			
//					echo "FEPJ: ".number_format($tarifaFEPJ, 2, ",", ".")."<br>";

				if ($_SESSION['situacaoEmolumento'] >= 4) { 
		
						$insertSQL = sprintf("INSERT INTO guias2 (id_guia, dataMovEmolumento, dataRetornoFEPJ) VALUES (%s, %s, %s)",
						   GetSQLValueString($idGuia, "int"),
						   GetSQLValueString($d2, "text"),
						   GetSQLValueString($d3, "text"));
	
						  mysql_select_db($database_Emolumentos, $Emolumentos);
						$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
						
				} else {
	
				$updateSQL = sprintf("UPDATE guias SET situacaoEmolumento=%s, dataMovEmolumento=%s, dataAtulizacao=%s, valorRetornoEmo=%s, tarifaRetornoEmo=%s, velorRetornoFEPJ=%s, dataRetornoFEPJ=%s, nomeArquivo=%s, linhaEmo=%s WHERE id=%s",          
				   GetSQLValueString("4", "int"),
				   GetSQLValueString($d2, "date"),
				   GetSQLValueString($d, "date"),
				   GetSQLValueString($valorComp, "text"),
				   GetSQLValueString($tarifa, "text"),
				   GetSQLValueString($tarifaFEPJ, "text"),
				   GetSQLValueString($d3, "date"),
				   GetSQLValueString($_GET['arquivo'], "text"),
				   GetSQLValueString($n, "text"),
				   GetSQLValueString($idGuia, "int"));
				
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
				}
//			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FFFFFF\"> atualizado guia de serviço notarial id:".$idEntidade."<br>entidade: ".$row_rsEntiConvenio1['nome']."<td>";			
			} else {
	//		echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FF0000\"> NAO ATUALIZOU serviço notarial id:".$idEntidade."<br>entidade: ".$row_rsEntiConvenio1['nome']."<td>";			
			}
		
		}
		
		
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsEntiConvenio2 = "SELECT * FROM `entidades` WHERE convenio2 = '$convenio'";
			$rsEntiConvenio2 = mysql_query($query_rsEntiConvenio2, $Emolumentos) or die(mysql_error());
			$row_rsEntiConvenio2 = mysql_fetch_assoc($rsEntiConvenio2);
			$totalRows_rsEntiConvenio2 = mysql_num_rows($rsEntiConvenio2);
				
			if ($totalRows_rsEntiConvenio2 >= "1") {
				/// gera o valor do RETORNO DO FARPEN DA ENTIDADE 5%
				$updateSQL = sprintf("UPDATE guias SET dataMovFarpen_emoCred =%s, dataAtulizacao=%s, valorRetornoFARPEN_emoCred=%s, tarifaRetornoFARPEN_emoCred=%s, nomeArquivo=%s, linhaFARPEN2=%s WHERE id=%s",
				   GetSQLValueString($d2, "date"),
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

			$linha = "1";
//			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FFFFFF\"> Data do pagamento: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$diaPG."/".$mesPG."/".$anoPG."</td>";
	}
	
	
  
   ?>
          
          <? /* </span> </tr> if (isset($linha) && $linha == "1") { ?>
          <tr>
            <td bgcolor="#DCE0E9" height="1"></td>
          </tr>
          <? }  </table>
        <span class="texto">*/ ?>
       
      <? } 
		  $n = $n / 2 - 2;
echo "Registros FARPEN com defeito encontrado: ".$distErro."<BR>";
echo "Registros nao farpen = ".$qt1."<BR>";
echo "Regiostros farpen = ".$qt2."<BR>";
echo "Encontrato ".$n." Registro";
$tarifaTotalG = $tarifaFEPJ_Total + $tarifaSdjFEPJ_Total;
echo "Valor do FEPJ SNR e SDT - R$ ".$tarifaTotalG;
fclose($arquivo);

/*
 mysql_select_db($database_Emolumentos, $Emolumentos);
//$query_rsG = "SELECT * FROM `guias` WHERE situacaoSDJ = '4' AND valorSDT = '24,70' AND tipo = 'Escritura'";
$query_rsG = "SELECT * FROM guias WHERE guias.situacaoEmolumento = '4' AND guias.situacaoSDJ = '2' AND guias.tipo = 'Escritura'";
$rsG = mysql_query($query_rsG, $Emolumentos) or die(mysql_error());
$row_rsG = mysql_fetch_assoc($rsG);
$totalRows_rsG = mysql_num_rows($rsG);


echo "Foram encontradas ".$totalRows_rsG." guias<br><br><br>";
while ($row_rsG = mysql_fetch_assoc($rsG)) { 
$updateSQL = sprintf("UPDATE guias SET situacaoSDJ=%s, valorRetornoSDJ=%s, valorRetornoFARPEN_SDJ=%s, tarifaRetornoFARPEN_SDJ=%s WHERE id=%s",
					   GetSQLValueString("4", "int"),
					   GetSQLValueString("23,62", "text"),
  					   GetSQLValueString("0,36", "text"),
					   GetSQLValueString("2,80", "text"),
					   GetSQLValueString($row_rsG['id'], "int"));
					
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
					
					echo "atualizando guia id: ".$row_rsG['id']."<br>";

 } ;  */
echo "<BR>--------------------------------------------<BR>";
echo "Total de linhas: ".$linhasA."<br>Linhas válidas: ".($linhasA - 4)."<br>Numero de linhas T: ".$linhaT."<BR>Numero de linhas U: ".$linhaU."<br>Valor total do farpen no arquivo: R$ ". number_format($TotalFarpen, 2, ",", ".")."<br>registros FARPEM: ".$nFemo."<br>registros FarpenDist: ".$nFdist;
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
$_SESSION['t'] = $_GET['cont'] - 1;
echo $_SESSION['t'];


} ?>


		<script language="javascript" type="text/javascript" ?>
		window.opener.location.reload();
		window.close();
		</script>
		
