<?php require_once('../../Connections/Emolumentos.php'); ?>
<?php
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
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsFarpen = "SELECT * FROM farpen ORDER BY id ASC";
$rsFarpen = mysql_query($query_rsFarpen, $Emolumentos) or die(mysql_error());
$row_rsFarpen = mysql_fetch_assoc($rsFarpen);
$totalRows_rsFarpen = mysql_num_rows($rsFarpen);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
$qtd = $totalRows_rsFarpen;
for ($i = 1; $i <= $qtd; $i++) {
$valor = $_POST["valor".$i];
$updateSQL = sprintf("UPDATE farpen SET valor=%s WHERE id=%s",
                       GetSQLValueString($valor, "text"),
                       GetSQLValueString($i, "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
}
  ?>
<script language="javascript" type="text/javascript" ?>
window.alert('Dados Alterados!');
//window.close();
</script>
<?
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsFarpen = "SELECT * FROM farpen ORDER BY id ASC";
$rsFarpen = mysql_query($query_rsFarpen, $Emolumentos) or die(mysql_error());
$row_rsFarpen = mysql_fetch_assoc($rsFarpen);
$totalRows_rsFarpen = mysql_num_rows($rsFarpen);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language=JavaScript type=text/javascript src='../js/form.js'></script>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Farpen</title>
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
<form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table width="218" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="5" class="texto"></td>
    </tr>
    <tr>
      <td>
        <div align="right">
          <?php do { ?>
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td width="123" bgcolor="#FFFFFF" class="texto">
                  <div align="right">&nbsp;&nbsp;<?php echo $row_rsFarpen['descricao']; ?>:</div>
                </td>
                <td width="92" bgcolor="#FFFFFF" class="texto">
                  <div align="left">&nbsp;R$ 
                    <input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="valor<? echo  $row_rsFarpen['id']; ?>" type="text" class="Formulario" id="valor<? echo $row_rsFarpen['id']; ?>" value="<?php echo $row_rsFarpen['valor']; ?>" size="8" />
                    <input name="id" type="hidden" id="id" />
                  </div>
                </td>
              </tr>
            </table>
            <?php } while ($row_rsFarpen = mysql_fetch_assoc($rsFarpen)); ?>
          <input name="imageField" type="image" src="../imagens/salvar.gif" alt="Salvar" />
&nbsp;&nbsp;&nbsp;&nbsp; </div>
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
</form>
</body>
</html>

<? } ?>