<?php require_once('../../Connections/Emolumentos.php'); ?><?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" ) { ?>
	<script language="javascript" type="text/javascript" ?>
		window.close()
	</script> 
<?
echo "Pagina Restrita";
} else {


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

if (isset($_GET['id'])) { 
$id = $_GET['id'];
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsUsuario = "SELECT usuarios.id, usuarios.nome, usuarios.bloc FROM usuarios WHERE usuarios.id = '$id'";
$rsUsuario = mysql_query($query_rsUsuario, $Emolumentos) or die(mysql_error());
$row_rsUsuario = mysql_fetch_assoc($rsUsuario);
$totalRows_rsUsuario = mysql_num_rows($rsUsuario);
}
if (isset($_POST['res']) && $_POST['res'] == "Sim") {



if ((isset($_POST["oq"])) && ($_POST["oq"] == "1")) {

  $updateSQL = sprintf("UPDATE usuarios SET bloc=%s WHERE id=%s",
                       GetSQLValueString($_POST['oq'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
  ?>
<script language="javascript" type="text/javascript" ?>
window.opener.location.reload();
window.alert('Usuário bloqueado!');
window.close();
</script>
<?
}
if ((isset($_POST["oq"])) && ($_POST["oq"] == "0")) {

  $updateSQL = sprintf("UPDATE usuarios SET bloc=%s WHERE id=%s",
                       GetSQLValueString($_POST['oq'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
  ?>
<script language="javascript" type="text/javascript" ?>
window.opener.location.reload();
window.alert('Usuário desbloqueado!');
window.close();
</script>
<?
}

}


if (isset($_POST['res']) && $_POST['res'] != "Sim") {

  ?>
<script language="javascript" type="text/javascript" ?>
//window.opener.location.reload();
window.close();
</script>
<?


}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language=JavaScript type=text/javascript src='../js/form.js'></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Usuarios</title>
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
<div align="center">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" align="left" valign="middle" background="../imagens/topo.jpg">
        
        <div align="left">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="55">
                <script type="text/javascript" src="../js/swfobject.js"></script>
	<div id="flashcontent"></div>
	<script type="text/javascript">
          // <![CDATA[
		var so = new SWFObject("../topoP.swf", "sotester", "55", "55", "8.0.23", "#FFFFFF");
		//so.addVariable("flashVarText", "this is passed in via FlashVars"); // this line is optional, but this example uses the variable and displays this text inside the flash movie
		so.addParam("wmode", "transparent");
        so.addParam("menu", "false");
		so.write("flashcontent");
			
           // ]]>
    </script>
              </td>
              <td width="1388">
                <div align="center" class="TituloPagina">
                  <div align="left">&nbsp;&nbsp;&nbsp;Bloquear usu&aacute;rio </div>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <table width="250"  border="0" cellspacing="1" cellpadding="0">
<tr>
            <td height="7"></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">
              <form action="<?php echo $editFormAction; ?>" method="post" name="bloc" id="bloc">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><? if ($_GET['oq'] == "1") { ?><div align="center" class="TituloNoticia2">Deseja realmente bloquear o usu&aacute;rio <span class="Erro1"><?php echo $row_rsUsuario['nome']; ?></span>?</div>
                      <? } else { ?>
                      <div align="center" class="TituloNoticia2">Deseja desbloquear o usu&aacute;rio <span class="Erro1"><?php echo $row_rsUsuario['nome']; ?></span>?</div>
                      <? } ?></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><div align="center">
                          
                          <input name="res" type="submit" class="Formulario" id="res" value="Sim" />
                          
                          <input name="id" type="hidden" id="id" value="<?php echo $row_rsUsuario['id']; ?>" />
                          <input name="oq" type="hidden" id="oq" value="<? echo $_GET['oq']; ?>" />
                        </div></td>
                        <td><div align="center">
                          
                          <input name="res" type="submit" class="Formulario" id="res" value="N&atilde;o" />
                          
</div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
              </form>            </td>
          </tr>
          
        </table>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
<? } ?>