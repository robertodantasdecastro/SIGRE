<? 
class cnpj{
var $expressao_regular_de_cnpj="[0-9]{2,3}\\.?[0-9]{3}\\.?[0-9]{3}/?[0-9]{4}-?[0-9]{2}";

/**
 * cnpj::clim()
 * Tiras espaços e tabulações
 * @param $cnpj
 * @return 
 */
function clim($cnpj){
$cnpj=ereg_replace("[ ]*[	]*","",$cnpj);
return $cnpj;
}

/**
 * cnpj::isNUMB()
 * Verifica se a pessoa digitou somente número e verifica se tem 14 digitos
 * @param $cnpj
 * @return 
 */
function isNUMB($cnpj){
	//1 - somente número e tem 14 digitos
	//0 - não e só número ou não tem 14 digitos
	
	$digitos=ereg_replace("[-. \t]","",$cnpj);
	if(!ereg("^".$this->expressao_regular_de_cnpj."\$",$digitos)){
		return 0;
		}
	return 1;
 }

/**
 * cnpj::teste_cnpj()
 * Função que verifica se o CNPJ é valido ou não
 * @param $cnpj
 * @param $x
 * @return 
 */
function teste_cnpj($cnpj,$x){
	//1 - cnpj válido
	//0 - cnpj inválido
	$VerCNPJ=0;
	$ind=2;
	$tam;
	for ($y=$x;$y>0;$y--){
	$VerCNPJ+=(int)substr($cnpj,$y-1,1)*$ind;
	if ($ind>8){
	 $ind=2;
	 }
	else{
	 $ind++;
	 }
	}
	$VerCNPJ%=11;
	if(($VerCNPJ==0) || ($VerCNPJ==1))
	 {
		$VerCNPJ=0;
	 }
	else
	 {
		$VerCNPJ=11-$VerCNPJ;
	 }
	 if($VerCNPJ!=(int)substr($cnpj,$x,1))
	 {
		return 0;
	 }
	else
	 {
		return 1;
	 }
}

/**
 * cnpj::verfica_cnpj()
 * Função chamadora para validação do CNPJ
 * @param $cnpj
 * @return 
 */
function verfica_cnpj($cnpj){
   //1 - cnpj válido
   //0 - cnpj inválido
   $cnpj=$this->clim($cnpj);
   if($this->isNUMB($cnpj) != 1)
	{
	return 0;
	}
	else {
	$x=strlen($cnpj)-2;
	if($this->teste_cnpj($cnpj,$x) == 1)
	 {
		$x=strlen($cnpj)-1;
		if($this->teste_cnpj($cnpj,$x) == 1)
		 {	
			return 1;
		 }
		 else
		  {
			return 0;
		  }
	 }
	else
	 {
	 	return 0;
	 }
 }
}
}






function CPF($cpf){ 
    $cpf=ereg_replace("[^0-9]","",$cpf); 
    $c=substr($cpf, 0,9); 
    $v=substr($cpf, 9,2); 
    $d=0; 
    $val=true; 
    for ($i=0;$i<9;$i++){ 
        $d+=$c[$i]*(10-$i); 
    } 
    $d==0 ? $val=false:null; 
    $d= (11-($d%11))>9 ? 0:11-($d%11); 
    $v[0]!=$d ? $val=false:null;  
    $d *=2; 
    for ($i=0;$i<9;$i++){ 
        $d+=$c[$i]*(11-$i); 
    } 
    $d= (11-($d%11))>9 ? 0:11-($d%11); 
    $v[1]!=$d ? $val=false:null; 
    ereg("0{11}|1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11}",$cpf) ? $val=false : null;  
    return $val ? "S" : "N"; 
	if (strlen($cpf) <> 10) { return "N"; }
} 
/*
$resCPF = CPF($_GET['CPF']); 
if ($resCPF == "N") { 

}
*/
?>