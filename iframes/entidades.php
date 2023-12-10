<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso != 1) {
	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
}else {
$tipo = $_GET['tipo'];
mysql_select_db($database_Emolumentos, $Emolumentos);
if (!isset($_GET['cidade']) xor ($_GET['cidade'] == "FULL")) {
$query_rsEntidades = "SELECT entidades.id, entidades.nome, entidades.cidade, entidades.tipo FROM entidades WHERE entidades.tipo = '$tipo' ORDER BY entidades.cidade ASC";
} else {
$nomCid = $_GET['cidade'];

$query_rsEntidades = "SELECT entidades.id, entidades.nome, entidades.cidade, entidades.tipo FROM entidades WHERE entidades.tipo = '$tipo' AND cidade = '$nomCid' ORDER BY entidades.cidade ASC";
}
$rsEntidades = mysql_query($query_rsEntidades, $Emolumentos) or die(mysql_error());
$row_rsEntidades = mysql_fetch_assoc($rsEntidades);
$totalRows_rsEntidades = mysql_num_rows($rsEntidades);


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

    <?php if ($totalRows_rsEntidades > 0) { // Show if recordset not empty ?>
      <table width="710" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#DCE0E9">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <?php do { ?><tr>
			  <td width="28" bgcolor="#FFFFFF"><div align="center"><span class="TituloNoticia2">&nbsp;<?php echo $row_rsEntidades['id']; ?></span></div></td>
                <td width="380" bgcolor="#FFFFFF" class="texto"><span class="TituloNoticia2">&nbsp;<?php echo $row_rsEntidades['nome']; ?></span>
                <? 
$id_site = $row_rsEntidades['id'];
if (isset($_GET['tipo']) && $_GET['tipo'] == "SN") { $idss = "2"; }
if (isset($_GET['tipo']) && $_GET['tipo'] == "SDT") { $idss = "4"; }
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsUsuarioExist = "SELECT usuarios.id, usuarios.id_site FROM usuarios WHERE usuarios.id_site = '$id_site' AND usuarios.acesso = '$idss'";
$rsUsuarioExist = mysql_query($query_rsUsuarioExist, $Emolumentos) or die(mysql_error());
$row_rsUsuarioExist = mysql_fetch_assoc($rsUsuarioExist);
$totalRows_rsUsuarioExist = mysql_num_rows($rsUsuarioExist);
?></td>
                <td bgcolor="#FFFFFF"><span class="TituloNoticia2">&nbsp;<?php echo $row_rsEntidades['cidade']; ?></span></div></td>
                <td width="20" bgcolor="#FFFFFF">
                  <div align="center"><a href="#" onClick="MM_openBrWindow('../popups/entidades<? if ($_GET['tipo'] == "SN") { echo "SN"; } ?>.php?oq=editar&id=<?php echo $row_rsEntidades['id']; ?>','uploa','scrollbars=yes,width=680,height=435')" class="LinkTexto"><img src="../imagens/editarP.gif" alt="Editar entidade" width="20" height="20" border="0" /></a></div>
                </td>
                <td width="20" bgcolor="#FFFFFF">
                  <? if ($totalRows_rsUsuarioExist == 0) { ?>
                  <div align="center"><a href="#" onClick="MM_openBrWindow('../popups/usuarios.php?oq=novo&entidade=<? echo $row_rsEntidades['id']; ?>','uploa','scrollbars=yes,width=450,height=320')" ><img src="../imagens/UsuarioNaoExist.gif" alt="N&atilde;o existe administrador cadastrado, clique para adicionar." width="20" height="20" border="0" /></a></div><? } else if ($totalRows_rsUsuarioExist == 1){?><div align="center"><a href="#" onClick="MM_openBrWindow('../popups/usuarios.php?oq=editar&id=<?php echo $row_rsUsuarioExist['id']; ?>','editar','scrollbars=yes,width=450,height=320')"><img src="../imagens/UsuarioExist.gif" alt="Existe <? echo $totalRows_rsUsuarioExist; ?> usuario Administrador cadastrado." width="20" height="20" border="0" /></a></div><? } else if ($totalRows_rsUsuarioExist > 1){?><div align="center"><a href="#" onClick="MM_openBrWindow('usuarios.php?entidade=<? echo $row_rsEntidades['id']; ?>&acc=<?php if ($row_rsEntidades['tipo'] == "SN") { echo "2"; } else if ($row_rsEntidades['tipo'] == "SDT") { echo "4"; } ?>','uploa','scrollbars=yes,width=580,height=100')" class="LinkTexto"><img src="../imagens/CadastroUsuariosP.gif" alt="Existem <? echo $totalRows_rsUsuarioExist; ?> administradores cadastrados, clique para ver" width="20" height="17" border="0" /></a></div>
                  <? } ?>
                </td>
              </tr><?php } while ($row_rsEntidades = mysql_fetch_assoc($rsEntidades)); ?>
            </table>
          </td>
        </tr>
    </table>
      <?php } // Show if recordset not empty ?>
    
<?php if ($totalRows_rsEntidades == 0) { // Show if recordset empty ?>
  <table width="710" height="90" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" valign="middle" class="Erro1">N&atilde;o existem registros </td>
    </tr>
  </table>
  <?php } // Show if recordset empty ?></body>
</html>
<? } ?>