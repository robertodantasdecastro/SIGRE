<?

$caminho = "../../dados/";
$dir = opendir($caminho); 
while ($i = readdir($dir)) {
if(!preg_match('/^\./',$i) && ((strstr($i,'.txt') || strstr($i,'.TXT')) || (strstr($i,'.ret') || strstr($i,'.RET')))) {
echo "<iframe align=\"top\" class=\"Formulario\" height=\"250\" width=\"738\" src=\"arquivoRetorno.php?arquivo=".$i."\" scrolling=\"Yes\"></iframe>";

}
}
closedir($dir); 

?>
