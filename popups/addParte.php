<?php require_once('../../Connections/Emolumentos.php'); ?><?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" ) { ?>
	<script language="javascript" type="text/javascript" ?>
		window.close()
	</script> 
<?
echo "Pagina Restrita";
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
include ("../funcoes/validaCPF_CNPJ.php");


if (isset($_GET['oq']) && $_GET['oq'] == "4") { 

	if (isset($_GET['CPF']) && isset($_GET['Nome'])) {

  		mysql_select_db($database_Emolumentos, $Emolumentos);
		$CPF=$_GET['CPF']; 
		$query_rsParte = "SELECT * FROM partes WHERE partes.cpf = '$CPF'";
		$rsParte = mysql_query($query_rsParte, $Emolumentos) or die(mysql_error());
		$row_rsParte = mysql_fetch_assoc($rsParte);
		$totalRows_rsParte = mysql_num_rows($rsParte); 
		
		if ($_GET['tipo'] == "0") { 
			if (!isset($_SESSION['nOUTORGANTE'])) { $NS = 0; $NS2 = $NS+1;} else { $NS = $_SESSION['nOUTORGANTE']; $NS2 = $NS+1; } 
			for ($i = $NS; $i <= $NS2; $i++) {
				if (!isset($_SESSION['outorgante']["$i"])) { $_SESSION['outorgante']["$i"] = $row_rsParte['id']; }
				$_SESSION['nOUTORGANTE'] = $i;
			}
		}
		
		if ($_GET['tipo'] == "1") { 
			if (!isset($_SESSION['nOUTORGADO'])) { $NS = 0; $NS2 = $NS+1;} else { $NS = $_SESSION['nOUTORGADO']; $NS2 = $NS+1; } 
			for ($i = $NS; $i <= $NS2; $i++) {
				if (!isset($_SESSION['outorgado']["$i"])) { $_SESSION['outorgado']["$i"] = $row_rsParte['id']; }
				$_SESSION['nOUTORGADO'] = $i;
			}
		}
		if (isset($_GET['id_parte'])) { 
		  $updateSQL = sprintf("UPDATE partes SET nome=%s WHERE id=%s",
                       GetSQLValueString($_GET['Nome'], "text"),
                       GetSQLValueString($_GET['id_parte'], "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
}
		   ?>
		   
		<script language="javascript" type="text/javascript" ?>
		window.opener.location.reload();
		window.alert('Cadastro selecionado!');
		window.close();
		</script>
		<?
	}

	if (isset($_GET['CNPJ']) && isset($_GET['Nome'])) {
		  
		  mysql_select_db($database_Emolumentos, $Emolumentos);
		$CNPJ=$_GET['CNPJ']; 
		$query_rsParte = "SELECT * FROM partes WHERE partes.cnpj = '$CNPJ'"; 
		$rsParte = mysql_query($query_rsParte, $Emolumentos) or die(mysql_error());
		$row_rsParte = mysql_fetch_assoc($rsParte);
		$totalRows_rsParte = mysql_num_rows($rsParte); 
		
		if ($_GET['tipo'] == "0") { 
			if (!isset($_SESSION['nOUTORGANTE'])) { $NS = 0; $NS2 = $NS+1;} else { $NS = $_SESSION['nOUTORGANTE']; $NS2 = $NS+1; } 
			for ($i = $NS; $i <= $NS2; $i++) {
				if (!isset($_SESSION['outorgante']["$i"])) { $_SESSION['outorgante']["$i"] = $row_rsParte['id']; }
				$_SESSION['nOUTORGANTE'] = $i;
			}
		}
		
		if ($_GET['tipo'] == "1") { 
			if (!isset($_SESSION['nOUTORGADO'])) { $NS = 0; $NS2 = $NS+1;} else { $NS = $_SESSION['nOUTORGADO']; $NS2 = $NS+1; } 
			for ($i = $NS; $i <= $NS2; $i++) {
				if (!isset($_SESSION['outorgado']["$i"])) { $_SESSION['outorgado']["$i"] = $row_rsParte['id']; }
				$_SESSION['nOUTORGADO'] = $i;
			}
		}
				if (isset($_GET['id_parte'])) { 
		  $updateSQL = sprintf("UPDATE partes SET nome=%s WHERE id=%s",
                       GetSQLValueString($_GET['Nome'], "text"),
                       GetSQLValueString($_GET['id_parte'], "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
}
		  
		   ?>
		<script language="javascript" type="text/javascript" ?>
		window.opener.location.reload();
		window.alert('Cadastro selecionado');
		window.close();
		</script>
		<?

	}
				
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
              <td width="82">
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
              <td width="1345">
                <div align="center" class="TituloPagina">
                  <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adicionar  
                    <? if ($_GET['tipo'] == "0") { ?>
                    Outorgante
                    <? } else { ?>
                    Outorgado
                    <? } ?> 
                  </div>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    <tr>
      <td valign="middle">
        <table width="250"  border="0" cellspacing="1" cellpadding="0">
<tr>
            <td height="7"></td>
          </tr>
          <tr valign="middle">
            <td bgcolor="#FFFFFF">
              <form action="<?php echo $editFormAction; ?>" method="get" name="bloc" id="bloc">
<? if (!isset($_GET['oq'])) { ?><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="50"><div align="center" class="SubTitulo">Gostaria de pesquisar 
                          <? if ($_GET['tipo'] == "0") { ?>
                          outorgante
                          <? } else { ?>
                          outorgado
                          <? } ?>
                          por: </div></td>
                      </tr>
                      <tr>
                        <td><table width="100%" height="40" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><div align="center">
                                
                                <input name="oq" type="submit" class="Formulario" id="oq" value="CPF" />
                                
                                <input name="tipo" type="hidden" id="tipo" value="<? echo $_GET['tipo']; ?>" />
                            </div></td>
							<td><div align="center" class="SubTitulo">ou</div></td>

                            <td><div align="center">
                                
                                <input name="oq" type="submit" class="Formulario" id="oq" value="CNPJ" />
                                <input name="tipo" type="hidden" id="tipo" value="<? echo $_GET['tipo']; ?>" />
                                
                            </div></td>
                                                      </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table><? } else if ($_GET['oq'] == "CPF") { ?><table width="100%" border="0" cellpadding="0" cellspacing="3">
				<tr>
                    <td height="30"></td>
                    <td height="30"></td>
                  </tr>
                  <tr>
                        <td>
                          <div align="right" class="TituloNoticia2">CPF:</div></td>
                        <td>
                          <div align="left"><input name="CPF" type="text" class="Formulario" id="CPF" onBlur="javascript:formataCPF(this);" onKeyUp="javascript:formataCPF(this);" value="<? if (isset($_GET['CPF'])) { echo $_GET['CPF']; } ?>" size="20" /></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>
                      <div align="left">
                        <input name="Submit43" type="button" class="Formulario" value="&lt;&lt; Voltar" onClick="javascript:history.back();" />
                        &nbsp;
                        <input name="Submit2" type="submit" class="Formulario" value="Proximo &gt;&gt;" />
                        <input name="oq" type="hidden" id="oq" value="2" />
						<input name="tipo" type="hidden" id="tipo" value="<? echo $_GET['tipo']; ?>" />
                      </div>                    </td>
                  </tr>
                </table>
				<? } else if ($_GET['oq'] == "CNPJ") { ?><table width="100%" border="0" cellspacing="3" cellpadding="0">
				<tr>
                    <td height="30"></td>
                    <td height="30"></td>
                  </tr>
                  <tr>
                        <td>
                          <div align="right" class="TituloNoticia2">
                            <div align="right">CNPJ:</div>
                          </div>                        </td>
                        <td>
                          <div align="left">
                            <input name="CNPJ" type="text" class="Formulario" id="CNPJ" onBlur="javascript:formataCNPJ(this);" onKeyUp="javascript:formataCNPJ(this);" value="<? if (isset($_GET['CNPJ'])) { echo $_GET['CNPJ']; } ?>" size="20" maxlength="19" />
                          </div></td>
                  </tr>
                             <tr>
                    <td>&nbsp;</td>
                    <td><div align="left">
                      <input name="Submit432" type="button" class="Formulario" value="&lt;&lt; Voltar" onClick="javascript:history.back();" />
                      &nbsp;
                      <input name="Submit" type="submit" class="Formulario" value="Proximo &gt;&gt;" />
                      <input name="oq" type="hidden" id="oq" value="2" />
					  <input name="tipo" type="hidden" id="tipo" value="<? echo $_GET['tipo']; ?>" />
                    </div></td>
                  </tr>
                </table>
				<? } else if ($_GET['oq'] == "2") { include ("../funcoes/checarNumeros.php"); ?><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><? 
					mysql_select_db($database_Emolumentos, $Emolumentos);
					
					
if (isset($_GET['CPF']) && ($_GET['CPF'] != "")) { $CPF=$_GET['CPF']; $query_rsParte = "SELECT * FROM partes WHERE partes.cpf = '$CPF'"; }
if (isset($_GET['CNPJ']) && ($_GET['CNPJ'] != "")) { $CNPJ=$_GET['CNPJ']; $query_rsParte = "SELECT * FROM partes WHERE partes.cnpj = '$CNPJ'"; }
$rsParte = mysql_query($query_rsParte, $Emolumentos) or die(mysql_error());
$row_rsParte = mysql_fetch_assoc($rsParte);
$totalRows_rsParte = mysql_num_rows($rsParte); 
if ($totalRows_rsParte == 0) { ?><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center"><span class="TituloNoticia2">N&atilde;o existe cadastro relacionado ao<br />
    </span>
                          <span class="Erro1">
                          <? if (isset($_GET['CPF']) && ($_GET['CPF'] != "")) { echo "CPF: ".$_GET['CPF']; } if (isset($_GET['CNPJ']) && ($_GET['CNPJ'] != "")) { echo "CNPJ: ".$_GET['CNPJ']; } ?>
                          <br />
                          <br />
                          </span><span class="TituloNoticia2">Adicionar novo registro: </span><br />
    </div></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="3" cellpadding="0">
    <? if (isset($_GET['CPF']) && ($_GET['CPF'] != "")) { ?>  <tr>
         <td>
                          <div align="right" class="TituloNoticia2">CPF:</div></td>
                        <td>
                          <div align="left">
                            <input name="CPF" type="text" class="Formulario" id="CPF" onBlur="javascript:formataCPF(this);" onKeyUp="javascript:formataCPF(this);" value="<? echo $_GET['CPF']; ?>" size="20" />
                          </div></td>
      </tr> <? } ?>
     <? if (isset($_GET['CNPJ']) && ($_GET['CNPJ'] != "")) { ?> <tr>
        <td>
                          <div align="right" class="TituloNoticia2">
                            <div align="right">CNPJ:</div>
                          </div>                        </td>
                        <td>
                          <div align="left">
                            <input name="CNPJ" type="text" class="Formulario" id="CNPJ" onBlur="javascript:formataCNPJ(this);" onKeyUp="javascript:formataCNPJ(this);" value="<? echo $_GET['CNPJ']; ?>" size="20" maxlength="19" />
                          </div></td>
      </tr><? } ?>
      <tr>
        <td><div align="right" class="TituloNoticia2">Nome:</div></td>
        <td><div align="left">
            <input name="Nome" onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" type="text" class="Formulario" id="Nome" size="35" />
            </div>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="left">
          <input name="Submit433" type="button" class="Formulario" value="&lt;&lt; Voltar" onClick="javascript:history.back();" />
          &nbsp;
          <input name="Submit" type="submit" class="Formulario" value="Adicionar" />
          <input name="oq" type="hidden" id="oq" value="3" />
          <input name="tipo" type="hidden" id="tipo" value="<? echo $_GET['tipo']; ?>" />
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>
<? } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center" class="TituloNoticia2">Existe cadastro relacionado ao<br />
    </span>
                          <span class="Erro1">
                          <? if (isset($_GET['CPF']) && ($_GET['CPF'] != "")) { echo "CPF: ".$_GET['CPF']; } if (isset($_GET['CNPJ']) && ($_GET['CNPJ'] != "")) { echo "CNPJ: ".$_GET['CNPJ']; } ?><br /><br />
    </div></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="3" cellpadding="0">
      <? if (isset($_GET['CPF']) && ($_GET['CPF'] != "")) { ?>
      <tr>
        <td><div align="right" class="TituloNoticia2">CPF:</div></td>
        <td><div align="left" class="Erro1"><? echo $_GET['CPF']; ?>
          <input name="CPF" type="hidden" id="CPF" value="<? echo $_GET['CPF']; ?>" />
        </div></td>
      </tr>
      <? } ?>
      <? if (isset($_GET['CNPJ']) && ($_GET['CNPJ'] != "")) { ?>
      <tr>
        <td><div align="right" class="TituloNoticia2">
          <div align="right">CNPJ:</div>
        </div></td>
        <td><div align="left" class="Erro1"><? echo $_GET['CNPJ']; ?>
          <input name="CNPJ" type="hidden" id="CNPJ" value="<? echo $_GET['CNPJ']; ?>" />
        </div></td>
      </tr>
      <? } ?>
      <tr>
        <td><div align="right" class="TituloNoticia2">Nome:</div></td>
        <td><div align="left" class="Erro1">
<input name="Nome" type="text" onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" class="Formulario" id="Nome" value="<? echo $row_rsParte['nome']; ?>" size="35" />
<input name="id_parte" type="hidden" class="Formulario" id="id_parte" value="<? echo $row_rsParte['id']; ?>" size="35" />
        </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="left">
          
          <input name="Submit434" type="button" class="Formulario" value="&lt;&lt; Voltar" onClick="javascript:history.back();" />
          
          <input name="Submit3" type="submit" class="Formulario" value="Confirmar" />
          <input name="oq" type="hidden" id="oq" value="4" />
          <input name="tipo" type="hidden" id="tipo" value="<? echo $_GET['tipo']; ?>" />
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>
<? } ?>
</td>
                  </tr>
                  <tr>
                    <td height="7"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>
				<? } else if ($_GET['oq'] == "3") { 
				
				
				
	if (isset($_GET['CPF']) && isset($_GET['Nome'])) {

  		$insertSQL = sprintf("INSERT INTO partes (nome, cpf) VALUES (%s, %s)",
                       GetSQLValueString($_GET['Nome'], "text"),
                       GetSQLValueString($_GET['CPF'], "text"));

		  mysql_select_db($database_Emolumentos, $Emolumentos);
		  $Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
  
  
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$CPF=$_GET['CPF']; 
		$query_rsParte = "SELECT * FROM partes WHERE partes.cpf = '$CPF'";
		$rsParte = mysql_query($query_rsParte, $Emolumentos) or die(mysql_error());
		$row_rsParte = mysql_fetch_assoc($rsParte);
		$totalRows_rsParte = mysql_num_rows($rsParte); 
		
		if ($_GET['tipo'] == "0") { 
			if (!isset($_SESSION['nOUTORGANTE'])) { $NS = 0; $NS2 = $NS+1;} else { $NS = $_SESSION['nOUTORGANTE']; $NS2 = $NS+1; } 
			for ($i = $NS; $i <= $NS2; $i++) {
				if (!isset($_SESSION['outorgante']["$i"])) { $_SESSION['outorgante']["$i"] = $row_rsParte['id']; }
				$_SESSION['nOUTORGANTE'] = $i;
			}
		}
		
		if ($_GET['tipo'] == "1") { 
			if (!isset($_SESSION['nOUTORGADO'])) { $NS = 0; $NS2 = $NS+1;} else { $NS = $_SESSION['nOUTORGADO']; $NS2 = $NS+1; } 
			for ($i = $NS; $i <= $NS2; $i++) {
				if (!isset($_SESSION['outorgado']["$i"])) { $_SESSION['outorgado']["$i"] = $row_rsParte['id']; }
				$_SESSION['nOUTORGADO'] = $i;
			}
		}
		   ?>
		   
		<script language="javascript" type="text/javascript" ?>
		window.opener.location.reload();
		window.alert('Dados cadastrados!');
		window.close();
		</script>
		<?
	
  
	}

	if (isset($_GET['CNPJ']) && isset($_GET['Nome'])) {


		  $insertSQL = sprintf("INSERT INTO partes (nome, cnpj) VALUES (%s, %s)",
							   GetSQLValueString($_GET['Nome'], "text"),
							   GetSQLValueString($_GET['CNPJ'], "text"));
		
		  mysql_select_db($database_Emolumentos, $Emolumentos);
		  $Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
		  
		  
		  
		  mysql_select_db($database_Emolumentos, $Emolumentos);
		$CNPJ=$_GET['CNPJ']; 
		$query_rsParte = "SELECT * FROM partes WHERE partes.cnpj = '$CNPJ'"; 
		$rsParte = mysql_query($query_rsParte, $Emolumentos) or die(mysql_error());
		$row_rsParte = mysql_fetch_assoc($rsParte);
		$totalRows_rsParte = mysql_num_rows($rsParte); 
		
		if ($_GET['tipo'] == "0") { 
			if (!isset($_SESSION['nOUTORGANTE'])) { $NS = 0; $NS2 = $NS+1;} else { $NS = $_SESSION['nOUTORGANTE']; $NS2 = $NS+1; } 
			for ($i = $NS; $i <= $NS2; $i++) {
				if (!isset($_SESSION['outorgante']["$i"])) { $_SESSION['outorgante']["$i"] = $row_rsParte['id']; }
				$_SESSION['nOUTORGANTE'] = $i;
			}
		}
		
		if ($_GET['tipo'] == "1") { 
			if (!isset($_SESSION['nOUTORGADO'])) { $NS = 0; $NS2 = $NS+1;} else { $NS = $_SESSION['nOUTORGADO']; $NS2 = $NS+1; } 
			for ($i = $NS; $i <= $NS2; $i++) {
				if (!isset($_SESSION['outorgado']["$i"])) { $_SESSION['outorgado']["$i"] = $row_rsParte['id']; }
				$_SESSION['nOUTORGADO'] = $i;
			}
		}
		  
		   ?>
		<script language="javascript" type="text/javascript" ?>
		window.opener.location.reload();
		window.alert('Instituição inserida');
		window.close();
		</script>
		<?

	}
				
				} ?>
            </form>            </td>
          </tr>
          
        </table>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
<? } ?>