<?
if (isset($_POST['convenio']) && isset($_POST['convenio2'])) {
	$conv1 = $_POST['convenio'];
	$conv2 = $_POST['convenio2'];	
	if ($conv1 != $conv2) {
		
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rsConv1 = "SELECT '1' `ID_LINHA`, entidades.convenio, entidades.convenio2
						  FROM entidades 
						  WHERE entidades.convenio = '$conv1' OR entidades.convenio2 = '$conv1'
						  UNION
						  SELECT '2', entidades.convenio, entidades.convenio2
						  FROM entidades 
						  WHERE entidades.convenio = '$conv2' OR entidades.convenio2 = '$conv2'
						  ";
		$rsConv1 = mysql_query($query_rsConv1, $Emolumentos) or die(mysql_error());
		$row_rsConv1 = mysql_fetch_assoc($rsConv1);
		$totalRows_rsConv1 = mysql_num_rows($rsConv1);
		
		mysql_free_result($rsConv1);
		
		if ($totalRows_rsConv1 >= 1) { 
		
			if ($row_rsConv1['ID_LINHA'] == 1) { 
				$CONV1 = "erro";
				$erro = "O Convenio N. ".$conv1." j� estar cadastrado nos nossos registros."; 
			} else if ($row_rsConv1['ID_LINHA'] == 2) { 
				$CONV2 = "erro";
				$erro = "O Convenio N. ".$conv2." j� estar cadastrado nos nossos registros."; 
			}
		} else { $valida2 = "ok"; }
	
	} else {
	
		$erro = "Os conv�nios devem ser diferentes.";
		
	}
} 



include ("../funcoes/validaCPF_CNPJ.php");

if (isset($_POST['CNPJ']) && $_POST['CNPJ'] != "") { 

					$cnpj = $_POST['CNPJ'];
					$cnpj = ereg_replace("0","0",$cnpj); 
					$cnpj = ereg_replace("/","",$cnpj); 
					$cnpj = ereg_replace("-","",$cnpj); 
					$cnpj = ereg_replace("\.","",$cnpj); 
					$oCnpj = new cnpj;
					if ($oCnpj->verfica_cnpj($cnpj)==1){
					$valida = "ok";
					}
					else{
					$erro = "Informe um CNPJ v�lido.";
					}
					
}

if (isset($_POST['CPF']) && $_POST['CPF'] != "") { 

	if (isset($_POST['CPF'])) { $resCPF = CPF($_POST['CPF']); }
	if ($resCPF == "N") { 
		$erro = "Informe um CPF v�lido.";
	} else if ($resCPF == "S") {
		$valida = "ok";
	}
}
if ($_POST['CPF'] == "" && $_POST['CNPJ'] == ""){
	$erro = "Informe um CPF ou um CNPJ v�lido";
}












if ( (isset($_POST['Conta']) && isset($_POST['dvCC'])) && (isset($_POST['agencia']) && isset($_POST['dvAG'])) ) {
	$conta = $_POST['Conta'];
	$dvCC = $_POST['dvCC'];	
	$agencia = $_POST['agencia'];	
	$dvAG = $_POST['dvAG'];	
	
	$CC = $conta.$dvCC;
	$AG = $agencia.$dvAG;
	
	if ($CC != $AG) {
		
		mysql_select_db($database_Emolumentos, $Emolumentos);
		$query_rsContaAgencia = "SELECT '1' `ID_LINHA`, entidades.id
						  FROM entidades 
						  WHERE entidades.conta = '$conta' AND entidades.agencia = '$agencia'
						  ";
		$rsContaAgencia = mysql_query($query_rsContaAgencia, $Emolumentos) or die(mysql_error());
		$row_rsContaAgencia = mysql_fetch_assoc($rsContaAgencia);
		$totalRows_rsContaAgencia = mysql_num_rows($rsContaAgencia);
		
		mysql_free_result($rsContaAgencia);
		
		if ($totalRows_rsContaAgencia >= 1) { 
			$CONTA = "erro";
			$erro = "Entidade ".$row_rsContaAgencia['ID']." j� cadastrada com mesmos n�meros de ag�ncia e conta."; 
		} else { $valida3 = "ok"; }
	
	} else {
	
		$erro = "A Conta Corrente e a Ag�ncia devem ser diferentes.";
		
	}
} 
?>