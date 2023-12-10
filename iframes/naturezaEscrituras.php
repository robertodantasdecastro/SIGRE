<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso != 1) {
	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
}else {

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsNaturezaEscritura = "SELECT * FROM naturezaescritura ORDER BY id DESC";
$rsNaturezaEscritura = mysql_query($query_rsNaturezaEscritura, $Emolumentos) or die(mysql_error());
$row_rsNaturezaEscritura = mysql_fetch_assoc($rsNaturezaEscritura);
$totalRows_rsNaturezaEscritura = mysql_num_rows($rsNaturezaEscritura);
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

    <?php if ($totalRows_rsNaturezaEscritura > 0) { // Show if recordset not empty ?>
      <table width="197" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#DCE0E9">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <?php do { ?><tr>
                <td width="215" bgcolor="#FFFFFF" class="texto"><span class="TituloNoticia2"><?php echo $row_rsNaturezaEscritura['nome']; ?></span></td>
                <td width="20" bgcolor="#FFFFFF">
                  <div align="center"><a href="#" onClick="MM_openBrWindow('../popups/tipoImovel.php?oq=editar&id=<?php echo $row_rsNaturezaEscritura['id']; ?>','uploa','scrollbars=yes,width=680,height=500')" class="LinkTexto"><img src="../imagens/excluir.gif" alt="Excluir" width="20" height="20" border="0" /></a></div>
                </td>
                <td width="20" bgcolor="#FFFFFF">
                  <div align="center"><a href="#" onclick="MM_openBrWindow('../popups/novaNatureza.php?id=<?php echo $row_rsNaturezaEscritura['id']; ?>','uploa','scrollbars=no,width=280,height=130')" class="LinkTexto"><img src="../imagens/editarP.gif" alt="Editar" width="20" height="20" border="0" /></a></div>
                </td>
              </tr><?php } while ($row_rsNaturezaEscritura = mysql_fetch_assoc($rsNaturezaEscritura)); ?>
            </table>
          </td>
        </tr>
    </table>
      <?php } // Show if recordset not empty ?>
    
<?php if ($totalRows_rsNaturezaEscritura == 0) { // Show if recordset empty ?>
  <table width="197" height="90" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" valign="middle" class="Erro1">N&atilde;o existem registros </td>
    </tr>
  </table>
  <?php } // Show if recordset empty ?></body>
</html>
<? } ?>