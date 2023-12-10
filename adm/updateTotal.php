<?
if (!isset($_SESSION['texto'])) { $_SESSION['texto'] = ""; }
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso != 1) {
	if ($acesso != 1) { $_SESSIeON['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
}else {
if (!isset($n)) $n = 0;


$caminho = "../../dados/";
$dir = opendir($caminho); 
if (!isset($_SESSION["$n"])) {

	while ($i = readdir($dir)) {
		if(!preg_match('/^\./',$i) && (strstr($i,'.ret') || strstr($i,'.RET')) && (substr($i, 0, 8) >= $_GET['di'] && substr($i, 0, 8) <= $_GET['df']) ) {
			
			$n = $n + 1;	
			//echo "n = ".$n." arquivo = ".$i."<BR>";
			$nomeArquivo["$n"] = $i;
			$_SESSION["$n"] = $i;
		}
	}
}
//echo $n;
	closedir($dir); 
	$_SESSION['end'] = $n;
	if (!isset($_SESSION['t'])) { $_SESSION['t'] = 1; } 
	$ult = $_SESSION['t'];
//	echo $_SESSION['t'];
	if ($ult > 0 && $ult <= $_SESSION['end']) {
		$nomeArq = $_SESSION["$ult"];
		echo $nomeArq."<BR>".$ult." de ".$_SESSION['end'];
		//exit;

		?>
		<script type="text/JavaScript">
		window.open('arquivoRetorno.php?arquivo=<? echo $nomeArq."&cont=".$ult; ?>','popupdate','scrollbars=no,width=650,height=230');
		</script>
		
		
		<? 

		if (isset($_SESSION['texto'])) { 
			?>
			<script language="javascript" type="text/javascript" >
			window.top.document.all.textos.text = "<? echo $_SESSION['texto']; ?>";
			window.top.document.all.rAtual.value = "<? echo $_SESSION['texto']; ?>";
			</script>
			<?
		}

	} else { 
		echo "Processo finalizado!!";
	}
}
if (isset($_SESSION['rel']) && $_SESSION['rel'] != "" ) echo "<br>".$_SESSION['rel'];
if (isset($_SESSION['erro_retorno']) && $_SESSION['erro_retorno'] != "" ) {
?>

          
               <br /> <textarea name="erro" cols="60" rows="10" id="erro"><? echo $_SESSION['erro_retorno']; ?>
</textarea>
          
<?
}
 ?>