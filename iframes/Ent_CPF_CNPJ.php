<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>

<body>
<script language="javascript" type="text/javascript">
function mandaCPF(CPF){

window.top.document.all.CPF.value = CPF.value;

}
function mandaCNPJ(CNPJ){
window.top.document.all.CNPJ.value = CNPJ.value;

}

</script>
<script language=JavaScript type=text/javascript src='../js/form.js'></script>
<table width="200" border="0" cellspacing="0" cellpadding="0">
 <? if (!isset($_GET['oq'])) { ?> <tr>
    <td><form id="form" name="form" method="get" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><div align="center">
            <input name="oq" type="submit" class="Formulario" id="oq" value="CNPJ" />
          </div></td>
          <td><div align="center">
            <input name="oq" type="submit" class="Formulario" id="oq" value="CPF" />
          </div></td>
        </tr>
      </table>
                </form>
    </td>
 </tr> <? } else { ?>
  <tr>
    <td>
      <div align="left">
        <? if ($_GET['oq'] == "CNPJ") { ?>
        <input name="CNPJ" type="text" class="Formulario" id="CNPJ" value="<? if (isset($_POST['CNPJ'])) { echo $_POST['CNPJ']; } ?>" onblur="javascript:formataCNPJ(this);" onkeyup="javascript:formataCNPJ(this); javascript:mandaCNPJ(this);" size="20" maxlength="19" /> 
        <? } else if ($_GET['oq'] == "CPF") { ?>
        <input name="CPF" type="text" onblur="javascript:formataCPF(this);" onkeyup="javascript:formataCPF(this); javascript:mandaCPF(this);" class="Formulario" value="<? if (isset($_POST['CPF'])) { echo $_POST['CPF']; } ?>" id="CPF" />
        <? } ?>
        </div></td></tr><? } ?>
</table>
</body>
</html>
