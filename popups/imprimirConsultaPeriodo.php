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
function formatarExportacao($var, $m, $tam, $branco)	{
	//	$tam = '20';
		$sizeName = strlen($var);	
		$a="1234567890ÁáÉéÍíÓóÚúÇçÃãÀàÂâÊêÎîÔôÕõÛûü& !#$%¨&*_+}=}{[]^~?:;><'´`";
		$b="1234567890AAEEIIOOUUCCAAAAAAEEIIOOOOUUUE _________________________";
		$var = strtr($var,$a,$b);
		if ($sizeName>$tam)	{ 
			 $var = substr($var,0,$tam); 
		} else {
		
			for ($i = $sizeName; $i < $tam ; $i++) {
			$var = "$branco".$var;	
			}
		
		}
		if (isset($m) && $m == "up") { 
			$var = strtoupper($var);
		}
		if (isset($m) && $m == "down") { 
			$var = strtolower($var);
		}
		return $var;
	}
	function formatarExportacao2($var, $m, $tam, $branco)	{
	//	$tam = '20';
		$sizeName = strlen($var);	
		$a="1234567890ÁáÉéÍíÓóÚúÇçÃãÀàÂâÊêÎîÔôÕõÛûü& !#$%¨&*_+}=}{[]^~?:;><'´`";
		$b="1234567890AAEEIIOOUUCCAAAAAAEEIIOOOOUUUE _________________________";
		$var = strtr($var,$a,$b);
		if ($sizeName>$tam)	{ 
			 $var = substr($var,0,$tam); 
		} else {
		
			for ($i = $sizeName; $i < $tam ; $i++) {
			$var = $var."$branco";
			}
		
		}
		if (isset($m) && $m == "up") { 
			$var = strtoupper($var);
		}
		if (isset($m) && $m == "down") { 
			$var = strtolower($var);
		}
		return $var;
	}

function fc ($v) {
		if (strpos($v,",") > 0){
			$v = str_replace(".","",$v);
			$v = str_replace(",",".",$v);
			return $v;
		}
		return $v;
	}
$qtd = 0;
$vTotal = 0;
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($_GET['oq2'])) { 
$_SESSION['id_guia'] = $_GET['id_guia'];
$_SESSION['situacao'] = $_GET['situacao'];
}

