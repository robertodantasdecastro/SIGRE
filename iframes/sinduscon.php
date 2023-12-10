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

//atualizar


if ((isset($_POST["atualizar"])) && ($_POST["atualizar"] == "ok")) {

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsSinduscon = "SELECT * FROM sindusconres";
$rsSinduscon = mysql_query($query_rsSinduscon, $Emolumentos) or die(mysql_error());
$row_rsSinduscon = mysql_fetch_assoc($rsSinduscon);
$totalRows_rsSinduscon = mysql_num_rows($rsSinduscon);

$qtd = $totalRows_rsSinduscon;
for ($i = 1; $i <= $qtd; $i++) {
$baixo = $_POST["baixo".$i];
$normal = $_POST["normal".$i];
$alto = $_POST["alto".$i];
$updateSQL = sprintf("UPDATE sindusconres SET baixo=%s, normal=%s, alto=%s WHERE id=%s",
                       GetSQLValueString($baixo, "text"),
                       GetSQLValueString($normal, "text"),
                       GetSQLValueString($alto, "text"),
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
}
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsSinduscon = "SELECT * FROM sindusconres";
$rsSinduscon = mysql_query($query_rsSinduscon, $Emolumentos) or die(mysql_error());
$row_rsSinduscon = mysql_fetch_assoc($rsSinduscon);
$totalRows_rsSinduscon = mysql_num_rows($rsSinduscon);
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
<form id="form1" name="form1" method="POST">
  <table width="428" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr bgcolor="#EEEEF7">
          <td><table width="100%" height="30" border="0" cellpadding="0" cellspacing="1">
            <tr>
              <td width="125" align="center" valign="middle" bgcolor="#F2F2F2" class="TituloNoticia1">Pavimentos</td>
              <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td bgcolor="#F2F2F2"><div align="center" class="TituloNoticia1">Padr&atilde;o de constru&ccedil;&atilde;o </div></td>
                  </tr>
                  <tr>
                    <td bgcolor="#EEEEF7"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                          <td bgcolor="#F8F8F8" class="TituloNoticia1"><div align="center">Baixo</div></td>
                          <td width="95" bgcolor="#F8F8F8" class="TituloNoticia1"><div align="center">Normal</div></td>
                          <td width="105" bgcolor="#F8F8F8" class="TituloNoticia1"><div align="center">Alto</div></td>
                        </tr>
                    </table></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td bgcolor="#EEEEF7"><?php do { ?>
              <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td width="125" bgcolor="#FFFFFF"><div align="center"><span class="texto"><?php echo $row_rsSinduscon['pavimentos']; ?></span></div></td>
                  <td bgcolor="#FFFFFF"><div align="center" class="texto">R$
                      
                      <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="baixo<?php echo $row_rsSinduscon['id']; ?>" type="text" class="Formulario" id="baixo<?php echo $row_rsSinduscon['id']; ?>" value="<?php echo $row_rsSinduscon['baixo']; ?>" size="10" />
                      
                    </div></td>
                  <td width="95" bgcolor="#FFFFFF"><div align="center" class="texto">
                    <div align="left">&nbsp;R$
                      <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="normal<?php echo $row_rsSinduscon['id']; ?>" type="text" class="Formulario" id="normal<?php echo $row_rsSinduscon['id']; ?>" value="<?php echo $row_rsSinduscon['normal']; ?>" size="10" />
                      </div>
                  </div></td>
                  <td width="105" bgcolor="#FFFFFF"><div align="center" class="texto">
                    <div align="left">&nbsp;R$
                      <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="alto<?php echo $row_rsSinduscon['id']; ?>" type="text" class="Formulario" id="alto<?php echo $row_rsSinduscon['id']; ?>" value="<?php echo $row_rsSinduscon['alto']; ?>" size="10" />
                    </div>
                  </div></td>
                </tr>
                            </table>
              <?php } while ($row_rsSinduscon = mysql_fetch_assoc($rsSinduscon)); ?></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="2"></td>
    </tr>
    <tr>
      <td valign="top" class="texto">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="77%" valign="top" class="texto">&nbsp;</td>
            <td width="23%">
              <div align="center">
                <input name="atualizar" type="hidden" id="atualizar" value="ok" />
                <input name="Salvar" type="image" id="Salvar" onBlur="javascript:formataValorDigitado(this);" onKeyUp="javascript:formataValorDigitado(this);" src="../imagens/salvar.gif" alt="Salvar" />
              </div>            </td>
          </tr>
        </table>      </td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($rsSinduscon);
?>

<? } ?>