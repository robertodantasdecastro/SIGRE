<? 
					if (isset($_GET['CPF']) || isset($_POST['CPF'])) { 
						if (isset($_GET['CPF'])) { $resCPF = CPF($_GET['CPF']);  }
						if (isset($_POST['CPF'])) { $resCPF = CPF($_POST['CPF']); }
						if ($resCPF == "N") { 
							$erro = "Informe um CPF válido.";
						}
					}
					
					
					if (isset($_GET['CNPJ']) || isset($_POST['CNPJ'])) { 
					
					
					if (isset($_POST['CNPJ'])) { $cnpj = $_POST['CNPJ']; }
					if (isset($_GET['CNPJ'])) { $cnpj = $_GET['CNPJ'];  }	
					  
					$cnpj = ereg_replace("0","0",$cnpj); 
					$cnpj = ereg_replace("/","",$cnpj); 
					$cnpj = ereg_replace("-","",$cnpj); 
					$cnpj = ereg_replace("\.","",$cnpj); 
					$oCnpj = new cnpj;
					if ($oCnpj->verfica_cnpj($cnpj)==1){
					
					}
					else{
					$erro = "Informe um CNPJ válido.";
					}
									

					}
					
					if (isset($erro)) {
					?>
					<script language="javascript" type="text/javascript" ?>
					window.alert('<? echo $erro; ?>');
					window.history.back();
					</script>
					<? } ?>