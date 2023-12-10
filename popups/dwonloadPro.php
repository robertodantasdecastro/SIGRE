<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SIGRE</title>
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


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" align="left" valign="middle" background="../imagens/topo.jpg"><div align="left" class="TituloPagina">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="TituloPagina"><div align="center"><img src="../imagens/SigreLogo.gif" width="287" height="40" /></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td height="30" align="left" valign="middle"><div align="center">
      <table width="99%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><p align="center" class="TituloNoticia1"><br />
          SOLUCIONANDO PROBLEMAS RELACIONADOS A DOWNLOADS </p>
          <p align="justify" class="texto">Abra o Internet Explorer. <br />
            No menu Ferramentas, clique em <strong>Op&ccedil;&otilde;es da Internet</strong>. <br />
            Na guia <strong>Seguran&ccedil;a</strong>, clique em<strong> N&iacute;vel personalizado</strong>. <br />
            Siga um destes procedimentos ou ambos: </p>
          <p align="justify" class="texto">Para desativar os downloads de arquivo na Barra de Informa&ccedil;&otilde;es, na se&ccedil;&atilde;o <strong>Downloads da lista</strong>, em <strong>Aviso autom&aacute;tico para downloads de arquivo</strong>, clique em <strong>Ativar</strong>. </p>
          <p align="justify" class="texto"> Para desativar os controles ActiveX na Barra de Informa&ccedil;&otilde;es, na se&ccedil;&atilde;o<strong> Plug-ins e controles ActiveX da lista</strong>, em<strong> Aviso autom&aacute;tico para controles ActiveX</strong>, clique em <strong>Ativar</strong>. </p></td>
        </tr>
    </table></div>
    </td>
  </tr>
</table>
</body>
</html>
<? } ?>