if (isset($_GET['di']) && isset($_GET['df'])) {
if ($acesso != 1) { $id_entidade = $row_rsEntidadeLogin['id']; }
$di_F = substr($_GET['di'], 6, 4).substr($_GET['di'], 3, 2).substr($_GET['di'], 0, 2);
$df_F = substr($_GET['df'], 6, 4).substr($_GET['df'], 3, 2).substr($_GET['df'], 0, 2);



mysql_select_db($database_Emolumentos, $Emolumentos);
if ($acesso == 1) {

$query_rsGuias = "SELECT *, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento_F, date_format(guias.`emicao`, '%d/%m/%Y') as emicao_F, date_format(guias.`dataMovEmolumento`, '%d/%m/%Y') as dataMovEmolumento_F,  date_format(guias.`dataMovFarpen`, '%d/%m/%Y') as dataMovFarpen_F, date_format(guias.`dataMovSDJ`, '%d/%m/%Y') as dataMovSDJ_F 
FROM guias 
WHERE (guias.dataMovFarpen >= '$di_F' AND guias.dataMovFarpen <= '$df_F')
ORDER BY guias.id_entidade DESC";


} else if ($acesso == 2 || $acesso == 3) {

$query_rsGuias = "SELECT *, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento_F, date_format(guias.`emicao`, '%d/%m/%Y') as emicao_F, date_format(guias.`dataMovEmolumento`, '%d/%m/%Y') as dataMovEmolumento_F, date_format(guias.`dataMovSDJ`, '%d/%m/%Y') as dataMovSDJ_F 
FROM guias 
WHERE guias.id_entidade = '$id_entidade' 
AND (guias.dataMovEmolumento >= '$di_F' AND guias.dataMovEmolumento <= '$df_F')
ORDER BY guias.dataMovEmolumento DESC";


} else if ($acesso == '4' || $acesso == '5') {

$query_rsGuias = "SELECT entidades.id, guias.* , date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento_F, date_format(guias.`dataMovEmolumento`, '%d/%m/%Y') as dataMovEmolumento_F, date_format(guias.`dataMovSDJ`, '%d/%m/%Y') as dataMovSDJ_F, date_format(guias.`emicao`, '%d/%m/%Y') as emicao_F 
FROM entidades, guias 
WHERE entidades.id_sdt = '$idsLog' 
AND guias.id_entidade = entidades.id 
AND guias.tipo = 'Escritura'

AND (guias.dataMovSDJ >= '$di_F' AND guias.dataMovSDJ <= '$df_F')
ORDER BY guias.dataMovSDJ DESC";  // 

}
$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
$row_rsGuias = mysql_fetch_assoc($rsGuias);
$totalRows_rsGuias = mysql_num_rows($rsGuias);


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
          <td><img src="../imagens/tjLogo.gif" width="201" height="46" /></td>
          <td class="TituloPagina"><div align="right"><img src="../imagens/SigreLogo.gif" width="287" height="40" /> </div>
              <div align="right"></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td><br />
<div align="center"> <p class="TituloPagina">Guia de Recolhimento da Taxa de Comunica&ccedil;&atilde;o <br />
  - Relat&oacute;rio de Guias Creditadas -<br />

<table width="730" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td bgcolor="FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="0">
          
          <tr>
            <td bgcolor="#FFFFFF"><div align="center">
              <table width="725" height="20" border="0" cellpadding="0" cellspacing="1" >
                <? 
		$qtd = 0;
		
		if ($mes < 10) $mes = "0".$mes;
		if ($dia < 10) $dia = "0".$dia;
		$dataHoje = $ano.$mes.$dia;

		
	do { 

		
		
		$vencimento = substr($row_rsGuias['vencimento'], 0, 4).substr($row_rsGuias['vencimento'], 5, 2).substr($row_rsGuias['vencimento'], 8, 2);

		
		// seta o tamanho do ano
		$anos = substr($row_rsGuias['ano'], 2, 2);
		$tam = 5;
		$tamNumero = strlen($row_rsGuias['numero']);
		if ($tamNumero>$tam)	{ 
			$numeros = substr($row_rsGuias['numero'],0,$tam); 
		} else {
			$numeros = $row_rsGuias['numero'];
			for ($i = $tamNumero; $i < $tam ; $i++) {
				$numeros = '0'.$numeros;	
			}
		}
		// seta o tamanho da id da entidade
		$tam = 3;
		$tamIdEnt = strlen($row_rsGuias['id_entidade']);
		if ($tamIdEnt>$tam)	{ 
			$id_entidade = substr($row_rsGuias['id_entidade'],0,$tam); 
		} else {
			$id_entidade =$row_rsGuias['id_entidade'];
			for ($i = $tamIdEnt; $i < $tam ; $i++) {
				$id_entidade = '0'.$id_entidade;	
			}
		}
		




		if ($row_rsGuias['tipo'] == "Escritura"){
			$corFundo = "#FFFFFF";
		} else if ($row_rsGuias['tipo'] == "Registro") {
			$corFundo = "#FFFFFF";
		}



		// indentifica o nivel de acesso dos usuarios
		if ($acesso == 1) {
			
			$dataMov = $row_rsGuias['dataMovFarpen_F']; // data pra impress&atilde;o
			if ($row_rsGuias['situacaoFarpen'] >= 4) {
				$SitGuia = "PAGO";
			} else if (($dataHoje > $vencimento) && ($row_rsGuias['situacaoEmolumento'] >= 4)) {
				$SitGuia = "PENDENTE";
				$corFundo = "#FFFFFF";
			} else if ($row_rsGuias['situacaoEmolumento'] < 4 && $row_rsGuias['situacaoFarpen'] < 4) {
					$SitGuia = "EMITIDO";
			}
			
		} else if ($acesso == 2 || $acesso == 3) {
			
			$dataMov = $row_rsGuias['dataMovEmolumento_F']; // data pra impressao
			if ($row_rsGuias['tipo'] == "Escritura") {
			
				if ($row_rsGuias['situacaoEmolumento'] >= 4 && $row_rsGuias['situacaoSDJ'] >= 4 && $row_rsGuias['situacaoFarpen'] >= 4) {
					$SitGuia = "PAGO";
				} else if ($dataHoje > $vencimento && ($row_rsGuias['situacaoEmolumento'] >= 4 || ($row_rsGuias['situacaoEmolumento'] >= 4 xor $row_rsGuias['situacaoSDJ'] >= 4 xor $row_rsGuias['situacaoFarpen'] >= 4))) {
					$SitGuia = "PENDENTE";
					$corFundo = "#FFFFFF";
				} else if ($row_rsGuias['situacaoEmolumento'] < 4 && $row_rsGuias['situacaoSDJ'] < 4 && $row_rsGuias['situacaoFarpen'] < 4) {
					$SitGuia = "EMITIDO";
				}
				
			} else if ($row_rsGuias['tipo'] == "Registro") {
				if ($row_rsGuias['situacaoEmolumento'] >= 4 && $row_rsGuias['situacaoFarpen'] >= 4) {
					$SitGuia = "PAGO";
				} else if ($dataHoje > $vencimento && ($row_rsGuias['situacaoEmolumento'] >= 4 || ($row_rsGuias['situacaoEmolumento'] >= 4 xor $row_rsGuias['situacaoSDJ'] >= 4 xor $row_rsGuias['situacaoFarpen'] >= 4))) {
					$SitGuia = "PENDENTE";
					$corFundo = "#FFFFFF";
				} else if ($row_rsGuias['situacaoEmolumento'] < 4 && $row_rsGuias['situacaoSDJ'] < 4 && $row_rsGuias['situacaoFarpen'] < 4) {
					$SitGuia = "EMITIDO";
				}
			}
		
		} else if ($acesso == 4 || $acesso == 5) {
			if ($row_rsGuias['tipo'] == "Escritura"){
				$dataMov = $row_rsGuias['dataMovSDJ_F']; // data pra impress&atilde;o
				if ($row_rsGuias['situacaoSDJ'] >= 4) {
					$SitGuia = "PAGO";
				} else if (($dataHoje > $vencimento) && ($row_rsGuias['situacaoSDJ'] < 4 && $row_rsGuias['situacaoEmolumento'] >= 4)) {
					$SitGuia = "PENDENTE";
					$corFundo = "#FFFFFF";
				} else if ($row_rsGuias['situacaoEmolumento'] < 4 && $row_rsGuias['situacaoSDJ'] < 4) {
					$SitGuia = "EMITIDO";
				} 
			} else {
				$SitGuia == "reg";
			}
		}
		
$doctipo = "";
		
		$doctipo = substr(strtoupper($row_rsGuias['tipo']), 0, 3).". ";
		if ($doctipo == 'ESC. ') { 
			if ($row_rsGuias['declarado'] == 's') { 
				if ($row_rsGuias['TipoImovel'] != 'N/D') { 
					$doctipo .="COM VALOR (IMOBILIARIA)";
				} else {
					
					$doctipo .="COM VALOR (".formatarExportacao ($row_rsGuias['id_natuEsc'], "up", "23", "").")";
				}
			} else {
				if (strtoupper($row_rsGuias['ndescricao']) == "OUTRAS (SEM VALOR DECLARADO)") { 
					$doctipo .= "SEM VALOR (OUTRAS)";
				}else{
					$doctipo .= "SEM VALOR (".formatarExportacao ($row_rsGuias['ndescricao'], "up", "23", "").")";
				}
			}
		
		} else if ($doctipo == 'REG. ') { 
			
			$idTipoReg = $row_rsGuias['tipoRegistro'];
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsTipoRegistro = "SELECT * FROM tiporegistro WHERE tiporegistro.id = '$idTipoReg'";
			$rsTipoRegistro = mysql_query($query_rsTipoRegistro, $Emolumentos) or die(mysql_error());
			$row_rsTipoRegistro = mysql_fetch_assoc($rsTipoRegistro);
			$totalRows_rsTipoRegistro = mysql_num_rows($rsTipoRegistro);
			
			if ($idTipoReg == 7 || $idTipoReg == 20) { 
				$doctipo .= "DE IMOVEL "; 
			} else { 
				$doctipo .= "DE IMOVEL "; 
			}
			
			$doctipo .= "(".formatarExportacao ($row_rsTipoRegistro['nome'], "up", "23", "").")";
		}

		
		
		
		if ( ((isset($_SESSION['creditadas']) && $_SESSION['creditadas'] == "1") && (isset($SitGuia) && $SitGuia == "PAGO")) || ((isset($_SESSION['pendentes']) && $_SESSION['pendentes'] == "1") && (isset($SitGuia) && $SitGuia == "PENDENTE")) ) { 
		$qtd = $qtd + 1;
		
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
                    <td><span class="SubTitulo">Data da emiss&atilde;o:</span><span class="TituloNoticia2">&nbsp;<?php echo $row_rsGuias['emicao_F']; ?></span></td>
                    <td><span class="SubTitulo">Data do cr&eacute;dito:</span><span class="TituloNoticia2">&nbsp;<?php echo $row_rsGuias['dataMovSDJ_F']; ?></span></td>
                  </tr>
                                  </table></td>
            </tr>
                              <tr>
                                <td bgcolor="FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><div align="left"><? $id_Ent = $row_rsGuias['id_entidade'];
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsConveniosSN = "SELECT entidades.id, entidades.nome, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_Ent'";
	$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
	$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
	$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
						
			echo "<span class=\"SubTitulo\">&nbsp;&nbsp;Of&iacute;cio: </span><span class=\"texto\">".$row_rsConveniosSN['nome']."</span><br>"; 
			
			
			
			$doctipo = "";
		
		$doctipo = substr(strtoupper($row_rsGuias['tipo']), 0, 3).". ";
		if ($doctipo == 'ESC. ') { 
			if ($row_rsGuias['declarado'] == 's') { 
				if ($row_rsGuias['TipoImovel'] != 'N/D') { 
					$doctipo .="COM VALOR (IMOBILIARIA)";
				} else {
					
					$doctipo .="COM VALOR (".formatarExportacao ($row_rsGuias['id_natuEsc'], "up", "23", "").")";
				}
			} else {
				if (strtoupper($row_rsGuias['ndescricao']) == "OUTRAS (SEM VALOR DECLARADO)") { 
					$doctipo .= "SEM VALOR (OUTRAS)";
				}else{
					$doctipo .= "SEM VALOR (".formatarExportacao ($row_rsGuias['ndescricao'], "up", "23", "").")";
				}
			}
		
		} else if ($doctipo == 'REG. ') { 
			
			$idTipoReg = $row_rsGuias['tipoRegistro'];
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsTipoRegistro = "SELECT * FROM tiporegistro WHERE tiporegistro.id = '$idTipoReg'";
			$rsTipoRegistro = mysql_query($query_rsTipoRegistro, $Emolumentos) or die(mysql_error());
			$row_rsTipoRegistro = mysql_fetch_assoc($rsTipoRegistro);
			$totalRows_rsTipoRegistro = mysql_num_rows($rsTipoRegistro);
			
			if ($idTipoReg == 7 || $idTipoReg == 20) { 
				$doctipo .= "DE IMOVEL "; 
			} else { 
				$doctipo .= "DE IMOVEL "; 
			}
			
			$doctipo .= "(".formatarExportacao ($row_rsTipoRegistro['nome'], "up", "23", "").")";
		}
			
			
			?></div></td>
                  </tr>
                                  <tr>
                                    <td><div align="left">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="50%"><span class="SubTitulo">&nbsp;&nbsp;Ntureza:</span><span class="texto"> <? echo $doctipo; ?></span></td>
                            <td><? if (isset($row_rsGuias['TipoImovel']) && $row_rsGuias['TipoImovel'] != "") { echo "<span class=\"SubTitulo\">Tipo de Imóvel: </sapn><span class=\"texto\">".$row_rsGuias['TipoImovel']."</span>"; } ?></td>
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
                      <?php echo number_format($row_rsGuias['valorRetornoFARPEN_SDJ'], 2, ",", "."); ?>
                      </span> </div></td>
                  </tr>
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
                          <td width="33%" bgcolor="#FFFFFF" class="TituloNoticia2"><div align="center"><? echo $_GET['di']." at&eacute; ".$_GET['df']; ?></div></td>
                          <td width="33%" bgcolor="#FFFFFF" class="TituloNoticia2"><div align="center"><? echo "R$ ".number_format($vTotal, 2, ",", "."); ?></div></td>
                        </tr>
                      </table>
                  </div></td>
                </tr>
            </table></td>
          </tr>
        </table>
        <span class="texto">SIGRE -
        Sistemas Sapiens Tecnologia - http://www.sapienstecnologia.com.br/ </span><br />
    </div></td>
  </tr>
</table>
<script language="javascript">
window.print();
</script>
<? } } ?>