<?php
$acao = "Executou o cauculo de emolumento";
//require_once('../core/restrito.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso > 3) {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }

	header ('Location: sigre.php'); 

} else {

	$declarado = $_SESSION['declarado'];
	$tipo = $_SESSION['tipo'];
	if (isset($_SESSION['outorgado']['1'])) { 	$id_outorgado = $_SESSION['outorgado']['1']; } else { $id_outorgado = ""; }
	$id_outorgante = $_SESSION['outorgante']['1'];
	$id_EntidadeLogin = $row_rsEntidadeLogin['id'];
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsNumero = "SELECT guias.numero FROM guias WHERE guias.id_entidade = '$id_EntidadeLogin' ORDER BY guias.numero DESC";
	$rsNumero = mysql_query($query_rsNumero, $Emolumentos) or die(mysql_error());
	$row_rsNumero = mysql_fetch_assoc($rsNumero);
	$totalRows_rsNumero = mysql_num_rows($rsNumero);
	$numero = $row_rsNumero['numero'];
	// Data
	if ($mes<10){ $mes = "0".$mes; }
//	if ($dia<10){ $dia = "0".$dia; }	
	$res=checkdate($mes,$dia,$ano);
	
	if ($res==1){
		$dias_do_mes = date ("t", mktime (0,0,0,$mes,$dia,$ano));
		$diaV = $dia + 7;
		if ($diaV > $dias_do_mes) {
			$diaV = $diaV - $dias_do_mes;
			$mesV = $mes + 1;
			if ($mesV<10){ $mesV = "0".$mesV; }
		} else { 
			$mesV = $mes;
		}
		if ($mesV > 12){
			$mesV = "01";
			$anoV = $ano + 1;
		} else { 
			$anoV = $ano;
		}
	
		if ($diaV<10){ $diaV = "0".$diaV; }
		$vencimento = $anoV."-".$mesV."-".$diaV; // vencimento
		$emicao = $ano."-".$mes."-".$dia; // emissao
	
	} else {
		echo "Data incorreta, entre em contato com o Suporte dos sistemas Sapiens.";
	}
	// Fim da data
	
	function fc ($v) {
		if (strpos($v,",") > 0){
			$v = str_replace(".","",$v);
			$v = str_replace(",",".",$v);
			return $v;
		}
		return $v;
	}
	if (isset($_GET['valorFiscal'])) { $vNovoFiscal = $_GET['valorFiscal']; } else { $vNovoFiscal = "0"; }
	if ($_SESSION['declarado'] == "s") { // se ouver valor declarado
	
		if (isset($_GET['id_NatuEsc'])) { $id_NatuEsc = $_GET['id_NatuEsc']; } else { $id_NatuEsc = "N/D"; }
		if (isset($_GET['valorFiscal'])) { $vNovoFiscal = $_GET['valorFiscal']; } else { $vNovoFiscal = "0"; }
				
		if (isset($_GET['TipoImovel'])) { $id_TipoImovel = $_GET['TipoImovel']; } else { $id_TipoImovel = "N/D"; }
		if (isset($_GET['ValorM3'])) { $ValorM3 = $_GET['ValorM3']; } else { $ValorM3 = ""; }// ----------------------------------------------------> tiporegistro - valor m3 - 2 e 3
		if (isset($_GET['areaConstruida'])) { $areaConstruida = $_GET['areaConstruida']; } else { $areaConstruida = ""; }// -----------------------> tiporegistro - area construida - 2 e 3
		if (isset($_GET['unidadeHabitacional'])) { $unidadeHabitacional = $_GET['unidadeHabitacional']; } else { $unidadeHabitacional = ""; }// ---> tiporegistro - unidade Habitacional - 3, 5, 6, 7, 14, 16
		if (isset($_GET['QtdHerdeiros'])) { $QtdHerdeiros = $_GET['QtdHerdeiros']; } else { $QtdHerdeiros = ""; }// -------------------------------> tiporegistro - Qtd. herdeiros - 10
		if (isset($_GET['AV'])) { $AV = $_GET['AV']; } else { $AV = ""; } // ----------------------------------------------------------------------> tiporegistro - Alteracao de valor - 15 (CAMPO S OU N) -> ainda nao cadastrado
		if (isset($_SESSION['TipoRegistro'])) { $TipoRegistro = $_SESSION['TipoRegistro']; } else { $TipoRegistro = ""; }// ----------------------------> tiporegistro - id do tipo de registro. filtro db registro.
		if (isset($_GET['vHipoteca'])) { $vHipoteca = $_GET['vHipoteca']; } else { $vHipoteca = ""; }
		if (isset($_GET['caracteristicas'])) { $caracteristicas = $_GET['caracteristicas']; } else { $caracteristicas = "N/D"; }
		
		
		
		$vFiscal = fc ("$vNovoFiscal");
				
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rs_vdeclarado = "SELECT * FROM vdeclarado"; // chama dados de valor progrecivo
		$rs_vdeclarado = mysql_query($query_rs_vdeclarado, $Emolumentos) or die(mysql_error());
		$row_rs_vdeclarado = mysql_fetch_assoc($rs_vdeclarado);
		$totalRows_rs_vdeclarado = mysql_num_rows($rs_vdeclarado);
		
		$faixaAate = $row_rs_vdeclarado['faixaAate'];
		$faixaAate = fc ("$faixaAate");
		
		$faixaAvalor = $row_rs_vdeclarado['faixaAvalor'];
		$faixaAvalor = fc ("$faixaAvalor");
		
		$faixaBde = $row_rs_vdeclarado['faixaBde'];
		$faixaBde = fc ("$faixaBde");
		
		$faixaBate = $row_rs_vdeclarado['faixaBate'];
		$faixaBate = fc ("$faixaBate");
		
		$faixaBvalor = $row_rs_vdeclarado['faixaBvalor'];
		$faixaBvalor = fc ("$faixaBvalor");
		
		$faixaCde = $row_rs_vdeclarado['faixaCde'];
		$faixaCde = fc ("$faixaCde");
		
		$faixaCate = $row_rs_vdeclarado['faixaCate'];
		$faixaCate = fc ("$faixaCate");
		
		$faixaCvalor = $row_rs_vdeclarado['faixaCvalor'];
		$faixaCvalor = fc ("$faixaCvalor");
		
		$faixaDde = $row_rs_vdeclarado['faixaDde'];
		$faixaDde = fc ("$faixaDde");
		
		$faixaDate = $row_rs_vdeclarado['faixaDate'];
		$faixaDate = fc ("$faixaDate");
		
		$faixaDvalor = $row_rs_vdeclarado['faixaDvalor'];
		$faixaDvalor = fc ("$faixaDvalor");
		
		$acimaDe = $row_rs_vdeclarado['acimaDe'];
		$acimaDe = fc ("$acimaDe");
		
		$acrecentar = $row_rs_vdeclarado['acrecentar'];
		$acrecentar = fc ("$acrecentar");
		
		$pcada = $row_rs_vdeclarado['pcada'];
		$pcada = fc ("$pcada");
		
		$limite = $row_rs_vdeclarado['limite'];
		$limite = fc ("$limite");
	
		
		if ($tipo == "Escritura"){ // gera valores para a escritura
		
		if ($vFiscal <= $faixaAate){
			$vCauculo=$faixaAvalor;
		} else if ($vFiscal <= $faixaBate){
			$vCauculo=$faixaBvalor;
		} else if ($vFiscal <=  $faixaCate){
			$vCauculo=$faixaCvalor;
		} else if ($vFiscal <= $faixaDate){
			$vCauculo=$faixaDvalor;
		} else if ($vFiscal > $acimaDe){
			$vCaucular = $vFiscal;
			$vCauculado = $vCaucular - $acimaDe;
			$vDividido = $vCauculado / $pcada;
			$vMutiplicado = ($vDividido * $acrecentar) + $faixaDvalor;
			if ($vMutiplicado > $limite){
				$vCauculo = $limite;
			} else {
				$vCauculo = $vMutiplicado; // Valor do emolumento de acordo com a tabela progreciva
			}
		}
		
		
	
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsFapenDistribuidor = "SELECT * FROM farpen WHERE farpen.id = '5'";
			$rsFapenDistribuidor = mysql_query($query_rsFapenDistribuidor, $Emolumentos) or die(mysql_error());
			$row_rsFapenDistribuidor = mysql_fetch_assoc($rsFapenDistribuidor);
			$totalRows_rsFapenDistribuidor = mysql_num_rows($rsFapenDistribuidor);
			
			$farpenD = $row_rsFapenDistribuidor['valor'];
			$farpenD = fc ("$farpenD");
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsDistribuidor = "SELECT * FROM distribuicao";
			$rsDistribuidor = mysql_query($query_rsDistribuidor, $Emolumentos) or die(mysql_error());
			$row_rsDistribuidor = mysql_fetch_assoc($rsDistribuidor);
			$totalRows_rsDistribuidor = mysql_num_rows($rsDistribuidor);
		
			$distribuidor = $row_rsDistribuidor['valor'];
			$distribuidor = fc ("$distribuidor");
			
			$vDist = $distribuidor + $farpenD; // Valor da guia de distribuição
			$vDist = number_format($vDist, 2, ",", "."); // formata a guia de distribuição para o db
	
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsFapenEscDeclarado = "SELECT * FROM farpen WHERE farpen.id = '1'";
			$rsFapenEscDeclarado = mysql_query($query_rsFapenEscDeclarado, $Emolumentos) or die(mysql_error());
			$row_rsFapenEscDeclarado = mysql_fetch_assoc($rsFapenEscDeclarado);
			$totalRows_rsFapenEscDeclarado = mysql_num_rows($rsFapenEscDeclarado);
			
			$vFarpen = $row_rsFapenEscDeclarado['valor'];
			$vFarpen = fc ("$vFarpen");  // valor do farpen de escritura com valor declarado
	
		
		} else if ($tipo == "Registro" || $tipo == "EscrituraRegistro") { //genra volores para registros

		if (isset($_SESSION['idCarReg'])) { $idReg = $_SESSION['idCarReg']; }
				
			if ($_SESSION['tipoRegistro'] == "1" || $_SESSION['tipoRegistro'] == "22" || $_SESSION['tipoRegistro'] == "5" || $_SESSION['tipoRegistro'] == "8" || $_SESSION['tipoRegistro'] == "10" || $_SESSION['tipoRegistro'] == "11" || $_SESSION['tipoRegistro'] == "12" || $_SESSION['tipoRegistro'] == "13" || $_SESSION['tipoRegistro'] == "14") {  // Registro Smples || Desmenbramento || Desmenbramento e Remenbramento || CEF
		if ($tipo == "EscrituraRegistro") { 
		$tipo = "Registro";
			$_SESSION['addGuia'] = "off";
			$id_guia = $_SESSION['id_guia'];
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsGuiaRegEsc = "SELECT * FROM guias WHERE guias.id = '$id_guia'";
			$rsGuiaRegEsc = mysql_query($query_rsGuiaRegEsc, $Emolumentos) or die(mysql_error());
			$row_rsGuiaRegEsc = mysql_fetch_assoc($rsGuiaRegEsc);
			$totalRows_rsGuiaRegEsc = mysql_num_rows($rsGuiaRegEsc);
						
			$id_TipoImovel = $row_rsGuiaRegEsc['TipoImovel'];
			$id_NatuEsc = $row_rsGuiaRegEsc['id_natuEsc'];
			$vNovoFiscal = $row_rsGuiaRegEsc['vfiscal']; 
			$caracteristicas = $row_rsGuiaRegEsc['caracteristicas'];
		}
		
		
			if ($vFiscal <= $faixaAate){
				$vCauculo=$faixaAvalor;
			} else if ($vFiscal <= $faixaBate){
				$vCauculo=$faixaBvalor;
			} else if ($vFiscal <=  $faixaCate){
				$vCauculo=$faixaCvalor;
			} else if ($vFiscal <= $faixaDate){
				$vCauculo=$faixaDvalor;
			} else if ($vFiscal > $acimaDe){
				$vCaucular = $vFiscal;
				$vCauculado = $vCaucular - $acimaDe;
				$vDividido = $vCauculado / $pcada;
				$vMutiplicado = ($vDividido * $acrecentar) + $faixaDvalor;
				if ($vMutiplicado > $limite){
					$vCauculo = $limite;
				} else {
					$vCauculo = $vMutiplicado; // Valor do emolumento de acordo com a tabela progreciva
				}
			}
		
			
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsFapenRegDeclarado = "SELECT * FROM farpen WHERE farpen.id = '3'";
				$rsFapenRegDeclarado = mysql_query($query_rsFapenRegDeclarado, $Emolumentos) or die(mysql_error());
				$row_rsFapenRegDeclarado = mysql_fetch_assoc($rsFapenRegDeclarado);
				$totalRows_rsFapenRegDeclarado = mysql_num_rows($rsFapenRegDeclarado);
				
				$vFarpen = $row_rsFapenRegDeclarado['valor'];
				$vFarpen = fc ("$vFarpen"); // valor do farpen de registro com valor declarado
				$vCauculo = $vCauculo / 2; // Valor do emolumento
				
				if ($_SESSION['tipoRegistro'] == "14") {
			
								if (isset($_GET['valorFiscal']) && $_GET['valorFiscal'] == "0") { $vCauculo = $faixaAvalor; }
					
				}
				if ($_SESSION['tipoRegistro'] == "5" || $_SESSION['tipoRegistro'] == "15" ) { // Desmenbramento || Remenbramento || remenejamento

					$NvFiscal = fc ("$vNovoFiscal");
					$NvFiscal = $NvFiscal / $unidadeHabitacional;
					
					if ($NvFiscal <= $faixaAate){
						$vCauculo2=$faixaAvalor;
					} else if ($NvFiscal <= $faixaBate){
						$vCauculo2=$faixaBvalor;
					} else if ($NvFiscal <=  $faixaCate){
						$vCauculo2=$faixaCvalor;
					} else if ($NvFiscal <= $faixaDate){
						$vCauculo2=$faixaDvalor;
					} else if ($NvFiscal > $acimaDe){
						$vCaucular = $NvFiscal;
						$vCauculado = $vCaucular - $acimaDe;
						$vDividido = $vCauculado / $pcada;
						$vMutiplicado = ($vDividido * $acrecentar) + $faixaDvalor;
						if ($vMutiplicado > $limite){
							$vCauculo2 = $limite;
						} else {
							$vCauculo2 = $vMutiplicado; // Valor do emolumento DESMENBRADO de acordo com a tabela progreciva
						}
					}
					
					$vCauculo = ($vCauculo2 / 2) * $unidadeHabitacional; // Valor do emolumento de Registro de Desmenbramento
					$vFarpen = $vFarpen * $unidadeHabitacional; // Farpen de DESMENBRMENTO
				}
				if ($_SESSION['tipoRegistro'] == "8") {    /// REGISTRO CEF
				
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$query_rsLimiteGregistro = "SELECT * FROM registro WHERE registro.id = '2'";
					$rsLimiteGregistro = mysql_query($query_rsLimiteGregistro, $Emolumentos) or die(mysql_error());
					$row_rsLimiteGregistro = mysql_fetch_assoc($rsLimiteGregistro);
					$totalRows_rsLimiteGregistro = mysql_num_rows($rsLimiteGregistro);
					
					$limite = fc ($row_rsLimiteGregistro['valor']);
			
					$vFiscal = fc ("$vNovoFiscal");
					$vHipoteca = fc ("$vHipoteca");
					$vHipoteca = $vHipoteca * (0.5/100); // opcional de percentual
					if (isset($_GET['primeiro']) && $_GET['primeiro'] == "1") { $vHipoteca = $vHipoteca / 2; }
					$vCauculo = $vCauculo + $vHipoteca;  //////  exite uma divuda????? 5% do valor da ipoteca ou é 5%
					$vFarpen = $vFarpen * 2;
					if ($vCauculo > $limite) {
						$vCauculo = $limite;
					}

				
				}
				if ($_SESSION['tipoRegistro'] == "10") {  // Registro Formal de Partilha

					mysql_select_db($database_Emolumentos, $Emolumentos);
					$query_rsLimiteGregistro = "SELECT * FROM registro WHERE registro.id = '2'";
					$rsLimiteGregistro = mysql_query($query_rsLimiteGregistro, $Emolumentos) or die(mysql_error());
					$row_rsLimiteGregistro = mysql_fetch_assoc($rsLimiteGregistro);
					$totalRows_rsLimiteGregistro = mysql_num_rows($rsLimiteGregistro);
			
					$limite = fc ($row_rsLimiteGregistro['valor']);
					
					$vFiscal = fc ("$vNovoFiscal");
					$NvFiscal = $vFiscal / $QtdHerdeiros;
					
					if ($NvFiscal <= $faixaAate){
						$vCauculo2=$faixaAvalor;
					} else if ($NvFiscal <= $faixaBate){
						$vCauculo2=$faixaBvalor;
					} else if ($NvFiscal <=  $faixaCate){
						$vCauculo2=$faixaCvalor;
					} else if ($NvFiscal <= $faixaDate){
						$vCauculo2=$faixaDvalor;
					} else if ($NvFiscal > $acimaDe){
						$vCaucular = $NvFiscal;
						$vCauculado = $vCaucular - $acimaDe;
						$vDividido = $vCauculado / $pcada;
						$vMutiplicado = ($vDividido * $acrecentar) + $faixaDvalor;
						if ($vMutiplicado > $limite){
							$vCauculo2 = $limite;
						} else {
							$vCauculo2 = $vMutiplicado; // Valor do emolumento DESMENBRADO de acordo com a tabela progreciva
						}
					}
					
					$vCauculo = ($vCauculo2 / 2)* $QtdHerdeiros;
					$vFarpen = $vFarpen * $QtdHerdeiros;	
					if ($vCauculo > $limite) {
						$vCauculo = $limite;
					}				
				}
			} else if ($_SESSION['tipoRegistro'] == "2" || $_SESSION['tipoRegistro'] == "3" || $_SESSION['tipoRegistro'] == "17") { // Averbação de Construção  || convenção || incorporacao
			
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsLimiteGregistro = "SELECT * FROM registro WHERE registro.id = '2'";
				$rsLimiteGregistro = mysql_query($query_rsLimiteGregistro, $Emolumentos) or die(mysql_error());
				$row_rsLimiteGregistro = mysql_fetch_assoc($rsLimiteGregistro);
				$totalRows_rsLimiteGregistro = mysql_num_rows($rsLimiteGregistro);
				
				$limite = fc ($row_rsLimiteGregistro['valor']);

	
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsFarpen = "SELECT * FROM farpen WHERE farpen.id = '6'"; // farpen AVERBAÇÃO COM VALOR
				$rsFarpen = mysql_query($query_rsFarpen, $Emolumentos) or die(mysql_error());
				$row_rsFarpen = mysql_fetch_assoc($rsFarpen);
				$totalRows_rsFarpen = mysql_num_rows($rsFarpen);
				
				$vFarpen = $row_rsFarpen['valor'];
				$vFarpen = fc ("$vFarpen");
				$ValorM3 = fc ("$ValorM3");
				$vCauculo = ($ValorM3 * $areaConstruida) * (0.5 / 100); // resutado do calculo
				if ($vCauculo > $limite) {
					$vCauculo = $limite;
				}
							
			} // fim Averbação de Construção  || convenção || incorporacao
			else if ($_SESSION['tipoRegistro'] == "4" || $_SESSION['tipoRegistro'] == "6" || $_SESSION['tipoRegistro'] == "16" ) { // Baixa Hipoteca || Locacao
			
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsLimiteGregistro = "SELECT * FROM registro WHERE registro.id = '2'";
				$rsLimiteGregistro = mysql_query($query_rsLimiteGregistro, $Emolumentos) or die(mysql_error());
				$row_rsLimiteGregistro = mysql_fetch_assoc($rsLimiteGregistro);
				$totalRows_rsLimiteGregistro = mysql_num_rows($rsLimiteGregistro);
				
				$limite = fc ($row_rsLimiteGregistro['valor']);


				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsFarpen = "SELECT * FROM farpen WHERE farpen.id = '6'"; // farpen AVERBACAO COM VALOR
				$rsFarpen = mysql_query($query_rsFarpen, $Emolumentos) or die(mysql_error());
				$row_rsFarpen = mysql_fetch_assoc($rsFarpen);
				$totalRows_rsFarpen = mysql_num_rows($rsFarpen);
				
				$vFarpen = $row_rsFarpen['valor'];
				$vFarpen = fc ("$vFarpen");
		
				$vFiscal = fc ("$vNovoFiscal");
				$vCauculo = $vFiscal * (0.5/100); // opcional de percentual
				if ($vCauculo > $limite) {
					$vCauculo = $limite;
				}

			} 
			else if ($_SESSION['tipoRegistro'] == "7") { // Loteamento
			
				
				

				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsFarpen = "SELECT * FROM farpen WHERE farpen.id = '2'"; // farpen REGISTRO SEM VALOR
				$rsFarpen = mysql_query($query_rsFarpen, $Emolumentos) or die(mysql_error());
				$row_rsFarpen = mysql_fetch_assoc($rsFarpen);
				$totalRows_rsFarpen = mysql_num_rows($rsFarpen);
				
				$vFarpen = $row_rsFarpen['valor'];
				$vFarpen = fc ("$vFarpen");
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsValorLote = "SELECT * FROM registro WHERE registro.id = '6'";
				$rsValorLote = mysql_query($query_rsValorLote, $Emolumentos) or die(mysql_error());
				$row_rsValorLote = mysql_fetch_assoc($rsValorLote);
				$totalRows_rsValorLote = mysql_num_rows($rsValorLote);
				$ValorLote = fc ($row_rsValorLote['valor']); // Valor do lote atual
				
				if (isset($_GET['intimacao']) && $_GET['intimacao'] == "ok") {
				$ValorLote = $ValorLote + 12.16;
				}
				
				$vCauculo = ($faixaAvalor / 2) + ($ValorLote * $unidadeHabitacional);
				
				
				
				$limite = $faixaAvalor + (1000 * $ValorLote);
				
				
				
				if ($vCauculo > $limite) {
					$vCauculo = $limite;
				}

				
			} else if ($_SESSION['tipoRegistro'] == "9" || $_SESSION['tipoRegistro'] == "19") {  // Averbacao diversas
			
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsLimiteGregistro = "SELECT * FROM registro WHERE registro.id = '2'";
				$rsLimiteGregistro = mysql_query($query_rsLimiteGregistro, $Emolumentos) or die(mysql_error());
				$row_rsLimiteGregistro = mysql_fetch_assoc($rsLimiteGregistro);
				$totalRows_rsLimiteGregistro = mysql_num_rows($rsLimiteGregistro);
				
				$limite = fc ($row_rsLimiteGregistro['valor']);
			
			
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsFarpen = "SELECT * FROM farpen WHERE farpen.id = '6'"; // farpen AVERBAÇÃO COM VALOR
				$rsFarpen = mysql_query($query_rsFarpen, $Emolumentos) or die(mysql_error());
				$row_rsFarpen = mysql_fetch_assoc($rsFarpen);
				$totalRows_rsFarpen = mysql_num_rows($rsFarpen);
				
				$vFarpen = $row_rsFarpen['valor'];
				$vFarpen = fc ("$vFarpen");
				
				$vCauculo = $vFiscal * (0.5 / 100);
			
				if ($vCauculo > $limite) {
					$vCauculo = $limite;
				}
			} else if ($_SESSION['tipoRegistro'] == "18") {
			
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsFarpen = "SELECT * FROM farpen WHERE farpen.id = '2'"; // farpen REGISTRO SEM VALOR
				$rsFarpen = mysql_query($query_rsFarpen, $Emolumentos) or die(mysql_error());
				$row_rsFarpen = mysql_fetch_assoc($rsFarpen);
				$totalRows_rsFarpen = mysql_num_rows($rsFarpen);
				$vFarpen = $row_rsFarpen['valor'];
				$vFarpen = fc ("$vFarpen");

				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsSM = "SELECT * FROM registro WHERE registro.id = '7'";
				$rsSM = mysql_query($query_rsSM, $Emolumentos) or die(mysql_error());
				$row_rsSM = mysql_fetch_assoc($rsSM);
				$totalRows_rsSM = mysql_num_rows($rsSM);
				
				$vCauculo = (fc ($row_rsSM['valor'])) * (1/4);

				
			} else if ($_SESSION['tipoRegistro'] == "20") {
			
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsFarpen = "SELECT * FROM farpen WHERE farpen.id = '2'"; // farpen REGISTRO SEM VALOR
				$rsFarpen = mysql_query($query_rsFarpen, $Emolumentos) or die(mysql_error());
				$row_rsFarpen = mysql_fetch_assoc($rsFarpen);
				$totalRows_rsFarpen = mysql_num_rows($rsFarpen);
				$vFarpen = $row_rsFarpen['valor'];
				$vFarpen = fc ("$vFarpen");

				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsSM = "SELECT * FROM registro WHERE registro.id = '4'";
				$rsSM = mysql_query($query_rsSM, $Emolumentos) or die(mysql_error());
				$row_rsSM = mysql_fetch_assoc($rsSM);
				$totalRows_rsSM = mysql_num_rows($rsSM);
				
				$vCauculo = fc ($row_rsSM['valor']);

				
			} else if ($_SESSION['tipoRegistro'] == "21") { // Baixa Hipoteca || Locacao
			
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsLimiteGregistro = "SELECT * FROM registro WHERE registro.id = '5'";
				$rsLimiteGregistro = mysql_query($query_rsLimiteGregistro, $Emolumentos) or die(mysql_error());
				$row_rsLimiteGregistro = mysql_fetch_assoc($rsLimiteGregistro);
				$totalRows_rsLimiteGregistro = mysql_num_rows($rsLimiteGregistro);
				
				$limite = fc ($row_rsLimiteGregistro['valor']);


				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsFarpen = "SELECT * FROM farpen WHERE farpen.id = '6'"; // farpen AVERBACAO COM VALOR
				$rsFarpen = mysql_query($query_rsFarpen, $Emolumentos) or die(mysql_error());
				$row_rsFarpen = mysql_fetch_assoc($rsFarpen);
				$totalRows_rsFarpen = mysql_num_rows($rsFarpen);
				
				$vFarpen = $row_rsFarpen['valor'];
				$vFarpen = fc ("$vFarpen");
		
				$vFiscal = fc ("$vNovoFiscal");
				$vCauculo = $vFiscal * (0.2/100); // opcional de percentual
				if ($vCauculo > $limite) {
					$vCauculo = $limite;
				}
			} 
		} // FIM DO REGISTRO
	
		$vTj = $vCauculo * (3/100); // valor do FEPJ
		$vCauculo = number_format($vCauculo, 2, ",", "."); // formata a valor emolumento para db
		$vFarpen = number_format($vFarpen, 2, ",", "."); // formata valor do farpen para db
		$vTj = number_format($vTj, 2, ",", "."); // formata calor do tj pra o db
		$ValorM3 = number_format($ValorM3, 2, ",", ".");
		
		if ($_SESSION['addGuia'] != "ok" && (!isset($orsamento) || $orsamento != "ok")) { // 27 - 31
		$numero = $row_rsNumero['numero'] + 1;
				 $insertSQL = sprintf("INSERT INTO guias (id_entidade, ano, numero, emicao, vencimento, id_natuEsc, valorEmolumento, valorFarpen, valorFEPJ, valorSDT, declarado, TipoImovel, caracteristicas, id_usuario, situacaoEmolumento, dataMovEmolumento, situacaoFarpen, dataMovFarpen, situacaoSDJ, dataMovSDJ, tipo, vfiscal, ValorM3, areaConstruida, unidadeHabitacional, QtdHerdeiros, AV, TipoRegistro, idReg) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
									   GetSQLValueString($row_rsEntidadeLogin['id'], "int"),
									   GetSQLValueString($ano, "text"),
									   GetSQLValueString($numero, "int"),
									   GetSQLValueString($emicao, "date"),
									   GetSQLValueString($vencimento, "date"),
									   GetSQLValueString($id_NatuEsc, "text"),
									   GetSQLValueString($vCauculo, "text"),
									   GetSQLValueString($vFarpen, "text"),
									   GetSQLValueString($vTj, "text"),
									   GetSQLValueString($vDist, "text"),
									   GetSQLValueString($declarado, "text"),					   
									   GetSQLValueString($id_TipoImovel, "text"),
									   GetSQLValueString($caracteristicas, "text"),
									   GetSQLValueString($id_usuario, "int"),
									   GetSQLValueString('1', "int"),
									   GetSQLValueString($emicao, "date"),
									   GetSQLValueString('1', "int"),
									   GetSQLValueString($emicao, "date"),
									   GetSQLValueString('1', "int"),
									   GetSQLValueString($emicao, "date"),
									   GetSQLValueString($tipo, "text"),
									   GetSQLValueString($vNovoFiscal, "text"),
									   GetSQLValueString($ValorM3, "text"),
									   GetSQLValueString($areaConstruida, "int"),
									   GetSQLValueString($unidadeHabitacional, "int"),
									   GetSQLValueString($QtdHerdeiros, "int"),
									   GetSQLValueString($AV, "int"),
									   GetSQLValueString($_SESSION['tipoRegistro'], "int"),
									   GetSQLValueString($idReg, "int"));
									   
		  mysql_select_db($database_Emolumentos, $Emolumentos);
		  $Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
		  
		}
		
		$id_entidade = $row_rsEntidadeLogin['id'];
		
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rsGuia = "SELECT guias.id FROM guias WHERE guias.id_entidade = '$id_entidade' AND guias.numero = '$numero' AND guias.ano = '$ano'";
		$rsGuia = mysql_query($query_rsGuia, $Emolumentos) or die(mysql_error());
		$row_rsGuia = mysql_fetch_assoc($rsGuia);
		$totalRows_rsGuia = mysql_num_rows($rsGuia);
		
		$_SESSION['id_guia'] = $row_rsGuia['id'];
	
		
	} else { // fim do valor declarado inicio do valor nao declarado
		if ($tipo == "Escritura"){	

			$idVfiscal = $_GET['valor'];
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsVfiscal = "SELECT ndeclarado.descricao, ndeclarado.valor FROM ndeclarado WHERE ndeclarado.id = '$idVfiscal'";
			$rsVfiscal = mysql_query($query_rsVfiscal, $Emolumentos) or die(mysql_error());
			$row_rsVfiscal = mysql_fetch_assoc($rsVfiscal);
			$totalRows_rsVfiscal = mysql_num_rows($rsVfiscal);			
	
			$vFiscal = $row_rsVfiscal['valor'];
			$nDescricao = $row_rsVfiscal['descricao'];
			$id_EntidadeLogin = $row_rsEntidadeLogin['id'];
	
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsNumero = "SELECT guias.numero FROM guias WHERE guias.id_entidade = '$id_EntidadeLogin' ORDER BY guias.numero DESC";
			$rsNumero = mysql_query($query_rsNumero, $Emolumentos) or die(mysql_error());
			$row_rsNumero = mysql_fetch_assoc($rsNumero);
			$totalRows_rsNumero = mysql_num_rows($rsNumero);
			$numero = $row_rsNumero['numero'] + 1;
	
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsFapenDistribuidor = "SELECT * FROM farpen WHERE farpen.id = '5'";
			$rsFapenDistribuidor = mysql_query($query_rsFapenDistribuidor, $Emolumentos) or die(mysql_error());
			$row_rsFapenDistribuidor = mysql_fetch_assoc($rsFapenDistribuidor);
			$totalRows_rsFapenDistribuidor = mysql_num_rows($rsFapenDistribuidor);
			
			$farpenD = $row_rsFapenDistribuidor['valor'];
			$farpenD = fc ("$farpenD");
			
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsDistribuidor = "SELECT * FROM distribuicao";
			$rsDistribuidor = mysql_query($query_rsDistribuidor, $Emolumentos) or die(mysql_error());
			$row_rsDistribuidor = mysql_fetch_assoc($rsDistribuidor);
			$totalRows_rsDistribuidor = mysql_num_rows($rsDistribuidor);
		
			$distribuidor = $row_rsDistribuidor['valor'];
			$distribuidor = fc ("$distribuidor");
			
			$vDist = $distribuidor + $farpenD; // Valor da guia de distribuição
			$vDist = number_format($vDist, 2, ",", "."); // formata a guia de distribuição para o db
	
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsFapenEscNdeclarado = "SELECT * FROM farpen WHERE farpen.id = '2'";
			$rsFapenEscNdeclarado = mysql_query($query_rsFapenEscNdeclarado, $Emolumentos) or die(mysql_error());
			$row_rsFapenEscNdeclarado = mysql_fetch_assoc($rsFapenEscNdeclarado);
			$totalRows_rsFapenEscNdeclarado = mysql_num_rows($rsFapenEscNdeclarado);
	
			$vFarpen = $row_rsFapenEscNdeclarado['valor'];
			$vFiscal = fc ("$vFiscal");
	
			$vTj = $vFiscal * (3/100);
						
			$vCauculo = $vFiscal;
			$vCauculo = number_format($vCauculo, 2, ",", ".");
			$vTj = number_format($vTj, 2, ",", ".");
	
			if ($_SESSION['addGuia'] != "ok") {
				$numero = $row_rsNumero['numero'] + 1;
				
				$insertSQL = sprintf("INSERT INTO guias (id_entidade, ano, numero, emicao, vencimento, valorEmolumento, valorFarpen, valorFEPJ, valorSDT, declarado, id_usuario, situacaoEmolumento, dataMovEmolumento, situacaoFarpen, dataMovFarpen, situacaoSDJ, dataMovSDJ, tipo, ndescricao) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
									   GetSQLValueString($row_rsEntidadeLogin['id'], "int"),
									   GetSQLValueString($ano, "text"),
									   GetSQLValueString($numero, "int"),
									   GetSQLValueString($emicao, "date"),
									   GetSQLValueString($vencimento, "date"),
									   GetSQLValueString($vCauculo, "text"),
									   GetSQLValueString($vFarpen, "text"),
									   GetSQLValueString($vTj, "text"),
									   GetSQLValueString($vDist, "text"),
									   GetSQLValueString($declarado, "text"),					   
									   GetSQLValueString($id_usuario, "int"),
									   GetSQLValueString('1', "int"),
									   GetSQLValueString($emicao, "date"),
									   GetSQLValueString('1', "int"),
									   GetSQLValueString($emicao, "date"),
									   GetSQLValueString('1', "int"),
									   GetSQLValueString($emicao, "date"),
									   GetSQLValueString($tipo, "text"),
									   GetSQLValueString($nDescricao, "text"));
									   
				  mysql_select_db($database_Emolumentos, $Emolumentos);
				  $Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
			}
				
			
			$id_entidade = $row_rsEntidadeLogin['id'];
				
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsGuia = "SELECT guias.id FROM guias WHERE guias.id_entidade = '$id_entidade' AND guias.numero = '$numero' AND guias.ano = '$ano'";
			$rsGuia = mysql_query($query_rsGuia, $Emolumentos) or die(mysql_error());
			$row_rsGuia = mysql_fetch_assoc($rsGuia);
			$totalRows_rsGuia = mysql_num_rows($rsGuia);
			
			$_SESSION['id_guia'] = $row_rsGuia['id'];
		} // fim da escritura sem valor declarado
	}

	if ($_SESSION['addGuia'] != "ok") {
		for ($i = 1; $i <= $_SESSION['nOUTORGANTE']; $i++) { // cadastro de outorgante e outorgados
					$id = $_SESSION['outorgante']["$i"]; 
					$insertSQL = sprintf("INSERT INTO partesguias (id_guia, id_parte, tipo) VALUES (%s, %s, %s)",
									   GetSQLValueString($row_rsGuia['id'], "int"),
									   GetSQLValueString($id, "int"),
									   GetSQLValueString("0", "int"));
				
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
		}
		if (isset($_SESSION['outorgado']['1'])) {
		for ($i = 1; $i <= $_SESSION['nOUTORGADO']; $i++) {
					$id = $_SESSION['outorgado']["$i"]; 
					$insertSQL = sprintf("INSERT INTO partesguias (id_guia, id_parte, tipo) VALUES (%s, %s, %s)",
									   GetSQLValueString($row_rsGuia['id'], "int"),
									   GetSQLValueString($id, "int"),
									   GetSQLValueString("1", "int"));
					  mysql_select_db($database_Emolumentos, $Emolumentos);
					  $Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
		} //fim do cadastro
		}
		$_SESSION['addGuia'] = "ok";
	}
	
	$vencimento = $diaV."/".$mesV."/".$anoV;
	$emicao = $dia."/".$mes."/".$ano;

}

?>