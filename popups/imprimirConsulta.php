<?php require_once('../../core/restritoPopUp.php'); 
if (isset($erros) && $erros == "off" || $erros == "erro") {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: sigre.php'); 
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
function fc ($v) {
		if (strpos($v,",") > 0){
			$v = str_replace(".","",$v);
			$v = str_replace(",",".",$v);
			return $v;
		}
		return $v;
	}
$n = 0;
$vTotal = 0;
$qtd = 0;


if ($mes<10){ $mes = "0".$mes; }
if (isset($_GET['oq'])) { 
$oq = $_GET['oq'];
if ($acesso > 1) {
$id_entidade = $row_rsEntidadeLogin['id']; 
}
if ($acesso == '4' || $acesso == '5'){


mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsGuias = "SELECT entidades.nome, entidades.id, guias.*, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento, date_format(guias.`emicao`, '%d/%m/%Y') as emicao, date_format(guias.`dataMovEmolumento`, '%d/%m/%Y') as dataMovEmolumento, date_format(guias.`dataMovSDJ`, '%d/%m/%Y') as dataMovSDJ FROM guias, entidades WHERE (entidades.id_sdt = '$id_entidade') AND guias.id_entidade = entidades.id AND guias.situacaoSDJ >= '4' AND guias.tipo = 'Escritura' ORDER BY guias.dataMovSDJ DESC";
$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
$row_rsGuias = mysql_fetch_assoc($rsGuias);
$totalRows_rsGuias = mysql_num_rows($rsGuias);
} else {
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsGuias = "SELECT *, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento, date_format(guias.`emicao`, '%d/%m/%Y') as emicao, date_format(guias.`dataMovEmolumento`, '%d/%m/%Y') as dataMovEmolumento FROM guias WHERE guias.id_entidade = '$id_entidade' ORDER BY guias.numero DESC";
$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
$row_rsGuias = mysql_fetch_assoc($rsGuias);
$totalRows_rsGuias = mysql_num_rows($rsGuias);
}
?>
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
<link href="../estilos.css" rel="stylesheet" type="text/css">

<title>Relat&oacute;rio</title><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
          <td class="TituloPagina"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Relat&oacute;rio</div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td><div align="center">
        <table width="730" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="0">

                <tr>
                  <td bgcolor="#FFFFFF"><div align="center">
                    <table width="725" height="20" border="0" cellpadding="0" cellspacing="1" >
                      <?php do { 
				
		$dVenc = substr($row_rsGuias['vencimento'], 0, 2);
		$mVenc = substr($row_rsGuias['vencimento'], 3, 2);
		$aVenc = substr($row_rsGuias['vencimento'], 6, 4);
		$Venc = substr($row_rsGuias['vencimento'], 6, 4).substr($row_rsGuias['vencimento'], 3, 2).substr($row_rsGuias['vencimento'], 0, 2);
		
		if ($acesso == 2 || $acesso == 3) {
			$d = substr($row_rsGuias['dataMovEmolumento'], 0, 2);
			$m = substr($row_rsGuias['dataMovEmolumento'], 3, 2);
			$a = substr($row_rsGuias['dataMovEmolumento'], 6, 4);
		} else if ($acesso == 4 || $acesso == 5) {
			$d = substr($row_rsGuias['dataMovSDJ'], 0, 2);
			$m = substr($row_rsGuias['dataMovSDJ'], 3, 2);
			$a = substr($row_rsGuias['dataMovSDJ'], 6, 4);
		}
		
		$res=checkdate($m,$d,$a);
	
		if ($res==1){
		$dias_do_mes = date ("t", mktime (0,0,0,$m,$d,$a));
		$diaV = $d + 7;
		if ($diaV > $dias_do_mes) {
			$diaV = $diaV - $dias_do_mes;
			$mesV = $m + 1;
			if ($mesV<10){ $mesV = "0".$mesV; }
		} else { 
			$mesV = $m;
		}
		if ($mesV > 12){
			$mesV = "01";
			$anoV = $a + 1;
		} else { 
			$anoV = $a;
		}
	
		if ($diaV<10){ $diaV = "0".$diaV; }
		$validade = $anoV.$mesV.$diaV; // vencimento

		$dataAtual = $ano.$mes.$dia;
		
	} else {
		echo "Data incorreta, entre em contato com o Suporte dos sistemas Sapiens.";
	}
	$sit = "_";
	if ($row_rsGuias['tipo'] == "Escritura") {
		
		if (($row_rsGuias['situacaoEmolumento'] < 4) && ($row_rsGuias['situacaoFarpen'] < 4) && ($row_rsGuias['situacaoSDJ'] < 4)) {
			$sit = "EMITIDO";
		} else
		if (($row_rsGuias['situacaoEmolumento'] >= 4) && ($row_rsGuias['situacaoFarpen'] >= 4) && ($row_rsGuias['situacaoSDJ'] >= 4)) {
			if ($dataAtual <= $validade) {
				$sit = "PAGA";
			} else {
				$sit = "PAGAVENCIDA";
			}
		} else if (($row_rsGuias['situacaoEmolumento'] <= 4) || ($row_rsGuias['situacaoFarpen'] <= 4) || ($row_rsGuias['situacaoSDJ'] <= 4)) {
			$sit = "PENDENTE";
		}
	} else if ($row_rsGuias['tipo'] == "Registro") {
		
		if (($row_rsGuias['situacaoEmolumento'] < 4) && ($row_rsGuias['situacaoFarpen'] < 4)) {
			$sit = "EMITIDO";
		} else
		if (($row_rsGuias['situacaoEmolumento'] >= 4) && ($row_rsGuias['situacaoFarpen'] >= 4)) {
			if ($dataAtual <= $validade) {
				$sit = "PAGA";
			} else {
				$sit = "PAGAVENCIDA";
			}
		} else if (($row_rsGuias['situacaoEmolumento'] <= 4) || ($row_rsGuias['situacaoFarpen'] <= 4)) {
			$sit = "PENDENTE";
		}
	}
	
	if ( (($acesso == 2 || $acesso == 3) && (isset($sit) && $sit == "PENDENTE") || $sit == "PAGA") || ($Venc >= $dataAtual && $sit = "EMITIDO") ) {
				
				$qtd = $qtd + 1;

if ($row_rsGuias['numero'] < 10){ $numeros = "0000".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 100) { $numeros = "000".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 1000) { $numeros = "00".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 10000) { $numeros = "0".$row_rsGuias['numero']; } 
$anos = substr($row_rsGuias['ano'], 2, 2);

if ($row_rsGuias['id_entidade'] < 10){ $id_entidade = "00".$row_rsGuias['id_entidade']; } else if ($row_rsGuias['id_entidade'] < 100) { $id_entidade = "0".$row_rsGuias['id_entidade']; } 


if ($acesso == '4' || $acesso == '5'){

	$id_Ent = $row_rsGuias['id_entidade'];
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsConveniosSN = "SELECT entidades.id, entidades.nome, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_Ent'";
	$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
	$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
	$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
	
	$id_sdt = $row_rsConveniosSN['id_sdt'];
} else {
	
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


				?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="730" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="DCE0E9"><table width="100%" border="0" cellspacing="1" cellpadding="0">
      <tr>
        <td bgcolor="#EFECFF"><table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td bgcolor="FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div align="left"><span class="SubTitulo">&nbsp;&nbsp;N&uacute;mero do documento:</span> <span class="TituloNoticia2"><?php echo $id_entidade.".".$anos.".".$numeros; ?></span></div></td>
                  <td><span class="SubTitulo">Data da emiss&atilde;o:</span><span class="TituloNoticia2">&nbsp;<?php echo $row_rsGuias['emicao']; ?></span></td>
                  <td><span class="SubTitulo">Data do cr&eacute;dito:</span><span class="TituloNoticia2">&nbsp;<?php echo $row_rsGuias['dataMovSDJ']; ?></span></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td bgcolor="FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div align="left"><? echo "<span class=\"SubTitulo\">&nbsp;&nbsp;Of&iacute;cio: </span><span class=\"texto\">".$row_rsConveniosSN['nome']."</span><br>"; ?></div></td>
                </tr>
                <tr>
                  <td><div align="left">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="50%"><? echo "<span class=\"SubTitulo\">&nbsp;&nbsp;Natureza da escritura: </span><span class=\"texto\">".$row_rsGuias['id_natuEsc']."</span>"; ?></td>
                          <td><? echo "<span class=\"SubTitulo\">&nbsp;&nbsp;Tipo de im&oacute;vel: </span><span class=\"texto\">".$row_rsGuias['TipoImovel']."</span><br>";?></td>
                        </tr>
                      </table>
                  </div></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td bgcolor="FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div align="left">&nbsp;&nbsp;<span class="SubTitulo">Valor da transa&ccedil;&atilde;o:&nbsp;</span><span class="TituloNoticia2">R$ <?php echo $row_rsGuias['valorSDT']; ?></span></div></td>
                  <td><div align="center"><span class="SubTitulo">Valor do Emolumento:</span><span class="TituloNoticia2"> R$ <?php echo $row_rsGuias['valorRetornoSDJ']; $vTotal = $vTotal + (fc ($row_rsGuias['valorRetornoSDJ'])); ?></span></div></td>
                  <td><div align="center"><span class="SubTitulo">FEPJ:</span><span class="TituloNoticia2">&nbsp;R$
                    <? $vSDJ_FEPJ = number_format($row_rsGuias['valorSDT'], 2, ".", "") * (3 / 100); echo number_format($vSDJ_FEPJ, 2, ",", "."); ?>
                    &nbsp;</span></div></td>
                  <td><div align="center"><span class="SubTitulo">FARPEN:</span><span class="TituloNoticia2">&nbsp;R$
                    <?php if (number_format($row_rsGuias['valorRetornoFARPEN_SDJ'], 2, ",", ".") == "0,00") { echo $row_rsGuias['valorRetornoFARPEN_SDJ']; } else { echo number_format($row_rsGuias['valorRetornoFARPEN_SDJ'], 2, ",", "."); } $n = $n + 1; ?>
                  </span> </div></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td bgcolor="FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>
                <td height="20" bgcolor="#EFEDFE"><div align="left" class="TituloNoticia2">
                    <?php
					$id_guia = $row_rsGuias['id'];
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
                        <td width="50%" bgcolor="#FBFBFD"><div align="center" class="SubTitulo">Outorgante(s) cadastrado(s) ( <? echo $totalRows_rsOutorgante; ?> )</div></td>
                        <td width="50%" bgcolor="#FBFBFD"><div align="center" class="SubTitulo">Outorgado(s) cadastrado(s) ( <? echo $totalRows_rsOutorgado; ?> )</div></td>
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
        </table></td>
      </tr>
    </table></td>
  </tr>
</table><br /></td>
  </tr>
</table>

                      <?php } } while ($row_rsGuias = mysql_fetch_assoc($rsGuias)); ?>
                    </table>
                  </div></td>
                </tr>
            </table></td>
          </tr>
        </table>
    </div></td>
  </tr>
  <tr>
    <td><div align="center"><br />
        <table width="730" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="DCE0E9"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td height="20" background="../imagens/topo.jpg" bgcolor="#FFFFFF"><div align="center" class="TituloNoticia1">RESUMO GERAL DO RELATORIO </div></td>
                </tr>
                <tr>
                  <td bgcolor="#EFECFF"><div align="center">
                      <table width="100%" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                          <td width="33%" bgcolor="#FFFFFF"><div align="center" class="SubTitulo">Qtd. registros </div></td>
                          <td width="33%" bgcolor="#FFFFFF" class="SubTitulo"><div align="center">Periodo do relat&oacute;rio </div></td>
                          <td width="33%" bgcolor="#FFFFFF" class="SubTitulo"><div align="center">Valor Total dos emolumentos </div></td>
                        </tr>
                        <tr>
                          <td width="33%" bgcolor="#FFFFFF" class="TituloNoticia2"><div align="center"><? echo $qtd; ?></div></td>
                          <td width="33%" bgcolor="#FFFFFF" class="TituloNoticia2"><div align="center"><?
$validade = $dia."/".$mes."/".$ano;
 
$mq = substr($validade, 3, 2);
$dq = substr($validade, 0, 2);
$aq = substr($validade, 6, 4);
$dias_do_mes = date ("t", mktime (0,0,0,$mq,$dq,$aq));
		$diaV = $dq - 7;
		if ($diaV > $dias_do_mes) {
			$diaV = $diaV - $dias_do_mes;
			$mesV = $mq + 1;
			if ($mesV<10){ $mesV = "0".$mesV; }
		} else { 
			$mesV = $mq;
		}
		if ($mesV > 12){
			$mesV = "01";
			$anoV = $aq + 1;
		} else { 
			$anoV = $aq;
		}
	
		if ($diaV<10){ $diaV = "0".$diaV; }

 echo $diaV."/".$mesV."/".$anoV." at&eacute; ".$validade; ?></div></td>
                          <td width="33%" bgcolor="#FFFFFF" class="TituloNoticia2"><div align="center"><? echo "R$ ".number_format($vTotal, 2, ",", "."); ?></div></td>
                        </tr>
                      </table>
                  </div></td>
                </tr>
            </table></td>
          </tr>
        </table>
        <span class="texto"> SIGRE -
   Sistemas Sapienste - http://www.sapienstecnologia.com.br/ </span><br />
    <br />
    </div></td>
  </tr>
 
</table>
<script language="javascript">
window.print();
</script>
<? } } ?>