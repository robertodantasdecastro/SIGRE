<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" ) {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
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

<body><table bgcolor="#DFE1F9" width="710" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td><? if ($_GET['tipo'] == "distribuidor") { $caminho = "../../distribuidor/"; } else  if ($_GET['tipo'] == "farpen") { $caminho = "../../dados/farpen/"; }
$dir = opendir($caminho); 
while ($i = readdir($dir)) { ?><table bgcolor="#FFFFFF" width="710" border="0" cellspacing="1" cellpadding="1">
  <tr>
   <?
   if ($_GET['tipo'] == "distribuidor") {
   $arquivoEntidade = substr ($i, 0, 3);
   $arquivoEntidade = number_format($arquivoEntidade, 0, "", "");
//   echo $arquivoEntidade.$idsLog;
   if ($arquivoEntidade == $idsLog) {
if(!preg_match('/^\./',$i) && strstr($i,'.txt')) {
echo "<td class=\"texto\">".$i."</td>"."<td width=\"20\"><a href=\"salvarArquivo.php?arquivo=".$i."\"><img src=\"../imagens/gerarArquivoP.jpg\" alt=\"Baixar arquivo\" width=\"20\" height=\"20\" border=\"0\" /></a></td>";	
}}

}else {
if(!preg_match('/^\./',$i) && strstr($i,'.txt')) {
echo "<td class=\"texto\">".$i."</td>"."<td width=\"20\"><a href=\"salvarArquivo.php?arquivo=".$i."&onde=farpen\"><img src=\"../imagens/gerarArquivoP.jpg\" alt=\"Baixar arquivo\" width=\"20\" height=\"20\" border=\"0\" /></a></td>";	}
}
	 ?>
  </tr>
</table><? }
closedir($dir); 
?></td>
  </tr>
</table>


</body>
</html>
<? } ?>