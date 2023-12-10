<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso > 3) {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: sigre.php'); 
}else {

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
<table width="400" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#DCE0E9">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#EEEEEE" class="TituloNoticia2"><div align="center">NOME</div></td>
                <td width="150" bgcolor="#EEEEEE" class="TituloNoticia2"><div align="center">CPF / CNPJ</div></td>
              </tr>
			  <?

		if ($_GET['oq'] == "0") { $ses = $_SESSION['nOUTORGANTE']; } else if ($_GET['oq'] == "1") { $ses = $_SESSION['nOUTORGADO']; }
		for ($i = 1; $i <= $ses; $i++) {
			if ($_GET['oq'] == "0") { 
				$id = $_SESSION['outorgante']["$i"]; 
			} else if ($_GET['oq'] == "1") { 
				$id = $_SESSION['outorgado']["$i"]; 
			}
			$query_rsParte = "SELECT * FROM partes WHERE partes.id = '$id'"; 
			$rsParte = mysql_query($query_rsParte, $Emolumentos) or die(mysql_error());
			$row_rsParte = mysql_fetch_assoc($rsParte);
			$totalRows_rsParte = mysql_num_rows($rsParte); 
			?><tr>
                <td bgcolor="#FFFFFF" class="texto"><div align="center"><? echo $row_rsParte['nome']; ?></div></td>
                <td width="150" bgcolor="#FFFFFF" class="texto"><div align="center"><? echo $row_rsParte['cpf']; ?><? echo $row_rsParte['cnpj']; ?></div></td>
              </tr><? } ?>
            </table>
          </td>
        </tr>
</table>
</html>
<? } ?>