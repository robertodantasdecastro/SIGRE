<?php require_once('../../Connections/Emolumentos.php'); ?><?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || ($acesso == 3 || $acesso == 5)) { ?>
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

if ($acesso == 1) { 

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "cadastro")) {
$ids=$_POST['id_site'];
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsTipoAcesso = "SELECT entidades.id, entidades.tipo FROM entidades WHERE entidades.id = '$ids'";
$rsTipoAcesso = mysql_query($query_rsTipoAcesso, $Emolumentos) or die(mysql_error());
$row_rsTipoAcesso = mysql_fetch_assoc($rsTipoAcesso);
$totalRows_rsTipoAcesso = mysql_num_rows($rsTipoAcesso);
$string=$_POST['senha'];
$crpt_string=md5(cript($string));
if ($row_rsTipoAcesso['tipo'] == "SN") { $Nacesso = "2"; } else if ($row_rsTipoAcesso['tipo'] == "SDT") { $Nacesso = "4"; } else if ($row_rsTipoAcesso['tipo'] == "FARPEN") { $Nacesso = "6"; }

  $insertSQL = sprintf("INSERT INTO usuarios (id_site, nome, CPF, telefones, endereco, cargo, senha, acesso) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_site'], "int"),
                       GetSQLValueString($_POST['Nome'], "text"),
                       GetSQLValueString($_POST['CPF'], "text"),
                       GetSQLValueString($_POST['telefones'], "text"),
                       GetSQLValueString($_POST['Endereco'], "text"),
                       GetSQLValueString($_POST['Cargo'], "text"),
                       GetSQLValueString($crpt_string, "text"),
                       GetSQLValueString($Nacesso, "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
?>
<script language="javascript" type="text/javascript" ?>
window.opener.location.reload();
window.alert('Usuário adicionado com sucesso');
window.close();
</script>
<? } 

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "Editar")) {
$string=$_POST['senha'];
$crpt_string=md5(cript($string));
  $updateSQL = sprintf("UPDATE usuarios SET id_site=%s, nome=%s, CPF=%s, telefones=%s, endereco=%s, cargo=%s, senha=%s, acesso=%s WHERE id=%s",
                       GetSQLValueString($_POST['id_site'], "int"),
                       GetSQLValueString($_POST['Nome'], "text"),
                       GetSQLValueString($_POST['CPF'], "text"),
                       GetSQLValueString($_POST['telefones'], "text"),
                       GetSQLValueString($_POST['Endereco'], "text"),
                       GetSQLValueString($_POST['Cargo'], "text"),
                       GetSQLValueString($crpt_string, "text"),
                       GetSQLValueString($_POST['acesso'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
  ?>
<script language="javascript" type="text/javascript" ?>
window.opener.location.reload();
window.alert('Dados Alterados!');
window.close();
</script>
<?
}
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsEntidades = "SELECT entidades.nome, entidades.id FROM entidades ORDER BY entidades.id ASC";
	$rsEntidades = mysql_query($query_rsEntidades, $Emolumentos) or die(mysql_error());
	$row_rsEntidades = mysql_fetch_assoc($rsEntidades);
	$totalRows_rsEntidades = mysql_num_rows($rsEntidades);

if (isset($_GET['id'])) { 
	$id_user = $_GET['id'];
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsUsuarioEdit = "SELECT * FROM usuarios WHERE usuarios.id = '$id_user'";
	$rsUsuarioEdit = mysql_query($query_rsUsuarioEdit, $Emolumentos) or die(mysql_error());
	$row_rsUsuarioEdit = mysql_fetch_assoc($rsUsuarioEdit);
	$totalRows_rsUsuarioEdit = mysql_num_rows($rsUsuarioEdit);
} 
} else if ($acesso == 2 || $acesso == 4 || $acesso == 6) {

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "cadastro")) {

mysql_select_db($database_Emolumentos, $Emolumentos);

$string=$_POST['senha'];
$crpt_string=md5(cript($string));
if ($row_rsTipoAcesso['tipo'] == "SN") { $Nacesso = "2"; } else if ($row_rsTipoAcesso['tipo'] == "SDT") { $Nacesso = "4"; } else if ($row_rsTipoAcesso['tipo'] == "FARPEN") { $Nacesso = "7"; }

  $insertSQL = sprintf("INSERT INTO usuarios (id_site, nome, CPF, telefones, endereco, cargo, senha, acesso) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($idsLogin, "int"),
                       GetSQLValueString($_POST['Nome'], "text"),
                       GetSQLValueString($_POST['CPF'], "text"),
                       GetSQLValueString($_POST['telefones'], "text"),
                       GetSQLValueString($_POST['Endereco'], "text"),
                       GetSQLValueString($_POST['Cargo'], "text"),
                       GetSQLValueString($crpt_string, "text"),
                       GetSQLValueString($_POST['acesso'], "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
?>
<script language="javascript" type="text/javascript" ?>
window.opener.location.reload();
window.alert('Usuário adicionado com sucesso');
window.close();
</script>
<? } 


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "Editar")) {
$string=$_POST['senha'];
$crpt_string=md5(cript($string));
  $updateSQL = sprintf("UPDATE usuarios SET id_site=%s, nome=%s, CPF=%s, telefones=%s, endereco=%s, cargo=%s, senha=%s, acesso=%s WHERE id=%s",
                       GetSQLValueString($_POST['id_site'], "int"),
                       GetSQLValueString($_POST['Nome'], "text"),
                       GetSQLValueString($_POST['CPF'], "text"),
                       GetSQLValueString($_POST['telefones'], "text"),
                       GetSQLValueString($_POST['Endereco'], "text"),
                       GetSQLValueString($_POST['Cargo'], "text"),
                       GetSQLValueString($crpt_string, "text"),
                       GetSQLValueString($_POST['acesso'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
  ?>
<script language="javascript" type="text/javascript" ?>
window.opener.location.reload();
window.alert('Dados Alterados!');
window.close();
</script>
<?
}


if (isset($_GET['id'])) { 
	$id_user = $_GET['id'];
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsUsuarioEdit = "SELECT * FROM usuarios WHERE usuarios.id = '$id_user'";
	$rsUsuarioEdit = mysql_query($query_rsUsuarioEdit, $Emolumentos) or die(mysql_error());
	$row_rsUsuarioEdit = mysql_fetch_assoc($rsUsuarioEdit);
	$totalRows_rsUsuarioEdit = mysql_num_rows($rsUsuarioEdit);
} 

}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                <div align="center" class="TituloPagina">Administra&ccedil;&atilde;o de usu&aacute;rio</div>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    <tr>
      <td>
       <? if (isset($_GET['oq']) && $_GET['oq'] == "novo") { ?>
       <form id="cadastro" name="cadastro" method="post" action="<?php echo $editFormAction; ?>">
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td>
               <div align="center">
                 <table width="391" border="0" cellspacing="0" cellpadding="0">
                   <tr>
                     <td>
                       <div align="center" class="TituloNoticia1">Inserir usu&aacute;rio </div>
                     </td>
                   </tr>
                   <tr>
                     <td>
                       <div align="center">
                         <table width="100%" border="0" cellspacing="5" cellpadding="0">
                           <? if ($acesso == 1) { ?><tr>
                             <td width="31%" class="SubTitulo">
                               <div align="right">Entidade:</div>
                             </td>
                             <td width="69%">
                               <? if (!isset($_GET['entidade'])) { ?><div align="left">
                                 <select name="id_site" class="Formulario" id="id_site">
                                   <?php
do {  
?>
                                   <option value="<?php echo $row_rsEntidades['id']?>"><?php echo $row_rsEntidades['nome']?></option>
                                   <?php
} while ($row_rsEntidades = mysql_fetch_assoc($rsEntidades));
  $rows = mysql_num_rows($rsEntidades);
  if($rows > 0) {
      mysql_data_seek($rsEntidades, 0);
	  $row_rsEntidades = mysql_fetch_assoc($rsEntidades);
  }
?>
                                 </select>
                               </div>
                               
                               <? } else { 
$ids=$_GET['entidade'];
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntidadeUser = "SELECT nome, id FROM entidades WHERE id = '$ids' ORDER BY entidades.id ASC";
$rsEntidadeUser = mysql_query($query_rsEntidadeUser, $Emolumentos) or die(mysql_error());
$row_rsEntidadeUser = mysql_fetch_assoc($rsEntidadeUser);
$totalRows_rsEntidadeUser = mysql_num_rows($rsEntidadeUser);
?> <div align="left" class="TituloNoticia2"><? echo $row_rsEntidadeUser['nome']; ?> <input name="id_site" type="hidden" value="<? echo $row_rsEntidadeUser['id']; ?>" /></div><? } ?>
                                                          </td>
                           </tr><? } else { ?><input name="acesso" type="hidden" id="acesso" value="<? if ($acesso == 2){ echo "3"; } else if ($acesso == "4") { echo "5"; } else if ($acesso == "6") { echo "7"; } ?>" /> <? } ?>
                           <tr>
                             <td class="SubTitulo">
                               <div align="right">Nome:</div>
                             </td>
                             <td>
                               <div align="left">
                                 
                                 <input onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" name="Nome" type="text" class="Formulario" id="Nome" size="40" maxlength="45" />
                               </div>
                             </td>
                           </tr>
                           <tr>
                             <td class="SubTitulo">
                               <div align="right">CPF:</div>
                             </td>
                             <td>
                               <div align="left">
                                 <input name="CPF" type="text" onBlur="javascript:formataCPF(this);" onKeyUp="javascript:formataCPF(this);" class="Formulario" id="CPF" />
                                 <span class="texto">&nbsp;Exp.002.834.093-02</span> </div>
                             </td>
                           </tr>
                           <tr>
                             <td class="SubTitulo">
                               <div align="right">Telefones:</div>
                             </td>
                             <td>
                               <div align="left">
                                 <input name="telefones" type="text" class="Formulario" id="telefones" size="40" maxlength="50" />
                               </div>
                             </td>
                           </tr>
                           <tr>
                             <td class="SubTitulo">
                               <div align="right">Endere&ccedil;o:</div>
                             </td>
                             <td>
                               <div align="left">
                                 <input onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" name="Endereco" type="text" class="Formulario" id="Endereco" size="40" maxlength="100" />
                               </div>
                             </td>
                           </tr>
                           <tr>
                             <td class="SubTitulo">
                               <div align="right">Cargo:</div>
                             </td>
                             <td>
                               <div align="left">
                                 <input onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" name="Cargo" type="text" class="Formulario" id="Cargo" size="40" maxlength="20" />
                               </div>
                             </td>
                           </tr>
                           <tr>
                             <td class="SubTitulo">
                               <div align="right">Senha:</div>
                             </td>
                             <td>
                               <div align="left">
                                 <input name="senha" type="text" class="Formulario" id="senha" size="20" maxlength="10" />
                               </div>
                             </td>
                           </tr>
                         </table>
                       </div>
                     </td>
                   </tr>
                   <tr>
                     <td>&nbsp;</td>
                   </tr>
                 </table>
               </div>
             </td>
           </tr>
           <tr>
             <td>
               <div align="center">
                 <input name="imageField2" type="image" src="../imagens/salvar.gif" alt="Salvar" />
               </div>
             </td>
           </tr>
         </table>
         <input type="hidden" name="MM_insert" value="cadastro" />
       </form>
       <? } else if (isset($_GET['oq']) && $_GET['oq'] == "editar" && isset($_GET['id'])) {?> 
       <form id="Editar" name="Editar" method="POST" action="<?php echo $editFormAction; ?>">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>
              <td>
                <div align="center"></div>
              </td>
            </tr>
            <tr>
              <td>
                <div align="center">
                  <table width="391" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>
                        <div align="center" class="TituloNoticia1">
                          <? 
$ids=$row_rsUsuarioEdit['id_site'];
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntidadeUser = "SELECT nome, id FROM entidades WHERE id = '$ids' ORDER BY entidades.id ASC";
$rsEntidadeUser = mysql_query($query_rsEntidadeUser, $Emolumentos) or die(mysql_error());
$row_rsEntidadeUser = mysql_fetch_assoc($rsEntidadeUser);
$totalRows_rsEntidadeUser = mysql_num_rows($rsEntidadeUser);?>
                        Editar dados  do usu&aacute;rio </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div align="center">
                          <table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <tr>
                              <td width="33%" class="SubTitulo">
                                <div align="right">Entidade do usu&aacute;rio:</div>
                              </td>
                              <td width="67%" align="left" valign="middle">
                                <div align="left"><span class="TituloNoticia2"><?php echo $row_rsEntidadeUser['nome']; ?></span></div>
                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">Nome:</div>
                              </td>
                              <td align="left" valign="middle">
                                <div align="left">
                                  <input  onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" name="Nome" type="text" class="Formulario" id="Nome" value="<?php echo $row_rsUsuarioEdit['nome']; ?>" size="40" maxlength="45" />
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">CPF:</div>
                              </td>
                              <td align="left" valign="middle">
                                <div align="left">
                                  <input name="CPF" type="text" class="Formulario" id="CPF" onBlur="javascript:formataCPF(this);" onKeyUp="javascript:formataCPF(this);" value="<?php echo $row_rsUsuarioEdit['CPF']; ?>" />
                                  <span class="texto">&nbsp;Exp.002.834.093-02</span> </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">Telefones:</div>
                              </td>
                              <td align="left" valign="middle">
                                <div align="left">
                                  <input  name="telefones" type="text" class="Formulario" id="telefones" value="<?php echo $row_rsUsuarioEdit['telefones']; ?>" size="40" maxlength="50" />
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">Endere&ccedil;o:</div>
                              </td>
                              <td align="left" valign="middle">
                                <div align="left">
                                  <input  onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" name="Endereco" type="text" class="Formulario" id="Endereco" value="<?php echo $row_rsUsuarioEdit['endereco']; ?>" size="40" maxlength="100" />
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">Cargo:</div>
                              </td>
                              <td align="left" valign="middle">
                                <div align="left">
                                  <input  onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" name="Cargo" type="text" class="Formulario" id="Cargo" value="<?php echo $row_rsUsuarioEdit['cargo']; ?>" size="40" maxlength="20" />
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">Senha:</div>
                              </td>
                              <td align="left" valign="middle">
                                <div align="left">
                                  <input name="senha" type="password" class="Formulario" id="senha" value="" size="20" maxlength="10" />
                                  <input name="id" type="hidden" id="id" value="<?php echo $row_rsUsuarioEdit['id']; ?>" />
                                  <input name="acesso" type="hidden" id="acesso" value="<?php echo $row_rsUsuarioEdit['acesso']; ?>" />
                                  <input name="id_site" type="hidden" id="id_site" value="<?php echo $row_rsUsuarioEdit['id_site']; ?>" />
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div align="center">
                  <input name="imageField" type="image" src="../imagens/salvar.gif" alt="Salvar" />
                </div>
              </td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="Editar">
       </form><? } ?>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
<? } ?>