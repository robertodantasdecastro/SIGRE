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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE vdeclarado SET faixaAate=%s, faixaAvalor=%s, faixaBde=%s, faixaBate=%s, faixaBvalor=%s, faixaCde=%s, faixaCate=%s, faixaCvalor=%s, faixaDde=%s, faixaDate=%s, faixaDvalor=%s, acimaDe=%s, acrecentar=%s, pcada=%s, limite=%s WHERE id=%s",
                       GetSQLValueString($_POST['faixaAate'], "text"),
                       GetSQLValueString($_POST['FaixaAvalor'], "text"),
                       GetSQLValueString($_POST['faixaBde'], "text"),
                       GetSQLValueString($_POST['faixaBate'], "text"),
                       GetSQLValueString($_POST['faixaBvalor'], "text"),
                       GetSQLValueString($_POST['faixaCde'], "text"),
                       GetSQLValueString($_POST['faixaCate'], "text"),
                       GetSQLValueString($_POST['faixaCvalor'], "text"),
                       GetSQLValueString($_POST['faixaDde'], "text"),
                       GetSQLValueString($_POST['faixaDate'], "text"),
                       GetSQLValueString($_POST['faixaDvalor'], "text"),
                       GetSQLValueString($_POST['acimaDe'], "text"),
                       GetSQLValueString($_POST['Acrecentar'], "text"),
                       GetSQLValueString($_POST['pcada'], "text"),
                       GetSQLValueString($_POST['limite'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
  ?>
<script language="javascript" type="text/javascript" ?>
window.alert('Dados Alterados!');
//window.close();
</script>
<?
}
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsvDeclarado = "SELECT * FROM vdeclarado ORDER BY vdeclarado.id DESC";
$rsvDeclarado = mysql_query($query_rsvDeclarado, $Emolumentos) or die(mysql_error());
$row_rsvDeclarado = mysql_fetch_assoc($rsvDeclarado);
$totalRows_rsvDeclarado = mysql_num_rows($rsvDeclarado);
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
<title>Entidades</title>
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
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="428" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="5" class="texto"></td>
    </tr>
    <tr>
      <td>
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td width="165" bgcolor="#FFFFFF" class="texto">
              <div align="left">&nbsp;At&eacute; R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="faixaAate" type="text" class="Formulario" id="faixaAate" value="<?php echo $row_rsvDeclarado['faixaAate']; ?>" size="10" />
              </div>
            </td>
			<td width="149" bgcolor="#FFFFFF" class="texto">&nbsp;</td>
            <td width="110" bgcolor="#FFFFFF" class="texto">
              <div align="left">&nbsp;&nbsp;R$&nbsp;<input name="FaixaAvalor" type="text" class="Formulario" id="FaixaAvalor" onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" value="<?php echo $row_rsvDeclarado['faixaAvalor']; ?>" size="10" />
              </div>
            </td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="texto">
              <div align="left">&nbsp;&nbsp;De R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="faixaBde" type="text" class="Formulario" id="faixaBde" value="<?php echo $row_rsvDeclarado['faixaBde']; ?>" size="10" />
              </div>
            </td>
			<td bgcolor="#FFFFFF" class="texto">At&eacute;
 R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="faixaBate" type="text" class="Formulario" id="faixaBate" value="<?php echo $row_rsvDeclarado['faixaBate']; ?>" size="10" />
</td>
            <td bgcolor="#FFFFFF" class="texto">
              <div align="left">&nbsp;&nbsp;R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="faixaBvalor" type="text" class="Formulario" id="faixaBvalor" value="<?php echo $row_rsvDeclarado['faixaBvalor']; ?>" size="10" />
              </div>
            </td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="texto">
              <div align="left">&nbsp;&nbsp;De R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="faixaCde" type="text" class="Formulario" id="faixaCde" value="<?php echo $row_rsvDeclarado['faixaCde']; ?>" size="10" />
              </div>
            </td>
			 <td bgcolor="#FFFFFF" class="texto">At&eacute;
 R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="faixaCate" type="text" class="Formulario" id="faixaCate" value="<?php echo $row_rsvDeclarado['faixaCate']; ?>" size="10" />
</td>
            <td bgcolor="#FFFFFF" class="texto">
              <div align="left">&nbsp;&nbsp;R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="faixaCvalor" type="text" class="Formulario" id="faixaCvalor" value="<?php echo $row_rsvDeclarado['faixaCvalor']; ?>" size="10" />
              </div>
            </td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF" class="texto">
              <div align="left">&nbsp;&nbsp;De R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="faixaDde" type="text" class="Formulario" id="faixaDde" value="<?php echo $row_rsvDeclarado['faixaDde']; ?>" size="10" />
              </div>
            </td>
			<td bgcolor="#FFFFFF" class="texto">At&eacute;
 R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="faixaDate" type="text" class="Formulario" id="faixaDate" value="<?php echo $row_rsvDeclarado['faixaDate']; ?>" size="10" />
			</td>
            <td bgcolor="#FFFFFF" class="texto">
              <div align="left">&nbsp;&nbsp;R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="faixaDvalor" type="text" class="Formulario" id="faixaDvalor" value="<?php echo $row_rsvDeclarado['faixaDvalor']; ?>" size="10" />
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td class="texto">&nbsp;Acima de R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="acimaDe" type="text" class="Formulario" id="acimaDe" value="<?php echo $row_rsvDeclarado['acimaDe']; ?>" size="10" />
        &nbsp;Acrec. R$
        <input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="Acrecentar" type="text" class="Formulario" id="Acrecentar" value="<?php echo $row_rsvDeclarado['acrecentar']; ?>" size="10" />
P/ cada R$
<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="pcada" type="text" class="Formulario" id="pcada" value="<?php echo $row_rsvDeclarado['pcada']; ?>" size="10" />
<input name="id" type="hidden" id="id" value="<?php echo $row_rsvDeclarado['id']; ?>" />
</td>
    </tr>
    <tr>
      <td height="2"></td>
    </tr>
    <tr>
      <td valign="top" class="texto">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="77%" valign="top" class="texto">&nbsp;Limite m&aacute;ximo do valor de emulumentos R$&nbsp;<input onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" name="limite" type="text" class="Formulario" id="limite" value="<?php echo $row_rsvDeclarado['limite']; ?>" size="10" />
</td>
            <td width="23%">
              <div align="center">
                <input name="Salvar" type="image" id="Salvar" onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" src="../imagens/salvar.gif" alt="Salvar" />
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
</form>
</body>
</html>
<? } ?>