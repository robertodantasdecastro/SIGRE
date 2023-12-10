<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
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


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language=JavaScript type=text/javascript src='../js/form.js'></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Emitir Guias</title>
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
        <table width="675" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#DCE0E9"><table width="100%" border="0" cellpadding="0" cellspacing="1">
              <tr>
                <td width="260" height="18" bgcolor="#FFFFFF" class="texto"><div align="center"><a href="#" class="LinkNoticia">Arquivo_05.zip</a></div></td>
                <td width="260" height="18" bgcolor="#FFFFFF" class="texto"><div align="center"><a href="#" class="LinkNoticia">Arquivo_05.zip</a></div></td>
                <td width="75" height="18" bgcolor="#FFFFFF" class="texto"><div align="center">29/04/2006</div></td>
                <td width="74" height="18" bgcolor="#FFFFFF" class="texto"><div align="center">327 bytes </div></td>
              </tr>
              <tr>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center"><a href="#" class="LinkNoticia">Arquivo_04.zip</a></div></td>
				<td height="18" bgcolor="#FFFFFF" class="texto"><div align="center"><a href="#" class="LinkNoticia">Arquivo_04.zip</a></div></td>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center">27/04/2006</div></td>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center">270 bytes </div></td>
              </tr>
              <tr>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center"><a href="#" class="LinkNoticia">Arquivo_03.zip</a></div></td>
				<td height="18" bgcolor="#FFFFFF" class="texto"><div align="center"><a href="#" class="LinkNoticia">Arquivo_03.zip</a></div></td>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center">26/04/2006</div></td>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center">180 bytes </div></td>
              </tr>
              <tr>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center"><a href="#" class="LinkNoticia">Arquivo_02.zip</a></div></td>
				<td height="18" bgcolor="#FFFFFF" class="texto"><div align="center"><a href="#" class="LinkNoticia">Arquivo_02.zip</a></div></td>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center">25/06/2006</div></td>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center">120 bytes </div></td>
              </tr>
              <tr>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center"><a href="#" class="LinkNoticia">Arquivo_01.zip</a></div></td>
				<td height="18" bgcolor="#FFFFFF" class="texto"><div align="center"><a href="#" class="LinkNoticia">Arquivo_01.zip</a></div></td>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center">22/06/2006</div></td>
                <td height="18" bgcolor="#FFFFFF" class="texto"><div align="center">79 bytes </div></td>
              </tr>
            </table>
              
            </td>
          </tr>
</table>
</body>
</html>
<? } ?>