<?
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
	//if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
}else {
if (!isset($_GET['onde'])) { 

	$arquivo = "../../distribuidor/".$_GET['arquivo'];
	$nome=$_GET['arquivo'];
	
	header('Content-type: application/txt');
	

	header("Content-Disposition: attachment; filename=$nome");
	

	readfile($arquivo);

} else {
	
	$caminho = "../../dados/".$_GET['onde'];
	$arquivo = "../../dados/".$_GET['onde']."/".$_GET['arquivo'];
	$nome=$_GET['arquivo'];
	$dire = opendir($caminho); 
	while ($i = readdir($dire)) { 
//		echo $i;
		if ($i == $nome) {
	
			header('Content-type: application/txt');
			if ($acesso == 4 || $acesso == 5) {			
				$nomeArq = substr($nome, 3, 8).".txt";
			} else {
				$nomeArq = $nome;
			}
			header("Content-Disposition: attachment; filename=$nomeArq");
			

			readfile($arquivo);
			unlink ($arquivo);
		}
	}
	
}
if (isset($_SESSION['nomeArqDownload'])) { unset ($_SESSION['nomeArqDownload']); }
}
?>