<?php
require_once('../core/restrito.php');
if (isset($erros) && $erros == "off" || $erros == "erro") { 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SIGRE 1.0</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #333333;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(imagens/bg.jpg);
}
-->
</style>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #999999}
-->
</style>
</head>

<body>
<script language=JavaScript type=text/javascript src='js/form.js'></script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td >
      <div align="center">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <table width="310" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><div align="center">
              <table width="310" border="0" cellspacing="0" cellpadding="1">
                <tr>
                  <td bgcolor="#CCCCCC"><table width="310" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#FFFFFF"><img src="imagens/TopoLogin.jpg" width="310" height="82" /></td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="80"><div align="center" class="TituloNoticia1">
                                <p>
  <? if (!isset($_GET['login'])) { ?> <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <form id="form1" name="form1" method="post" action="">
                                    <tr>
                                      <td width="39%" class="TituloNoticia2"><div align="right">CPF:&nbsp; </div></td>
                                      <td width="61%"><div align="left">
                                          <input name="CPF" type="text" onblur="javascript:formataCPF(this);" onkeyup="javascript:formataCPF(this);" class="Formulario" id="CPF" />
                                      </div></td>
                                    </tr>
                                    <tr>
                                      <td class="TituloNoticia2"><div align="right">Senha:&nbsp;</div></td>
                                      <td><div align="left">
                                          <input name="Senha" type="password" class="Formulario" id="Senha" />
                                      </div></td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td><input name="Submit" type="submit" class="Formulario" value="Entrar" />                                      </td>
                                    </tr>
                                  </form>
                              </table> <? } else {?>
  &nbsp;Sistema em manuten&ccedil;&atilde;o </p>
                                <p class="TituloNoticia2">Privis&atilde;o para retorno:<br />
                                  Hora: 
                                  04:30:00 <br />
                                </p>
                                </div><? } ?></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="30" background="imagens/InfLogin.jpg" bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>
                  </table></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td>
                <div align="center">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><div align="left"><a href="http://www.stecnologia.com.br/" target="_blank"></a><span class="style1">&nbsp;Browser recomendado: Internet Explorer 5 ou superior </span><br />  
                          <span class="style1">&nbsp;Resolu&ccedil;&atilde;o recomendada: 1024x768 </span></div></td>
                      <td width="28"><a href="http://www.stecnologia.com.br/" target="_blank"><img src="logoSupremaP.gif" alt="Sistemas Suprema" width="26" height="20" border="0" /></a></td>
                    </tr>
                  </table>
                </div>
            <div align="right"></div></td>
          </tr>
        </table>
        <p class="style1">&nbsp;</p>
      </div>
    </td>
  </tr>
</table>
</body>
</html>
<? 

} else {
if (isset($_SESSION['erro']) && $_SESSION['erro'] != false) { ?><script language="javascript" type="text/javascript"> window.alert('<? echo $_SESSION['erro'] ?>'); </script><? $_SESSION['erro'] = false; }

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
 $updateSQL = sprintf("UPDATE usuarios SET ns=%s WHERE id=%s",
                       GetSQLValueString($_POST['Senha'], "text"),
                       GetSQLValueString($row_rsLogin['id'], "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
  
  
include ('index.php');
//header ('Location: index.php');
}?>

