<?
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso != 1) {
	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
}else {
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
$caminho = "../../arquivos"; 
$dir = opendir($caminho); 
while ($i = readdir($dir)) { 



if(!preg_match('/^\./',$i) && strstr($i,'.txt')) {
echo "$i<BR><BR>";	
?>


<?php


$qt1 = 0;
$qt2 = 0;
$n = 0;
$distErro = 0;
if (isset($i)) {
$nomeFile = "../../dados/".$i;
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
<? if (isset($i)) {?>
<table width="710" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td  bgcolor="#DCE0E9"><? while ($scanear = fscanf ($arquivo, "%s\t%s\t%s\t%s\t%s\n")) { ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
		   <span class="texto">
            <? 
	list ($n1, $n2, $n3, $n4, $n5) = $scanear;
   $TipoDetalhe = substr($n1, 13, 1);
 $n = $n + 1;
	if ($TipoDetalhe == "T") {
		$_SESSION['convenio'] = substr($n3, 0, 7);
		$id_entiR = substr($n3, 7, 3);
		$anoR = substr($n3, 10, 2);
		$anoR2 = $anoR;
		$anoR = "20".$anoR;
		$numeroR = substr($n3, 12, 5);
			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FGFGFG\"> Número do documento: &nbsp;&nbsp;".$_SESSION['convenio'].".".$id_entiR.".".$anoR2.".".$numeroR."</td>";
			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FGFGFG\">".$_SESSION['convenio']."</td>";
			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FGFGFG\">".$id_entiR."</td>";
			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FGFGFG\">".$anoR."</td>";
			$linha = "0";
			$qt2 = $qt2 + 1;
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsGuiasRetorno = "SELECT * FROM guias WHERE guias.id_entidade = '$id_entiR' AND guias.ano = '$anoR' AND guias.numero = '$numeroR'";
			$rsGuiasRetorno = mysql_query($query_rsGuiasRetorno, $Emolumentos) or die(mysql_error());
			$row_rsGuiasRetorno = mysql_fetch_assoc($rsGuiasRetorno);
			$totalRows_rsGuiasRetorno = mysql_num_rows($rsGuiasRetorno);
			$_SESSION['id_guiaRetorno'] = $row_rsGuiasRetorno['id'];
			$_SESSION['id_enti'] = $row_rsGuiasRetorno['id_entidade'];
			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FGFGFG\"> gia encontrada: ".$totalRows_rsGuiasRetorno."</td>";
//			if ($totalRows_rsGuiasRetorno >= 1) {  }  //texto 
			
			
		if (isset($_SESSION['convenio']) && $_SESSION['convenio'] == "1275763"){
		$qt1 = $qt1+1;
			echo "<td align=\"rigth\" calss=\"texto\" bgcolor=\"FLFLFL\"> FARPEN</td>";
		}
	}

	if ($TipoDetalhe == "U") {
		
		$diaPG = substr($n2, 130, 2);
		$mesPG = substr($n2, 132, 2);
		$anoPG = substr($n2, 134, 4);
		$vp = substr($n2, 64, 13);
		$vp1 = substr($vp, -2);
		$vp2 = substr($vp, -5, 3);
		$vp3 = substr($vp, -8, 3);
		if ($vp3 > 0) { $valorComp = $vp3.$vp2.".".$vp1; } else 
		if ($vp2 > 0) { $valorComp = $vp2.".".$vp1; } else 
		if ($vp1 > 0) { $valorComp = "0.".$vp1; }
		$valorComp = number_format($valorComp, 2, ",", ".");
		$convenio = $_SESSION['convenio'];
		$idGuia = $_SESSION['id_guiaRetorno'];
		$idEntidade = $_SESSION['id_enti'];
		$d = $ano."-".$mes."-".$dia;			
		$d2 = $anoPG."-".$mesPG."-".$diaPG;	
		echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FFFFFF\"> Valor: ".$valorComp." id guia: ".$idGuia."<td>";
//		if (isset($_SESSION['convenio']) && $_SESSION['convenio'] != "1275763"){
					
			
			if ($convenio == "1275763"){

				
				$valorComp = fc ($valorComp);
				$valorFarpen = $valorComp + ($valorComp * (5/100));
				$valorFarpenFormat = number_format ($valorFarpen, 2, ",", ".");
				if ($idEntidade == 0) {
					$distErro = $distErro + 1;
					echo "Guia de distribuição repedita, ------ VALOR: R$ ".$valorFarpenFormat;
				} else {
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsEntiConvenio1 = "SELECT * FROM `entidades` WHERE id = '$idEntidade'";
				$rsEntiConvenio1 = mysql_query($query_rsEntiConvenio1, $Emolumentos) or die(mysql_error());
				$row_rsEntiConvenio1 = mysql_fetch_assoc($rsEntiConvenio1);
				$totalRows_rsEntiConvenio1 = mysql_num_rows($rsEntiConvenio1);
				
							
					$updateSQL = sprintf("UPDATE guias SET situacaoFarpen=%s, dataMovFarpen=%s, dataAtulizacao=%s, valorRetornoFARPEN=%s, nomeArquivo=%s, linhaFarpen=%s WHERE id=%s",
					   GetSQLValueString("4", "int"),
					   GetSQLValueString($d2, "date"),
					   GetSQLValueString($d, "date"),
					   GetSQLValueString($valorComp, "text"),
					   GetSQLValueString($i, "text"),
					   GetSQLValueString($n, "text"),
					   GetSQLValueString($idGuia, "int"));
				
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
				
					echo "<td align=\"left\" calss=\"texto\" bgcolor=\"#ECDCD5\"> atualizado guia de serviço notarial CONVENIO FARPEN id:".$idEntidade." <br>entidade: ".$row_rsEntiConvenio1['nome']."<br>id guia: ".$idGuia."</td>";
				
				}
				
				
					$linha = "1";
			
			} 
			
			
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsEntiConvenioSDT = "SELECT * FROM `entidades` WHERE convenio = '$convenio' AND tipo = 'SDT'";
			$rsEntiConvenioSDT = mysql_query($query_rsEntiConvenioSDT, $Emolumentos) or die(mysql_error());
			$row_rsEntiConvenioSDT = mysql_fetch_assoc($rsEntiConvenioSDT);
			$totalRows_rsEntiConvenioSDT = mysql_num_rows($rsEntiConvenioSDT);


			if ($totalRows_rsEntiConvenioSDT >= 1) {
			
			$updateSQL = sprintf("UPDATE guias SET situacaoSDJ=%s, dataMovSDJ=%s, dataAtulizacao=%s, valorRetornoSDJ=%s, nomeArquivo=%s, linhaSDJ=%s WHERE id=%s",
					   GetSQLValueString("4", "int"),
					   GetSQLValueString($d2, "date"),
					   GetSQLValueString($d, "date"),
					   GetSQLValueString($valorComp, "text"),
					   GetSQLValueString($i, "text"),
					   GetSQLValueString($n, "text"),
					   GetSQLValueString($idGuia, "int"));
					
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
					
					echo "<td align=\"left\" calss=\"texto\" bgcolor=\"#E1F7E4\"> atualizado guia de serviço de DISTRIBUIDOR id:".$row_rsEntiConvenioSDT['id']."<br>entidade: ".$row_rsEntiConvenioSDT['nome']."<td>";
			
			}
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsEntiConvenio1 = "SELECT * FROM `entidades` WHERE id = '$idEntidade' AND convenio = '$convenio'";
			$rsEntiConvenio1 = mysql_query($query_rsEntiConvenio1, $Emolumentos) or die(mysql_error());
			$row_rsEntiConvenio1 = mysql_fetch_assoc($rsEntiConvenio1);
			$totalRows_rsEntiConvenio1 = mysql_num_rows($rsEntiConvenio1);

			if ($totalRows_rsEntiConvenio1 >= 1) {
				if ($valorComp > 0 && $valorComp != "") {
					$updateSQL = sprintf("UPDATE guias SET situacaoEmolumento=%s, dataMovEmolumento=%s, dataAtulizacao=%s, valorRetornoEmo=%s, nomeArquivo=%s, linhaEmo=%s WHERE id=%s",
					   GetSQLValueString("4", "int"),
					   GetSQLValueString($d2, "date"),
					   GetSQLValueString($d, "date"),
					   GetSQLValueString($valorComp, "text"),
					   GetSQLValueString($i, "text"),
					   GetSQLValueString($n, "text"),
					   GetSQLValueString($idGuia, "int"));
					
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
					
					echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FFFFFF\"> atualizado guia de serviço notarial id:".$idEntidade."<br>entidade: ".$row_rsEntiConvenio1['nome']."<td>";			
				} else {
					echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FF0000\"> NAO ATUALIZOU serviço notarial id:".$idEntidade."<br>entidade: ".$row_rsEntiConvenio1['nome']."<td>";			
				}
			}
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsEntiConvenio2 = "SELECT * FROM `entidades` WHERE id = '$idEntidade' AND convenio2 = '$convenio'";
			$rsEntiConvenio2 = mysql_query($query_rsEntiConvenio2, $Emolumentos) or die(mysql_error());
			$row_rsEntiConvenio2 = mysql_fetch_assoc($rsEntiConvenio2);
			$totalRows_rsEntiConvenio2 = mysql_num_rows($rsEntiConvenio2);
				
			if ($totalRows_rsEntiConvenio2 >= "1") {
				
				$updateSQL = sprintf("UPDATE guias SET dataMovFarpen=%s, dataAtulizacao=%s, valorRetornoFARPEN_emoCred=%s, nomeArquivo=%s, linhaFARPEN2=%s WHERE id=%s",
//				   GetSQLValueString("4", "int"),
				   GetSQLValueString($d2, "date"),
				   GetSQLValueString($d, "date"),
				   GetSQLValueString($valorComp, "text"),
				   GetSQLValueString($i, "text"),
				   GetSQLValueString($n, "text"),
				   GetSQLValueString($idGuia, "int"));
				
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
				
				echo "<td align=\"left\" calss=\"texto\" bgcolor=\"#8080FF\"> atualizado guia de farpen id:".$idEntidade."<br>entidade: ".$row_rsEntiConvenio2['nome']."<td>";
				
			}

			$linha = "1";
			echo "<td align=\"left\" calss=\"texto\" bgcolor=\"FFFFFF\"> Data do pagamento: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$diaPG."/".$mesPG."/".$anoPG."</td>";
	}
	
	
  
   ?>
          </span> </tr>
          <? if (isset($linha) && $linha == "1") { ?>
          <tr>
            <td bgcolor="#DCE0E9" height="1"></td>
          </tr>
          <? } ?>
        </table>
        <span class="texto">
      <? } 
		  $n = $n / 2 - 2;
echo "Registros FARPEN com defeito encontrado: ".$distErro."<BR>";
echo "Registros nao farpen = ".$qt1."<BR>";
echo "Regiostros farpen = ".$qt2."<BR>";
echo "Encontrato ".$n." Registro";
fclose($arquivo);


mysql_select_db($database_Emolumentos, $Emolumentos);
//$query_rsG = "SELECT * FROM `guias` WHERE situacaoSDJ = '4' AND valorSDT = '24,70' AND tipo = 'Escritura'";
$query_rsG = "SELECT * FROM guias WHERE guias.situacaoEmolumento = '4' AND guias.situacaoSDJ = '2' AND guias.tipo = 'Escritura'";
$rsG = mysql_query($query_rsG, $Emolumentos) or die(mysql_error());
$row_rsG = mysql_fetch_assoc($rsG);
$totalRows_rsG = mysql_num_rows($rsG);


echo "Foram encontradas ".$totalRows_rsG." guias<br><br><br>";
do { 
$updateSQL = sprintf("UPDATE guias SET situacaoSDJ=%s, valorRetornoSDJ=%s, valorRetornoFARPEN_SDJ=%s WHERE id=%s",
					   GetSQLValueString("4", "int"),
					   GetSQLValueString("23,62", "text"),
  					   GetSQLValueString("0,36", "text"),
					   GetSQLValueString($row_rsG['id'], "int"));
					
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
					
					echo "atualizando guia id: ".$row_rsG['id']."<br>";

 } while ($row_rsG = mysql_fetch_assoc($rsG)); 


?></span></td>
  </tr>
</table>
<? } else { ?><table width="710" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto"><?


$caminho = "../../dados/";
$dir = opendir($caminho); 
while ($i = readdir($dir)) {
if(!preg_match('/^\./',$i) && strstr($i,'.txt')) {
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



}


}
closedir($dir); 
}


?>