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
<head><script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<script language=JavaScript type=text/javascript src='../js/form.js'></script>
<? if (isset($_GET['oq2'])) { 
$_SESSION['id_guia'] = $_GET['id_guia'];
$_SESSION['situacao'] = $_GET['situacao'];
?>
<script language=JavaScript type=text/javascript> 

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
MM_openBrWindow('../boleto/boleto.php?oq=emolumento','uploa','scrollbars=yes,width=750,height=500');

</script>
<? } ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detalhes da Guia</title>
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
<?
if ($mes<10){ $mes = "0".$mes; }
if (isset($_GET['id_guia']) || isset($_GET['numero_doc'])) { 
if (isset($_GET['id_guia'])) { $id_guia = $_GET['id_guia']; }
if (isset($_GET['numero_doc'])) { 

	$numero_doc = $_GET['numero_doc'];
	$numero_doc = ereg_replace("0","0",$numero_doc); 
	$numero_doc = ereg_replace("/","",$numero_doc); 
	$numero_doc = ereg_replace("-","",$numero_doc); 
	$numero_doc = ereg_replace("\.","",$numero_doc); 
	
	$id_ento = substr($numero_doc, 0, 3);
	$anoo = "20".substr($numero_doc, 3, 2);
	$numeroo = substr($numero_doc, 5, 5);
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rs_idGuia = "SELECT guias.id FROM guias WHERE guias.id_entidade = '$id_ento' AND guias.numero = '$numeroo' AND guias.ano = '$anoo'";
	$rs_idGuia = mysql_query($query_rs_idGuia, $Emolumentos) or die(mysql_error());
	$row_rs_idGuia = mysql_fetch_assoc($rs_idGuia);
	$totalRows_rs_idGuia = mysql_num_rows($rs_idGuia);
	
	$id_guia = $row_rs_idGuia['id']; 

}

if ($acesso > 1) {
	$id_entidade = $row_rsEntidadeLogin['id']; 
} else if ($acesso == 1) {
	$id_entidade = $id_ento;
}
if ($acesso == '4' || $acesso == '5'){

	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsGuias = "SELECT entidades.nome, entidades.id, entidades.convenio, guias.*, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento, date_format(guias.`emicao`, '%d/%m/%Y') as emicao, date_format(guias.`dataMovEmolumento`, '%d/%m/%Y') as dataMovEmolumento, date_format(guias.`dataMovFarpen`, '%d/%m/%Y') as dataMovFarpen, date_format(guias.`dataMovSDJ`, '%d/%m/%Y') as dataMovSDJ FROM guias, entidades WHERE entidades.id_sdt = '$id_entidade' AND guias.id_entidade = entidades.id AND guias.id = '$id_guia' AND guias.tipo = 'Escritura'";
	$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
	$row_rsGuias = mysql_fetch_assoc($rsGuias);
	$totalRows_rsGuias = mysql_num_rows($rsGuias);
	
	$id_Ent = $row_rsGuias['id_entidade'];
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsConveniosSN = "SELECT entidades.id, entidades.nome, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_Ent'";
	$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
	$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
	$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
	
	$id_sdt = $row_rsConveniosSN['id_sdt'];
} else {
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsGuias = "SELECT *, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento, date_format(guias.`emicao`, '%d/%m/%Y') as emicao, date_format(guias.`dataMovEmolumento`, '%d/%m/%Y') as dataMovEmolumento, date_format(guias.`dataMovFarpen`, '%d/%m/%Y') as dataMovFarpen, date_format(guias.`dataMovSDJ`, '%d/%m/%Y') as dataMovSDJ FROM guias WHERE guias.id = '$id_guia' AND guias.id_entidade = '$id_entidade'";
	$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
	$row_rsGuias = mysql_fetch_assoc($rsGuias);
	$totalRows_rsGuias = mysql_num_rows($rsGuias);
	
	if ($row_rsGuias['tipo'] == "Escritura") {
	
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rsConveniosSN = "SELECT entidades.id, entidades.nome, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_entidade'";
		$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
		$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
		$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
	
	} else if ($row_rsGuias['tipo'] == "Registro") {
	
		$id_reg = $row_rsGuias['idReg'];
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rsConveniosSN = "SELECT entidades.id, entidades.nome, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_reg'";
		$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
		$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
		$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
	
	}
	$id_sdt = $row_rsConveniosSN['id_sdt'];

}


if ($row_rsGuias['situacaoSDJ'] == 1) { $situacaoSDJ = "Não emitida"; } else if ($row_rsGuias['situacaoSDJ'] == 2) { $situacaoSDJ = "Emitida"; } else if ($row_rsGuias['situacaoSDJ'] == 3) { $situacaoSDJ = "Reemitido"; } else if ($row_rsGuias['situacaoSDJ'] >= 4) { $situacaoSDJ = "Pago"; } 


if ($row_rsGuias['situacaoEmolumento'] == "1") { $situacaoEmo = "N&atilde;o emitida"; } else if ($row_rsGuias['situacaoEmolumento'] == "2") { $situacaoEmo = "Emitida"; } else if ($row_rsGuias['situacaoEmolumento'] == "3") { $situacaoEmo = "Reemitido"; } else if ($row_rsGuias['situacaoEmolumento'] >= "4") { $situacaoEmo = "Pago"; }


if ($row_rsGuias['situacaoFarpen'] == "1") { $situacaoFarpen = "N&atilde;o emitida"; } else if ($row_rsGuias['situacaoFarpen'] == "2") { $situacaoFarpen = "Emitida"; } else if ($row_rsGuias['situacaoFarpen'] == "3") { $situacaoFarpen = "Reemitido"; } else if ($row_rsGuias['situacaoFarpen'] >= "4") { $situacaoFarpen = "Pago"; }


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" align="left" valign="middle" background="../imagens/topo.jpg"><div align="left" class="TituloPagina">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><script type="text/javascript" src="../js/swfobject.js"></script>
                <div id="flashcontent"></div>
            <script type="text/javascript">
          // <![CDATA[
		var so = new SWFObject("../topoP.swf", "sotester", "55", "55", "8.0.23", "#FFFFFF");
		//so.addVariable("flashVarText", "this is passed in via FlashVars"); // this line is optional, but this example uses the variable and displays this text inside the flash movie
		so.addParam("wmode", "transparent");
        so.addParam("menu", "false");
		so.write("flashcontent");
			
           // ]]>
    </script></td>
          <td class="TituloPagina">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Detalhes da guia </td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <table width="620" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#DCE0E9"><?php if ($totalRows_rsGuias > 0) { // Show if recordset not empty 
						

if ($row_rsGuias['numero'] < 10){ $numeros = "0000".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 100) { $numeros = "000".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 1000) { $numeros = "00".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 10000) { $numeros = "0".$row_rsGuias['numero']; } 
$anos = substr($row_rsGuias['ano'], 2, 2);

if ($row_rsGuias['id_entidade'] < 10){ $id_entidade = "00".$row_rsGuias['id_entidade']; } else if ($row_rsGuias['id_entidade'] < 100) { $id_entidade = "0".$row_rsGuias['id_entidade']; } 

		?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="180" align="center" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="SubTitulo" height="7"></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <table width="600" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td bgcolor="#DCE0E9"><table width="600" border="0" cellspacing="1" cellpadding="0">
                                    <tr>
                                      <td bgcolor="#F4F4FB" class="TituloNoticia2"><div align="center" class="TituloNoticia1">Detalhes do documento</div></td>
                                    </tr>
                                    <tr>
                                      <td height="35" bgcolor="#FFFFFF"><div align="left"><span class="TituloNoticia2">&nbsp;&nbsp;&nbsp;N&uacute;mero do documento: <span class="Erro1"><?php echo $id_entidade.".".$anos.".".$numeros; ?></span></span>&nbsp;&nbsp;<span class="TituloNoticia2">&nbsp;&nbsp;Data da emiss&atilde;o:&nbsp;</span><span class="Erro1"><?php echo $row_rsGuias['emicao']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="TituloNoticia2">Data da vencimento:</span>&nbsp;<span class="Erro1"><?php echo $row_rsGuias['vencimento']; ?></span><br />
                                          <span class="TituloNoticia2">&nbsp;&nbsp;&nbsp;Identificador:&nbsp;</span><span class="Erro1"><? echo $id_guia; ?></span></div></td>
                                    </tr>
                                    <tr>
                                      <td height="40" bgcolor="#FFFFFF"><div align="left"><span class="TituloNoticia2">&nbsp;&nbsp;Tipo de documento:&nbsp;</span><span class="Erro1"><? echo $row_rsGuias['tipo']; ?>&nbsp;
                                            <? 		  
							if ($row_rsGuias['tipo'] == 'Escritura' || $row_rsGuias['tipoRegistro'] == "1") { 
							  	if ($row_rsGuias['declarado'] == 's') { 
							  		if ($row_rsGuias['TipoImovel'] != 'N/D') { 
										echo "imobili&aacute;ria com valor declarado.</samp><br>";
										echo "<span class=\"TituloNoticia2\">&nbsp;&nbsp;Tipo de im&oacute;vel: </span><span class=\"Erro1\">".$row_rsGuias['TipoImovel']."</span><br>";
										echo "<span class=\"TituloNoticia2\">&nbsp;&nbsp;Caracteristicas: </span><span class=\"Erro1\">".$row_rsGuias['caracteristicas']."</span><br>";
							  		} else {
										echo "com valor declarado.</samp><br>";
									}
									echo "<span class=\"TituloNoticia2\">&nbsp;&nbsp;Natureza da escritura: </span><span class=\"Erro1\">".$row_rsGuias['id_natuEsc']."</span>";
									if ($row_rsGuias['tipo'] == "Registro") { echo "<br><span class=\"TituloNoticia2\">&nbsp;&nbsp;Nome da entidade registradora: </span><span class=\"Erro1\">".$row_rsConveniosSN['nome']."</span><br>"; 	}
								} else {
								echo "<br><span class=\"TituloNoticia2\">&nbsp;&nbsp;Tipo de escrituras sem valor devlarado: </span><span class=\"Erro1\">".$row_rsGuias['ndescricao']."</span>";
								
								}
							
							} else { 
							  	
								$idTipoReg = $row_rsGuias['tipoRegistro'];
								mysql_select_db($database_Emolumentos, $Emolumentos);
								$query_rsTipoRegistro = "SELECT * FROM tiporegistro WHERE tiporegistro.id = '$idTipoReg'";
								$rsTipoRegistro = mysql_query($query_rsTipoRegistro, $Emolumentos) or die(mysql_error());
								$row_rsTipoRegistro = mysql_fetch_assoc($rsTipoRegistro);
								$totalRows_rsTipoRegistro = mysql_num_rows($rsTipoRegistro);
								
								echo "<br><span class=\"TituloNoticia2\">&nbsp;&nbsp;Tipo de registro: </span><span class=\"Erro1\">".$row_rsTipoRegistro['nome']."</span><br>";
								echo "<span class=\"TituloNoticia2\">&nbsp;&nbsp;Nome da entidade: </span><span class=\"Erro1\">".$row_rsConveniosSN['nome']."</span><br>";
							  }
							  if ($acesso == 5 || $acesso == 4 ) { echo "<br><span class=\"TituloNoticia2\">&nbsp;&nbsp;Nome da entidade: </span><span class=\"Erro1\">".$row_rsConveniosSN['nome']."</span><br>"; }
							  ?>
                                      </div></td>
                                    </tr>
                                </table></td>
                              </tr>
                            </table>
                        </div></td>
                      </tr>
<? if ($acesso < 6) { ?><tr>
                        <td height="10"></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <table width="600" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td bgcolor="#DCE0E9"><table width="600" border="0" cellspacing="1" cellpadding="0">
                                    <tr>
                                      <td bgcolor="#F4F4FB" class="TituloNoticia2"><div align="center" class="TituloNoticia1">Detalhes da guia de Emolumento do SN - SNR</div></td>
                                    </tr>
                                    <tr>
                                      <td height="20" bgcolor="#FFFFFF"><div align="left" class="TituloNoticia2">&nbsp;&nbsp;&nbsp;N&uacute;mero do convenio: <span class="Erro1"><? echo $row_rsConveniosSN['convenio']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N&uacute;mero da guia (Nosso N&uacute;mero):&nbsp; <span class="Erro1"><?php echo $row_rsConveniosSN['convenio'].$id_entidade.$anos.$numeros; ?></span></div></td>
                                    </tr>
                                    <tr>
                                      <td height="30" <? if ($row_rsGuias['situacaoEmolumento'] == "1") {?>bgcolor="#FEE7E8"<? } else { ?>bgcolor="#FFFFFF"<? } ?> class="TituloNoticia2"><div align="left">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="92%"><? if ($acesso == 2 || $acesso == 3) { ?>&nbsp;&nbsp;&nbsp;Valor da guia:<span class="Erro1">&nbsp;R$ <?php echo $row_rsGuias['valorEmolumento']; ?></span><br /><? } ?>
&nbsp;&nbsp;&nbsp;Situa&ccedil;&atilde;o da guia: <span class="Erro1"><? echo $situacaoEmo; ?></span></td>
                                          <td width="8%"><div align="center">
                         <? if ($row_rsGuias['situacaoEmolumento'] < 4) { ?>
                         <input type="image" name="imageField" onclick="MM_openBrWindow('../boleto/boleto2Via.php?oq=emolumento&amp;id_guia=<? echo $row_rsGuias['id']; ?>&amp;situacao=2','uploa','scrollbars=yes,width=750,height=500')" src="../imagens/emitirBoletoP2v.gif" />
                         <? } ?>
                                          </div></td>
                                        </tr>
                                      </table>
                                      </div></td>
                                    </tr>
                                   <? if ($row_rsGuias['situacaoEmolumento'] >= '4') { ?><tr>
                                      <td height="30" bgcolor="#E0FADC" class="TituloNoticia2"><div align="left">&nbsp;&nbsp;&nbsp;Data do cr&eacute;dito: <span class="Erro1">R$ <?php echo $row_rsGuias['dataMovEmolumento']; ?></span><br />
                                         <? if ($acesso == 2 || $acesso == 3) { ?> &nbsp;&nbsp;&nbsp;Valor do cr&eacute;dito:<span class="Erro1">&nbsp;R$ <?php echo $row_rsGuias['valorRetornoEmo']; ?><br />
                                          </span>&nbsp;&nbsp;&nbsp;Valor do FEPJ ( 3% ):<span class="Erro1"> R$ 
    
                                          <?php echo $row_rsGuias['valorFEPJ']; ?></span><br />
                                      &nbsp;&nbsp;&nbsp;Tarifa:<span class="Erro1"> R$ <?php echo $row_rsGuias['tarifaRetornoEmo']; ?></span><? } ?></div></td>
                                    </tr><? } ?>
                                </table></td>
                              </tr>
                            </table>
                        </div></td>
                      </tr><? } if ($acesso == 1 || $acesso == 2) { ?>
                      <tr>
                        <td height="10"></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                          <table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#DCE0E9">
                            <tr>
                              <td><table width="600" border="0" cellspacing="1" cellpadding="0">
                                <tr>
                                  <td bgcolor="#F4F4FB" class="TituloNoticia2"><div align="center" class="TituloNoticia1">Detalhes da guia FARPEN </div></td>
                                </tr>

                                <tr>
                                  <td height="20" bgcolor="#FFFFFF"><div align="left" class="TituloNoticia2">&nbsp;&nbsp;&nbsp;N&uacute;mero do convenio: <span class="Erro1"><? echo $row_rsConveniosSN['convenio2']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N&uacute;mero da guia (Nosso N&uacute;mero):&nbsp; <span class="Erro1"><?php echo $row_rsConveniosSN['convenio2'].$id_entidade.$anos.$numeros; ?></span></div></td>
                                </tr>
                                <tr>
                                  <td height="30" <? if ($row_rsGuias['situacaoFarpen'] == "1") {?>bgcolor="#FEE7E8"<? } else { ?>bgcolor="#FFFFFF"<? } ?> class="TituloNoticia2"><div align="left">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="92%">&nbsp;&nbsp;&nbsp;Valor da guia:<span class="Erro1">&nbsp;R$ <?php echo $row_rsGuias['valorFarpen']; ?></span><br />
&nbsp;&nbsp;&nbsp;Situa&ccedil;&atilde;o da guia: <span class="Erro1"><? echo $situacaoFarpen; ?></span> </td>
                                        <td width="8%"><div align="center">
                 <? if ($row_rsGuias['situacaoFarpen'] < 4 && $acesso != 1) { ?>
                 <input type="image" name="imageField2" onclick="MM_openBrWindow('../boleto/boleto2Via.php?oq=farpen&amp;id_guia=<? echo $row_rsGuias['id']; ?>&amp;situacao=2','uploa','scrollbars=yes,width=750,height=500')" src="../imagens/emitirBoletoP2v.gif" alt="Emitir segunda via" />
                 <? } ?>
                                        </div></td>
                                      </tr>
                                    </table>
                                  </div></td>
                                </tr>
								 <? if ($row_rsGuias['situacaoFarpen'] >= '4') { ?><tr>
                                      <td height="30" bgcolor="#E0FADC" class="TituloNoticia2"><div align="left">&nbsp;&nbsp;&nbsp;Data da cr&eacute;dito:<span class="Erro1"> <?php echo $row_rsGuias['dataMovFarpen']; ?></span><br />
                                          &nbsp;&nbsp;&nbsp;Valor da cr&eacute;dito (5% valor FARPEN):<span class="Erro1">&nbsp;R$ <?php echo $row_rsGuias['valorRetornoFARPEN_emoCred']; ?><br />
                                          </span>&nbsp;&nbsp;&nbsp;Valor do FARPEN:<span class="Erro1"> R$ 
    
                                          <?php echo number_format($row_rsGuias['valorRetornoFARPEN'], 2, ",", "."); ?></span><br />
                                      </div></td>
                                    </tr><? } ?>
                              </table></td>
                            </tr>
                          </table>
                        </div></td>
                      </tr><?  } ?>
<? if ($row_rsGuias['tipo'] == "Escritura" && $acesso != 1) { 

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsConvenioSDT = "SELECT entidades.nome, entidades.convenio FROM entidades WHERE entidades.id = '$id_sdt'";
$rsConvenioSDT = mysql_query($query_rsConvenioSDT, $Emolumentos) or die(mysql_error());
$row_rsConvenioSDT = mysql_fetch_assoc($rsConvenioSDT);
$totalRows_rsConvenioSDT = mysql_num_rows($rsConvenioSDT);

?>  <tr>
                        <td height="10"></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                          <table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#DCE0E9">
                            <tr>
                              <td><table width="600" border="0" cellspacing="1" cellpadding="0">
                                  <tr>
                                    <td bgcolor="#F4F4FB" class="TituloNoticia2"><div align="center" class="TituloNoticia1">Detalhes da guia do Distribuidor </div></td>
                                  </tr>
                                  <tr>
                                    <td height="20" bgcolor="#FFFFFF"><div align="left" class="TituloNoticia2">&nbsp;&nbsp;&nbsp;N&uacute;mero do convenio:&nbsp;<?php echo $row_rsConvenioSDT['convenio']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N&uacute;mero da guia (Nosso N&uacute;mero):&nbsp; <span class="Erro1"><?php echo $row_rsConvenioSDT['convenio'].$id_entidade.$anos.$numeros; ?></span></div></td>
                                  </tr>
                                  <tr>
                                    <td height="30" align="center" valign="middle" class="TituloNoticia2" <? if ($row_rsGuias['situacaoSDJ'] == "1") {?>bgcolor="#FEE7E8"<? } else { ?>bgcolor="#FFFFFF"<? } ?>><div align="left">
                                      <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                          <td height="20">&nbsp;&nbsp;&nbsp;Valor da guia:<span class="Erro1">&nbsp;R$ <?php echo $row_rsGuias['valorSDT']; ?></span><br />
                                            &nbsp;&nbsp;&nbsp;Situa&ccedil;&atilde;o da guia: <span class="Erro1"><? echo $situacaoSDJ; ?><br />
<? if ($acesso == 2 || $acesso == 3) { ?>                                            </span><span class="TituloNoticia2">&nbsp;&nbsp;&nbsp;Entidade distribuidora: </span><span class="Erro1"><?php echo $row_rsConvenioSDT['nome']; ?></span><? } ?></td>
                                          <td width="8%"><div align="center">
                                              <? if (($acesso == '2' || $acesso == '3') && $row_rsGuias['situacaoSDJ'] < 4) { ?>
                                              <input type="image" name="imageField3" onclick="MM_openBrWindow('../boleto/boleto2Via.php?oq=distribuidor&amp;id_guia=<? echo $row_rsGuias['id']; ?>&amp;situacao=2','uploa','scrollbars=yes,width=750,height=500')" src="../imagens/emitirBoletoP2v.gif" alt="Emitir segunda via" />
                                              <? } ?>
                                          </div></td>
                                        </tr>
                                      </table>
                                    </div></td>
                                  </tr>
                                  <? if ($row_rsGuias['situacaoSDJ'] >= '4') { ?>
                                <tr>
                                    <td height="30" valign="middle" bgcolor="#E0FADC" class="TituloNoticia2"><div align="left">&nbsp;&nbsp;&nbsp;Data da cr&eacute;dito: <span class="Erro1"><?php echo $row_rsGuias['dataMovSDJ']; ?></span><br />
                             &nbsp;&nbsp;&nbsp;Valor da cr&eacute;dito:<span class="Erro1">&nbsp;R$ <?php echo $row_rsGuias['valorRetornoSDJ']; ?><br />
                                        </span>&nbsp;&nbsp;&nbsp;Valor do FARPEN:<span class="Erro1"> R$ <?php if (number_format($row_rsGuias['valorRetornoFARPEN_SDJ'], 2, ",", ".") == "0,00") { echo $row_rsGuias['valorRetornoFARPEN_SDJ']; } else { echo number_format($row_rsGuias['valorRetornoFARPEN_SDJ'], 2, ",", "."); } ?><br />
</span><span class="TituloNoticia2">&nbsp;&nbsp;&nbsp;Valor do FEPJ:</span><span class="Erro1"> R$
<? $vSDJ_FEPJ = number_format($row_rsGuias['valorSDT'], 2, ".", "") * (3 / 100); echo number_format($vSDJ_FEPJ, 2, ",", "."); ?>
</span><br /> 
                                    </div></td>
                                </tr>
                                <? } ?>
                              </table></td>
                            </tr>
                          </table>
                        </div></td>
                      </tr> <? } ?>
                      <tr>
                        <td height="10"></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                          <table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#DCE0E9">
                            <tr>
                              <td><table width="600" border="0" cellspacing="1" cellpadding="0">
                                  <tr>
                                    <td bgcolor="#F4F4FB" class="TituloNoticia2"><div align="center" class="TituloNoticia1">Detalhes das partes </div></td>
                                  </tr>
                                  <tr>
                                    <td height="20" bgcolor="#EFEDFE"><div align="left" class="TituloNoticia2">
                                      <?php
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsOutorgante = "SELECT partesguias.*, partes.nome, partes.cpf, partes.cnpj FROM partesguias, partes WHERE partesguias.id_guia = '$id_guia' AND partesguias.tipo = '0' AND partes.id = partesguias.id_parte";
$rsOutorgante = mysql_query($query_rsOutorgante, $Emolumentos) or die(mysql_error());
$row_rsOutorgante = mysql_fetch_assoc($rsOutorgante);
$totalRows_rsOutorgante = mysql_num_rows($rsOutorgante);
?>
                                      <?



mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsOutorgado = "SELECT partesguias.*, partes.nome, partes.cpf, partes.cnpj FROM partesguias, partes WHERE partesguias.id_guia = '$id_guia' AND partesguias.tipo = '1' AND partes.id = partesguias.id_parte";
$rsOutorgado = mysql_query($query_rsOutorgado, $Emolumentos) or die(mysql_error());
$row_rsOutorgado = mysql_fetch_assoc($rsOutorgado);
$totalRows_rsOutorgado = mysql_num_rows($rsOutorgado);


?>
                                     
                                        <table width="100%" border="0" cellspacing="1" cellpadding="0">
                                            <tr>
                                              <td width="50%" bgcolor="#F4F4FB"><div align="center">Outorgante(s) cadastrado(s) ( <? echo $totalRows_rsOutorgante; ?> )</div></td>
                                              <td width="50%" bgcolor="#F4F4FB"><div align="center">Outorgado(s) cadastrado(s) ( <? echo $totalRows_rsOutorgado; ?> )</div></td>
                                            </tr>
                                            <tr>
                                               <td width="50%" valign="top" bgcolor="#FFFFFF"><div align="center" class="texto">
                                                 <div align="left">
                                                   <?php do { echo "&nbsp;".$row_rsOutorgante['nome']." - ".$row_rsOutorgante['cpf'].$row_rsOutorgante['cnpj']."<br>"; } while ($row_rsOutorgante = mysql_fetch_assoc($rsOutorgante)); ?>
                                                 </div>
                                              </div></td>
                                              <td width="50%" valign="top" bgcolor="#FFFFFF"><div align="center" class="texto">
                                                <div align="left">
                                                  <?php do { echo "&nbsp;".$row_rsOutorgado['nome']." - ".$row_rsOutorgado['cpf'].$row_rsOutorgado['cnpj']."<br>"; } while ($row_rsOutorgado = mysql_fetch_assoc($rsOutorgado)); ?>
                                                </div>
                                              </div></td>
                                            </tr>
                                          </table>
                                        </div></td>
                                  </tr>

                                  <? if ($row_rsGuias['situacaoEmolumento'] >= '4') { ?>

                                  <? } ?>
                              </table></td>
                            </tr>
                          </table>
                        </div></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                  </table></td>
                </tr>
              </table>
            <?php } // Show if recordset not empty ?>
              <?php if ($totalRows_rsGuias == 0) { // Show if recordset empty ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="180" align="center" valign="middle" bgcolor="#FFFFFF" class="Erro1">Usu&aacute;rio n&atilde;o tem acesso a estes dados! </td>
                </tr>
              </table>
            <?php } // Show if recordset empty ?></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
        <? } ?>
</body>
</html>
<?php
mysql_free_result($rsOutorgante);
?>
<? } ?>