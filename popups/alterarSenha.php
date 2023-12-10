<?php require_once('../../Connections/Emolumentos.php'); ?><?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" ) { ?>
	<script language="javascript" type="text/javascript" ?>
		window.close()
	</script> 
<?
echo "Pagina Restrita";
} else {
	include ('../../core/crypt.php');

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


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "UpdtSenha")) {
if($_POST['NovaSenha'] == $_POST['ReNovaSenha'] && (isset($_POST['Senha_Antiga']))){

	$pass_string = $_POST['Senha_Antiga'];
	$pass_Antigo = md5(cript($pass_string));
//	$pass_Antigo = $_POST['Senha_Antiga'];
	if($_SESSION['senha'] == $pass_Antigo){
		$pass_string = $_POST['ReNovaSenha'];
//		$pass_Novo = $_POST['ReNovaSenha'];
		$pass_Novo = md5(cript($pass_string));
		$updateSQL = sprintf("UPDATE usuarios SET senha=%s WHERE id=%s",
                       GetSQLValueString($pass_Novo, "text"),
                       GetSQLValueString($row_rsLogin['id'], "int"));
					   mysql_select_db($database_Emolumentos, $Emolumentos);
					   $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
					   $erross = "0";
					   $_SESSION['senha'] = $pass_Novo;
					   $_SESSION['erro'] = "Senha alterada!";
	} else {
	$erross = "1";
	$_SESSION['erro'] = "A senha antiga não confere!";
	}
} else {
	$_SESSION['erro'] = "A nova senha não confere com a nova senha repetida";
	$erross = "2";
}
}
?>
<?
if (isset($_SESSION['erro']) && $_SESSION['erro'] != false) { ?><script language="javascript" type="text/javascript"> window.alert('<? echo $_SESSION['erro'] ?>'); </script><?
$_SESSION['erro'] = false; 
if (isset($erross) && $erross == "0") { $erross=false; ?><script language="javascript" type="text/javascript">window.close();</script><? } 
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
                              <div align="left" class="TituloPagina">Alterar senha </div>
                             </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <table width="290"  border="0" cellspacing="1" cellpadding="0">

          <tr>
            <td bgcolor="#FFFFFF">
              <form action="<?php echo $editFormAction; ?>" method="post" name="UpdtSenha" id="UpdtSenha">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="TituloNoticia2">
                      <div align="right">Senha antiga:&nbsp;</div>
                    </td>
                    <td>
                      <input name="Senha_Antiga" type="password" <? if (!isset($erross)) { ?>class="Formulario"<? } elseif ($erross == "1") { ?>class="FormularioErro" <? } elseif ($erross == "2"){ ?> class="Formulario"<? } ?>id="Senha_Antiga">
                    </td>
                  </tr>
                  <tr>
                    <td height="3" class="TituloNoticia2"></td>
                    <td height="3"></td>
                  </tr>
                  <tr>
                    <td class="TituloNoticia2">
                      <div align="right">Nova senha:&nbsp;</div>
                    </td>
                    <td>
                    <input name="NovaSenha" type="password" <? if (!isset($erross)) { ?>class="Formulario"<? } elseif ($erross == "2") { ?>class="FormularioErro" <? } elseif ($erross == "1"){ ?> class="Formulario"<? } ?> id="NovaSenha">
                    </td>
                  </tr>
                  <tr>
                    <td class="TituloNoticia2">
                      <div align="right">Confirma&ccedil;&atilde;o da nova senha: </div>
                    </td>
                    <td>
                     <input name="ReNovaSenha" type="password" <? if (!isset($erross)) { ?>class="Formulario"<? } elseif ($erross == "2") { ?>class="FormularioErro" <? } elseif ($erross == "1"){ ?> class="Formulario"<? } ?>  id="ReNovaSenha">
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="45">
                      <div align="right">
                        <input name="id" type="hidden" id="id" value="<? echo $row_rsLogin['id']; ?>" />
                        <input name="imageField" type="image" src="../imagens/salvar.gif" alt="Salvar" />
                      </div>
                    </td>
                  </tr>
                </table>
                <input type="hidden" name="MM_update" value="UpdtSenha" />
              </form>
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