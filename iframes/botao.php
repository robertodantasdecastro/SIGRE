<? 
session_start ();
if (isset($_POST['reg'])) { 
$_SESSION['tipo'] = "EscrituraRegistro";
$_SESSION['N_guia'] = "farpen";
$_SESSION['GuiaReg'] = $_POST['id_guia'];
$_SESSION['tipoRegistro'] = "1";
unset($_SESSION['idCarReg']); 
?>
<script language="javascript">
//window.top.document.all.CPF.value = CPF.value;
window.parent.location.reload();
//window.parent.location.history.back();
</script>
<? 
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
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
<? if ($_SESSION['N_guia'] != "FIM") { ?>  <? if ($_SESSION['N_guia'] == "farpen") { ?>
  <tr>
    <td><div align="center">
      <input name="farpen" onClick="MM_openBrWindow('../boleto/boleto.php?oq=farpen&amp;id_guia=<? echo $_SESSION['id_guia']; ?>','uploa','scrollbars=yes,width=750,height=500')" type="button" class="Formulario" value="Guia FARPEN" />
    </div></td>
  </tr>
  <? } else if ($_SESSION['N_guia'] == "distribuidor") { ?>
  <tr>
    <td><div align="center">
      <input name="distr" onClick="MM_openBrWindow('../boleto/boleto.php?oq=distribuidor','uploa','scrollbars=yes,width=750,height=500')" type="button" class="Formulario" value="Guia distribuidor" />
    </div></td>
  </tr>
  <? } else if ($_SESSION['N_guia'] == "emolumento") { ?>
  <tr>
    <td><div align="center">
      <input name="emolumento" onClick="MM_openBrWindow('../boleto/boleto.php?oq=emolumento','uploa','scrollbars=yes,width=750,height=500')" type="button" class="Formulario" value="Guia emolumentos" />
    </div></td>
  </tr><? } ?>
  <? } else if ($_SESSION['N_guia'] == "FIM") { ?>
  <tr>
    <td><div align="center" class="TituloNoticia1"> Todas as guias foram emitidas.<br />
    </div></td>
  </tr>
<? if (($_SESSION['tipo'] == "Escritura") && ($_SESSION['declarado'] == "s") && ($_SESSION['imobiliario'] == "Sim")) {?>  <tr>
    <td><div align="center" class="TituloNoticia1">
      <form id="form1" name="form1" method="post" action="">
        <p>
          
          <input name="Submit" type="submit" class="Formulario" value="Gerar guias do registro" />
          
          <input name="reg" type="hidden" id="reg" value="ok" />
          <input name="id_guia" type="hidden" id="id_guia" value="<? echo $_SESSION['id_guia']; ?>">
        </p>
        </form>
         </div></td>
  </tr><? } else { ?><td><div align="center" class="TituloNoticia1">
      <form action="emitirGuias2.php" method="get" name="form1" target="_parent" id="form1">
        <p>
          
          <input name="Submit2" type="submit" class="Formulario" value="Emitir nova guia" />
          
        </p>
        </form>
         </div></td>
  </tr><? } ?>
  <? } ?>
</table>
</body>
</html>
