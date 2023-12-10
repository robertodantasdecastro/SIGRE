<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || ($acesso == 3 || $acesso == 5)) {
	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	echo "Pagina restrita";
}else {
if ($acesso == 1) {
$acc = $_GET['acc'];
mysql_select_db($database_Emolumentos, $Emolumentos);
if (isset($_GET['entidade'])) { 
	$ent = $_GET['entidade']; 
	$query_rsUsers = "SELECT usuarios.id_site, usuarios.id, usuarios.nome, usuarios.acesso, usuarios.bloc, usuarios.cpf FROM usuarios WHERE usuarios.acesso = '$acc' AND usuarios.id_site = '$ent' ORDER BY usuarios.nome ASC";  
} else { 
	$query_rsUsers = "SELECT usuarios.id_site, usuarios.id, usuarios.nome, usuarios.acesso, usuarios.bloc, usuarios.cpf FROM usuarios WHERE usuarios.acesso = '$acc' ORDER BY usuarios.nome ASC"; 
	}
$rsUsers = mysql_query($query_rsUsers, $Emolumentos) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);
$totalRows_rsUsers = mysql_num_rows($rsUsers);
} else if ($acesso == 2){
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsUsers = "SELECT usuarios.id_site, usuarios.id, usuarios.nome, usuarios.acesso, usuarios.bloc, usuarios.cpf FROM usuarios WHERE usuarios.id_site = '$idsLogin' AND usuarios.acesso = '3' ORDER BY usuarios.nome ASC";
$rsUsers = mysql_query($query_rsUsers, $Emolumentos) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);
$totalRows_rsUsers = mysql_num_rows($rsUsers);
} else if ($acesso == 4){
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsUsers = "SELECT usuarios.id_site, usuarios.id, usuarios.nome, usuarios.acesso, usuarios.bloc, usuarios.cpf FROM usuarios WHERE usuarios.id_site = '$idsLogin' AND usuarios.acesso = '5' ORDER BY usuarios.nome ASC";
$rsUsers = mysql_query($query_rsUsers, $Emolumentos) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);
$totalRows_rsUsers = mysql_num_rows($rsUsers);
} else if ($acesso == 6){
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsUsers = "SELECT usuarios.id_site, usuarios.id, usuarios.nome, usuarios.acesso, usuarios.bloc, usuarios.cpf FROM usuarios WHERE usuarios.id_site = '$idsLogin' AND usuarios.acesso = '7' ORDER BY usuarios.nome ASC";
$rsUsers = mysql_query($query_rsUsers, $Emolumentos) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);
$totalRows_rsUsers = mysql_num_rows($rsUsers);
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

    <?php if ($totalRows_rsUsers > 0) { // Show if recordset not empty ?>
      <table width="660" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#DCE0E9">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <?php do { ?><tr>
                <td <? if ($row_rsUsers['bloc'] == 1) { ?> bgcolor="#FEE7E8"<? } else { ?>bgcolor="#EAFDEB"<? } ?> class="texto"><span class="TituloNoticia2"><?php echo $row_rsUsers['nome']; ?></span></td>
				<td width="105" <? if ($row_rsUsers['bloc'] == 1) { ?> bgcolor="#FEE7E8"<? } else { ?>bgcolor="#EAFDEB"<? } ?> class="texto"><div align="center"><span class="TituloNoticia2"><?php echo $row_rsUsers['cpf']; ?></span></div></td>
				<? if ($acesso == 1) { ?><td width="221" <? if ($row_rsUsers['bloc'] == 1) { ?> bgcolor="#FEE7E8"<? } else { ?>bgcolor="#EAFDEB"<? } ?> class="texto"><span class="TituloNoticia2"><? 
$id_site=$row_rsUsers['id_site'];
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntidadeUser = "SELECT entidades.nome, entidades.id, entidades.tipo FROM entidades WHERE entidades.id = '$id_site'";
$rsEntidadeUser = mysql_query($query_rsEntidadeUser, $Emolumentos) or die(mysql_error());
$row_rsEntidadeUser = mysql_fetch_assoc($rsEntidadeUser);
$totalRows_rsEntidadeUser = mysql_num_rows($rsEntidadeUser);
?><? echo $row_rsEntidadeUser['nome']; ?></span></td><? } ?>
                <td width="20" bgcolor="#FFFFFF">
                  <div align="center"><a href="#" onClick="MM_openBrWindow('../popups/usuarios.php?oq=editar&id=<?php echo $row_rsUsers['id']; ?>','editar','scrollbars=yes,width=450,height=320')" class="LinkTexto"><img src="../imagens/editarP.gif" alt="Editar dados do usu&aacute;rio" width="20" height="20" border="0" /></a></div>                </td><?php if ($acesso == 1){ if ($row_rsEntidadeUser['tipo'] == "SN") { $ac = "3"; } else if ($row_rsEntidadeUser['tipo'] == "SDT") { $ac = "5"; }  
mysql_select_db($database_Emolumentos, $Emolumentos);
$ids = $row_rsUsers['id_site'];
$query_rsUsersFilho = "SELECT usuarios.id_site, usuarios.id, usuarios.nome, usuarios.acesso FROM usuarios WHERE usuarios.acesso = '$ac' AND usuarios.id_site = '$ids' ORDER BY usuarios.nome ASC";
$rsUsersFilho = mysql_query($query_rsUsersFilho, $Emolumentos) or die(mysql_error());
$row_rsUsersFilho = mysql_fetch_assoc($rsUsersFilho);
$totalRows_rsUsersFilho = mysql_num_rows($rsUsersFilho);
}?>
				<? if ($acesso == 1 && ($_GET['acc'] != 3 && $_GET['acc'] != 5 && $totalRows_rsUsersFilho != 0)) { ?> <td width="20" bgcolor="#FFFFFF">
                  <div align="center"><a href="#" onClick="MM_openBrWindow('usuarios.php?acc=<?php if ($row_rsEntidadeUser['tipo'] == "SN") { echo "3"; } else if ($row_rsEntidadeUser['tipo'] == "SDT") { echo "5"; } ?>&entidade=<? echo $row_rsEntidadeUser['id']; ?>','usuarios','scrollbars=yes,width=680,height=100')" class="LinkTexto"><img src="../imagens/CadastroUsuariosP.gif" alt="Existem <? echo $totalRows_rsUsersFilho; ?> Usu&aacute;rios Utilizadores cadastrados, Clique para ver" width="20" height="17" border="0" /></a></div>
                </td><? } else if ($acesso == 1 && ($_GET['acc'] != 3 && $_GET['acc'] != 5)) { ?><td width="20" bgcolor="#FFFFFF">
                  <div align="center"><img src="../imagens/UsuarioNaoExist.gif" alt="N&atilde;o existem usu&aacute;rios utilizadores cadastrados" width="20" height="20" border="0" /></div>
                </td>
                <? } ?><td width="21" bgcolor="#FFFFFF"><? if ($row_rsUsers['bloc'] == 1) { ?><a href="#" onClick="MM_openBrWindow('../popups/usuariosBloc.php?oq=0&id=<?php echo $row_rsUsers['id']; ?>','editar','scrollbars=no,width=250,height=120')" class="LinkTexto"> <img src="../imagens/unbloc.gif" alt="desbloquear usuário" width="20" height="20" border="0" /></a><? } else { ?><a href="#" onClick="MM_openBrWindow('../popups/usuariosBloc.php?oq=1&id=<?php echo $row_rsUsers['id']; ?>','editar','scrollbars=no,width=250,height=120')" class="LinkTexto"><img src="../imagens/bloc.gif" alt="Bloquear usuário" width="20" height="20" border="0" /></a><? } ?></td>
                </tr><?php } while ($row_rsUsers = mysql_fetch_assoc($rsUsers)); ?>
            </table>
          </td>
        </tr>
    </table>
      <?php } // Show if recordset not empty ?>
    
<?php if ($totalRows_rsUsers == 0) { // Show if recordset empty ?>
  <table width="660" height="90" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" valign="middle" class="Erro1">N&atilde;o existem registros </td>
    </tr>
  </table>
  <?php } // Show if recordset empty ?></body>
</html>
<? } ?>