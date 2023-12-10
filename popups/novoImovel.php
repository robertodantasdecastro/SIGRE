<?php require_once('../../Connections/Emolumentos.php'); ?><?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso != 1) {
?>	<script language="javascript" type="text/javascript">
		window.close();
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
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "imovel")) {
  $updateSQL = sprintf("UPDATE tipoimovel SET nome=%s WHERE id=%s",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
    ?>
  <script language="javascript" type="text/javascript">
		window.opener.location.reload();
window.alert('Tipo de imovel atualizado!');
window.close();
	</script>
	<?
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "imovel")) {
  $insertSQL = sprintf("INSERT INTO tipoimovel (nome) VALUES (%s)",
                       GetSQLValueString($_POST['nome'], "text"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
  ?>
  <script language="javascript" type="text/javascript">
		window.opener.location.reload();
window.alert('Tipo de imovel adicionado!');
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
<title>Tipos de im&oacute;veis</title>
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
              <td width="100">
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
              <td>
                <div align="center" class="TituloPagina">Tipo de im&oacute;vel  </div>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <table width="245"  border="0" cellspacing="1" cellpadding="0">

          <tr>
            <td bgcolor="#FFFFFF">
<? if (!isset($_GET['id'])){ ?><form action="<?php echo $editFormAction; ?>" method="POST" name="imovel" id="UpdtSenha">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="TituloNoticia2">
                      <div align="right">Tipo de imovel :&nbsp;</div>
                    </td>
                    <td>
                      <div align="left">
                        <input name="nome" onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" type="text" class="Formulario" id="nome" <? if (!isset($erross)) { ?>class="Formulario"<? } elseif ($erross == "1") { ?>class="FormularioErro" <? } elseif ($erross == "2"){ ?><? } ?>id="Senha_Antiga">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td height="3" class="TituloNoticia2"></td>
                    <td height="3"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="45">
                      <div align="right">
                        <input name="imageField" type="image" src="../imagens/salvar.gif" alt="Salvar" />
                      </div>
                    </td>
                  </tr>
                </table>
                <input type="hidden" name="MM_insert" value="imovel">
              </form><? } else { mysql_select_db($database_Emolumentos, $Emolumentos);
			  $id= $_GET['id'];
$query_rsTipoImovel = "SELECT * FROM tipoimovel WHERE tipoimovel.id = '$id'";
$rsTipoImovel = mysql_query($query_rsTipoImovel, $Emolumentos) or die(mysql_error());
$row_rsTipoImovel = mysql_fetch_assoc($rsTipoImovel);
$totalRows_rsTipoImovel = mysql_num_rows($rsTipoImovel); ?><form action="<?php echo $editFormAction; ?>" method="POST" name="imovel" id="UpdtSenha">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="TituloNoticia2">
                      <div align="right">Tipo de imovel :&nbsp;</div>
                    </td>
                    <td>
                      <div align="left">
                        <input name="nome" onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" type="text" class="Formulario" id="nome" value="<? echo $row_rsTipoImovel['nome']; ?>" <? if (!isset($erross)) { ?>class="Formulario"<? } elseif ($erross == "1") { ?>class="FormularioErro" <? } elseif ($erross == "2"){ ?><? } ?>id="Senha_Antiga">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td height="3" class="TituloNoticia2"></td>
                    <td height="3"></td>
                  </tr>
                  <tr>
                    <td>
                      <input name="id" type="hidden" id="id" value="<?php echo $row_rsTipoImovel['id']; ?>" />
                      <input type="hidden" name="MM_update" value="imovel" />
</td>
                    <td height="45">
                      <div align="right">
                        <input name="imageField" type="image" src="../imagens/salvar.gif" alt="Salvar" />
                      </div>
                    </td>
                  </tr>
                </table>
                </form><? } ?>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
<? } ?>