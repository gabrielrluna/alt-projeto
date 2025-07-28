<?php 
//FUNCOES
function reduzCaractere( $quantidade, $texto ){	
	return substr($texto, 0, $quantidade);
}

function trocaVirgula( $valor ){
	$valor = str_replace(",",".",$valor);
	$valor = trim($valor);
	return $valor;
}
function troca_caracteres( $l){
	$tt = array("á","à","ã","â","é","ê","í","ó","ô","õ","ú","ü","ç","Á","À","Ã","Â","É","Ê","Í","Ó","Ô","Õ","Ú","Ü","Ç"," ","?",";",",","(",")",":","!","@","#","$","%","&","¨*","-","´","`","~","^","[","]","{","}","/","<",">",".","-","+","°");
	$ss = array("a","a","a","a","e","e","i","o","o","o","u","u","c","A","A","A","A","E","E","I","O","O","O","U","U","C","_");
	$g = str_replace($tt, $ss, trim( $l));
	return $g;
}
function limpaCaracteres( $l){
	$l = preg_replace("/\-\-/", "", $l);
	$l = preg_replace("/[\r\n]/", "", $l);
	$l = preg_replace("/\#/", "", $l);
	$tt = array(";",",","(",")",":","!","%","&","¨*","´","`","~","^","[","]","{","}","/","<",">",'"',"|","'");
	$ss = array(" ");
	$g = str_replace($tt, $ss, trim( $l));
	return $g;
}
function tempoSeg($segundos){
	
	if( $segundos < 60 ){ //segundos

			$result = $segundos."seg";
	   
	}elseif( $segundos >= 60 && $segundos < 3600 ){  //minutos
	
		$minutos = $segundos/60;
		$minutos = floor($minutos);
		
		$seg = $segundos % 60;
	
		if( $seg != 0 ){
		$result = $minutos."min".$seg."seg";
		}else{
			$result = $minutos."min";
		}
	}elseif( $segundos >= 3600 && $segundos < 86400 ){ //horas
	
		if( $segundos == 3600 ){
			$result = $segundos."hr";
		}else{
			
			$minutos = $segundos/60;
			
			$horas = $minutos / 60;
			$horas = floor($horas);
			
			$mins = $minutos % 60;

				if( $mins == 0 ){
					$result = $horas."hr";
				}else{
					$result = $horas."hr".$mins."min";
				}			
		}
			
	}else{//dias
	
		$minutos = $segundos/60;
	
		$dias = $minutos / 1440;
		
		if( $dias == 1 ){
			$result = $dias." dia";
		}else{
			
			$dia_int = floor($dias);
			if($dia_int==1){
				$texto_dia = " dia ";
			}else{
				$texto_dia = " dias ";
			}
			$dia_int = $dia_int * 1440;
			$dia_int = $dia_int * 60;
			$intervalo = $segundos - $dia_int;
			$result = floor($dias).$texto_dia." ".tempoSeg($intervalo);
					
		}
		
	}	
	return $result;	
}
//funcao que cria 4 digitos aleatorios
function fId($fid) {
  $fid 		= trim($fid);	
  $fidUsu 	= base64_encode($fid);
  
  $b = "";
  
  for ($a=1;$a<=2;$a++) {
	$b .=chr(rand(97, 122));
	$b .=chr(rand(65, 90));
  }
  $fidUsu = $b.$fidUsu;
  return $fidUsu;	
}
function lCod($cod){
	$cod 	= substr($cod,4,1000000);
	$cod 	= base64_decode($cod);
	return 	$cod;
}
function antiInjection( $s){
	$s = str_replace("'","",$s);
	$s = str_replace('"',"",$s);
	$s = addslashes($s); /* Isto já elimina [' " /] */
	$s = preg_replace("/\-\-/", "", $s);
	$s = preg_replace("/[\r\n]/", " ", $s);
	$s = preg_replace("/\#/", "", $s);
	return trim($s);
}
function toString($txt){
	$txt = antiInjection($txt);
	$txt = "'".$txt."'";
	return $txt;
}
function fSol($valor){
	$valor = trim($valor);
	$valor = str_pad($valor, 13, '0', STR_PAD_LEFT);
	return $valor;	
}

function buscaEndereco($lat, $lon){
	
	$host 	= "geocoder.geoportal.com.br";
	$porta 	= 50001;
	$socket = fsockopen($host, $porta, $errno, $errstr, 1) or die('Could not connect to: '.$host);
	
	$valida 	= "TICKET D5A95D0E-9EF9-4E97-BA70-FEE256C42C06";
	
	if($lat == "" || $lon == "" ){
		return false;		
	}else{
		$requisicao = "RevGeocode ".$lon." ".$lat."";
	}
	
	$fim 		= "QUIT";

	//verifica se conexao foi aberta
	if(!$socket){
		return false;
	}else{
		//envia validadacao
		fputs($socket,$valida);
		//le retorno
		$resultado = fread($socket,4);
		//se for OK logica continua 
		if(trim($resultado)=="OK"){
			//envia instrucao de comando geocoder
						
			fputs($socket,$requisicao);
				
			$resultado3 = fread($socket, 268);
									
			$info['endereco'] = trim(substr($resultado3,10,80)).", ".trim(substr($resultado3,91,6)). " - ".trim(substr($resultado3,98,6)). " ".trim(substr($resultado3,114,40)).", ".trim(substr($resultado3,155,50))." - ".trim(substr($resultado3,206,40));
			
			$info['bairro'] = trim(substr($resultado3,114,40));
			$info['cidade'] = trim(substr($resultado3,155,50));
			$info['estado'] = trim(substr($resultado3,206,40));
			$info['pais'] = trim(substr($resultado3,247,20));
			$info['cep'] = trim(substr($resultado3,105,8));
			$info['logradouro'] = trim(substr($resultado3,10,80));
		
		fputs($socket, $fim);
		fclose($socket);
		
		return $info;	
		}
	
	}	
}
function buscaEnderecoGeoCoder($fPesquisa){
	$host 	= "geocoder.geoportal.com.br";
	$porta 	= 50001;
	$socket = fsockopen($host, $porta, $errno, $errstr, 1) or die('Could not connect to: '.$host);
	
	$valida 	= "TICKET D5A95D0E-9EF9-4E97-BA70-FEE256C42C06";
	
	if($fPesquisa == ""){
		return false;		
	}else{
		$requisicao = 'BUSCAENDERECO -Endereco:"'.$fPesquisa.'" -Qtde:10';
	}
	
	$fim 		= "QUIT";

	//verifica se conexao foi aberta
	if(!$socket){
		return false;
	}else{
		//envia validadacao
		fputs($socket,$valida);
		//le retorno
		$resultado = fread($socket,4);
		//se for OK logica continua 
		if(trim($resultado)=="OK"){
			//envia instrucao de comando geocoder
			fputs($socket,$requisicao);
	
				
			$resultado2 = fread($socket, 6);
			
			
			$contagem 	= ( $resultado2 / 304.2 );
			
			$contagem 	= ceil($contagem);
			
			$ii = 0;
			for($i = 1; $i <= $contagem; $i++ ){
				$dados 	= fread($socket, 304);
				
				$arrayDados[$ii]['rua'] 			= antiInjection(trim(substr($dados,33,80)));
				$arrayDados[$ii]['cep'] 			= antiInjection(trim(substr($dados,132,8)));
				$arrayDados[$ii]['bairro'] 			= antiInjection(trim(substr($dados,141,40)));
				$arrayDados[$ii]['cidade'] 			= antiInjection(trim(substr($dados,182,50)));
				$arrayDados[$ii]['estado'] 			= antiInjection(trim(substr($dados,233,40)));
				$arrayDados[$ii]['lat'] 			= antiInjection(trim(substr($dados,5,13)));
				$arrayDados[$ii]['lon'] 			= antiInjection(trim(substr($dados,19,13)));
				$ii++;
			
			
			}
			
			
			
		fputs($socket, $fim);
		fclose($socket);
		
		return $arrayDados;	
		}
	
	}
	
}
function buscaEnderecoCepGeoCoder($fPesquisa,$fNumero){
	if($fNumero){
		$fNumero = "-Nro:".$fNumero;
	}else{
		$fNumero = "";
	}
	//$host 	= "187.61.51.167";
	//$host 	= "geocoder.geoportal.com.br";
	$host 	= "geocoder.geoportal.com.br";
	$porta 	= 50001;
	$socket = fsockopen($host, $porta, $errno, $errstr, 1) or die('Could not connect to: '.$host);
	
	$valida 	= "TICKET D5A95D0E-9EF9-4E97-BA70-FEE256C42C06";
	
	if($fPesquisa == ""){
		return false;		
	}else{
		$requisicao = "CepGeocode -Cep:".$fPesquisa." ".$fNumero." -Qtde:10";
	}
	
	$fim 		= "QUIT";

	//verifica se conexao foi aberta
	if(!$socket){
		return false;
	}else{
		//envia validadacao
		fputs($socket,$valida);
		//le retorno
		$resultado = fread($socket,4);
		//se for OK logica continua 
		if(trim($resultado)=="OK"){
			//envia instrucao de comando geocoder
			fputs($socket,$requisicao);
	
				
			$resultado2 = fread($socket, 6);
			
			
			$contagem 	= ( $resultado2 / 285 );
			
			$contagem 	= ceil($contagem);
			
			$ii = 0;
			for($i = 1; $i <= $contagem; $i++ ){
				$dados 	= fread($socket, 285);
				
				$arrayDados[$ii]['rua'] 			= antiInjection(trim(substr($dados,28,80)));
				$arrayDados[$ii]['cep'] 			= antiInjection(trim(substr($dados,123,8)));
				$arrayDados[$ii]['bairro'] 			= antiInjection(trim(substr($dados,132,40)));
				$arrayDados[$ii]['cidade'] 			= antiInjection(trim(substr($dados,173,50)));
				$arrayDados[$ii]['estado'] 			= antiInjection(trim(substr($dados,233,40)));
				$arrayDados[$ii]['lat'] 			= antiInjection(trim(substr($dados,0,13)));
				$arrayDados[$ii]['lon'] 			= antiInjection(trim(substr($dados,14,13)));
				$ii++;
			
			
			}
			
			
			
		fputs($socket, $fim);
		fclose($socket);
		
		return $arrayDados;	
		}
	
	}
	
}
//funcao que monta tabela com informacoes do destino 
function infoPontoBallon($lat,$lng){
   $informacao = buscaEndereco($lat,$lng);
   $result = "<table width=100% border=0 cellspacing=0 cellpadding=0 style=font-size:10px><tr><td align=left valign=top><strong>Endereco:</strong></td><td>".utf8_decode($informacao['logradouro'])."</td></tr><tr><td align=left><strong>Cidade:</strong></td><td>".utf8_decode($informacao['cidade'])."</td></tr><tr><td align=left><strong>Estado:</strong></td><td>".utf8_decode($informacao['estado'])."</td></tr><tr><td align=left><strong>Cep:</strong></td><td>".utf8_decode($informacao['cep'])."</td></tr></table>";   
   return utf8_encode($result);

}

function confData($data){
	if($data){
		$data = date("d/m/Y H:i", strtotime($data));
	}else{
		$data = "Em Aguardo";
	}
	return $data;
}
function confConteudo($conteudo){
	$conteudo = trim($conteudo);
	if(!$conteudo){
		$conteudo = "SEM INFO.";
	}
	return $conteudo;
}
function soNumeros($valor){
	return preg_replace("/[^0-9]/", "", $valor);	
}
function mb_detect_encoding2($string, $enc=null, $ret=null) {        
        static $enclist = array( 
            'UTF-8', 'ASCII', 
            'ISO-8859-1', 'ISO-8859-2', 'ISO-8859-3', 'ISO-8859-4', 'ISO-8859-5', 
            'ISO-8859-6', 'ISO-8859-7', 'ISO-8859-8', 'ISO-8859-9', 'ISO-8859-10', 
            'ISO-8859-13', 'ISO-8859-14', 'ISO-8859-15', 'ISO-8859-16', 
            'Windows-1251', 'Windows-1252', 'Windows-1254', 
            );        
        $result = false;         
        foreach ($enclist as $item) { 
            $sample = iconv($item, $item, $string); 
            if (md5($sample) == md5($string)) { 
                if ($ret === NULL) { $result = $item; } else { $result = true; } 
                break; 
            }
        }        
    return $result; 
} 
function limpa_caracteres_banco( $l){//funcao que troca caracteres do htmlentilets por caracteres sem acentucao
//e necessario uso da funcao htmlentities para converer caracters especiais para html 
	
	$tt = array('&Agrave;', '&agrave;', '&Aacute;', '&aacute;', '&Acirc;', '&acirc;', '&Atilde;', '&atilde;', '&Auml;', '&auml;', '&Aring;', '&aring;', '&AElig;', '&aelig;', '&Ccedil;', '&ccedil;', '&ETH;', '&eth;', '&Egrave;', '&egrave;','&Eacute;', '&eacute;', '&Ecirc;', '&ecirc;', '&Euml;', '&euml;','&Igrave;', '&igrave;', '&Iacute;', '&iacute;', '&Icirc;', '&icirc;', '&Iuml;', '&iuml;', '&Ntilde;', '&ntilde;', '&Ograve;', '&ograve;', '&Oacute;', '&oacute;', '&Ocirc;', '&ocirc;', '&Otilde;', '&otilde;', '&Ouml;', '&ouml;', '&Oslash;', '&oslash;', '&OElig;', '&oelig;', '&szlig;', '&THORN;', '&thorn;', '&Ugrave;', '&ugrave;','&Uacute;', '&uacute;', '&Ucirc;', '&ucirc;', '&Uuml;', '&uuml;', '&Yacute;', '&yacute;', '&Yuml;', '&yuml;');

	$ss = array('A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', '_', '_', 'C', 'c', 'D', 'o', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'N', 'N', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'o', 'o', 'O', 'o', 'C', 'c', 'B', 'p', 'p', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'Y', 'y', 'Y', 'y');
	$g = str_replace($tt, $ss, trim( $l));
	return $g;
}

function mostraBanco($txt){
	$txt = htmlentities($txt, ENT_QUOTES, "UTF-8");
		
	$txt = limpa_caracteres_banco($txt);
	//$txt = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $txt);
	return trim($txt);
	
}

function tiraPontoVirgula($valor){
	$valor = str_replace(",","",$valor);
	$valor = str_replace(".","",$valor);
	return $valor;
	
}
function calcDistGoogle($latOrigem, $lonOrigem, $latDestino, $lonDestino){
	$dadosDistancia = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/xml?origins=".$latOrigem.",".$lonOrigem."&destinations=".$latDestino.",".$lonDestino."&mode=CAR&language=PT&sensor=false");
	$a = simplexml_load_string( $dadosDistancia);
	
	if($a->row->element->distance->text){
		return $a->row->element->distance->text;
		
	}else{
		return "0";
	}
	
}

function nomeMes($a) {
	$numMes = (int) $a;
	switch($numMes) {
		case 1:
		  $nomeMes =  "Janeiro";
		  break;	
		case 2:
		  $nomeMes =  "Fevereiro";
		  break;	
		case 3:
		  $nomeMes =  "Marco";
		  break;	
		case 4:
		  $nomeMes =  "Abril";
		  break;	
		case 5:
		  $nomeMes =  "Maio";
		  break;	
		case 6:
		  $nomeMes =  "Junho";
		  break;	
		case 7:
		  $nomeMes =  "Julho";
		  break;	
		case 8:
		  $nomeMes =  "Agosto";
		  break;	
		case 9:
		  $nomeMes =  "Setembro";
		  break;	
		case 10:
		  $nomeMes =  "Outubro";
		  break;	
		case 11:
		  $nomeMes =  "Novembro";
		  break;	
		case 12:
		  $nomeMes =  "Dezembro";
		  break;	
	}
	return $nomeMes;
}
function checkData($data) { 
       
    list($dd,$mm,$aa)=explode("/",$data); 
    if (is_numeric($aa) && is_numeric($mm) && is_numeric($dd)) 
    { 
        return checkdate($mm,$dd,$aa); 
    } 
    return false;            
} 
function checkHora($hora) {
	list($hh,$min) = explode(":",$hora);
	if (is_numeric($hh) && is_numeric($min)) {
		if ($hh >=0 && $hh <=23 && $min>= 0 && $min<=59) {
			return true;
		} else {
			return false;
		}
	}
	return false;
}
function logCelular($codLog){
	switch($codLog){
		case 1:
			return "<span style='color:#06F; font-weight:bold; padding-right:5px; font-size:10px'>Ligado</span>";
			break;
		case 2:
			return "<span style='color:#F00; font-weight:bold; padding-right:5px; font-size:10px'>Desligado</span>";
			break;
		case 3:
			return "<span style='color:#096; font-weight:bold; padding-right:5px; font-size:10px'>GPS Ativado</span>";
			break;
		case 4:
			return "<span style='color:#F60; font-weight:bold; padding-right:5px; font-size:10px'>GPS Desat.</span>";
			break;		
		
	}
	
}
//FUNCAO PARA VERIFICAR SE O PONTO ESTA DENTRO OU FORA DO POLIGONO  - FUNCCXAO RETORNA NOME DA CERCA CASO SEJA VERDADEIRO 
function confere_poligono($idCerca, $lat, $lon,$poligono, $tipoMonitoramento, $nomeCerca, $email){
	require_once("class.PointInPoly.php");
	$pointLocation = new pointLocation();
		
	$separaPoligono		= explode(",",$poligono);
	$ponto				=  $lon. " ".$lat;
	
	$i  = 0;
	$ii = 0;
	//SISTEMA MONTA O 
	$arrayPoli[] = array();
	
	foreach($separaPoligono as $p){
		if($i==0){
			$montaPoligono = $p;
			$i = 1;
		}else{
			$montaPoligono  = trim($montaPoligono)." ".trim($p);
			$arrayPoli[$ii] = $montaPoligono;
			$i = 0;
			$ii++;	
		}		
	}	
	$situacao = $pointLocation->pointInPolygon($ponto, $arrayPoli);
	
	if(trim($situacao) == "outside"){
		if($tipoMonitoramento == 1){ // 1 DESEJO RECEBER EMAIL QUANDO O PONTO ESTIVER FORA
			$retorno = $tipoMonitoramento . "|" . $email;
		}else{
			$retorno = "";
		}
	}else if(trim($situacao) == "inside"){
		if($tipoMonitoramento == 2){ // 2 DESEJO RECEBER EMAIL QUANDO O PONTO ESTIVER DENTRO
			$retorno = $tipoMonitoramento . "|".$email;
		}else{
			$retorno = "";
		}
	}	
	return $retorno;
}
//FUNCAO PARA FRACIONAR VALORES
function fraciona($a, $b){
	//variavel "a" total
	//variavel "b" gasto
	$valor1 = ($b * 100);
	$x = ($valor1 / $a);
	return $x;  
}
//funcao calculo de distancia metros
function calcDistMetros($p1LA, $p1LO, $p2LA, $p2LO) {
    $r = 6371.0;
       
    $p1LA = $p1LA * pi() / 180.0;
    $p1LO = $p1LO * pi() / 180.0;
    $p2LA = $p2LA * pi() / 180.0;
    $p2LO = $p2LO * pi() / 180.0;
       
    $dLat = $p2LA - $p1LA;
    $dLong = $p2LO - $p1LO;
       
    $a = sin($dLat / 2) * sin($dLat / 2) + cos($p1LA) * cos($p2LA) * sin($dLong / 2) * sin($dLong / 2);
	
	$x = sqrt($a);
	$y = sqrt(1-$a);
	
    $c = 2 * atan2($x, $y);
       
    return round($r * $c * 1000); // resultado em metros.
	$dist =  $r * $c;
	//return round($dist, 3); //retorna km
}
//FUNCAO PARA CALCULO DE KM /h ou MT/ s
function calc_velocidade($distancia, $tempo, $tipo){
	if($tipo == 'mt'){ //retorna em metros segundo 
		$media = ($distancia/$tempo);
	}
	
	if($tipo == 'km'){ //retorna km hora
		$media = ($distancia/$tempo);
		$media = ($media * 3.6);
	}
	return $media;
}
function fraciona_tempo($a, $b){
	//variavel "a" tempo total
	//variavel "b" tempo gasto
	$valor1 = ($b * 100);
	$x = ($valor1 / $a);
	return $x;  
}
function calc_tempo($velocidade,$distancia){ //CALCULA TEMPO COM BASE DE VELOCIDADE ATUAL E DISTANCIA TOTAL PERCURSO
	$mts = ($velocidade / 3.6); //tranforma KM hora em Metros segundos
	$calculo = ($distancia / $mts);
	return $calculo; //retona o tempo em segundos para concluir o trajeto
	//return $mts;
}
/*
SISTEMA VERIFICA TIPO DE RANGE DE COR DE ACOROD COM O TIPO DE FILIAL
*/	
function rangeImagem($rangeImagem, $gps, $tipoMapa = "ver_equipe", $ocupado = ""){
	if($gps==1){ //POSICAO VIA GPS
		if($ocupado == 1){ //ENTREGADOR COM SOLICITACOES
			$imagemIcon = "_".trim($rangeImagem)."_ocupado_gps";
		}else{ //ENTREGADOR SEM SOLICITACOES
			$imagemIcon = "_".trim($rangeImagem)."_gps";
		}							
	}else{//POSICAO VIA DADOS
		if($ocupado == 1){ //ENTREGADOR COM SOLICITACOES
			$imagemIcon = "_".trim($rangeImagem)."_ocupado_3g";
		}else{ //ENTREGADOR SEM SOLICITACOES
			$imagemIcon = "_".trim($rangeImagem)."_3g";
		}
	}
	return $imagemIcon;												
}
function rangeLegenda($nomeFilial, $rangeImagem, $tipoMapa = "ver_equipe"){
	$retorno = 	'<tr style="background-color:#F1F1F1"><td height="20">&nbsp;&nbsp;'.substr($nomeFilial,0,30).'...</td></tr>';
	$retorno .= '<tr><td>&nbsp;&nbsp;<img src="../images/mapas/_'.$rangeImagem.'_gps.png" width="32" title="TRANSMISSÃO VIA GPS" style="float:left;" />';
	$retorno .= '<img src="../images/mapas/_'.$rangeImagem.'_3g.png" width="32" title="TRANSMISSÃO VIA 3G" style="float:left;" />';
	$retorno .= '<img src="../images/mapas/_'.$rangeImagem.'_ocupado_gps.png" width="32" title="TRANSMISSÃO VIA GPS CELULAR OCUPADO NO MOMENTO" style="float:left;" />';
	$retorno .= '<img src="../images/mapas/_'.$rangeImagem.'_ocupado_3g.png" width="32" title="TRANSMISSÃO VIA 3G CELULAR OCUPADO NO MOMENTO" style="float:left;" /></td>
</tr>';
	//sistema retorna tr para inserir na tabela 
	return $retorno;
}

function toDecimal($txt){
	$txt = trim($txt);
	$txt = str_replace(",",".",$txt);
	if(is_numeric($txt)){ //caso expressao nao seja numerica 
		return $txt;
	}else{
		return false;
	}
}
function formPost ($post, $data = 1) {
	/*ATENCAO
	NA CRIACAO DOS CAMPOS DO FORMULARIO, E ESSENCIAL QUE O NAME
	ESTEJA FORMATATO DA SEGUINTE FORMA:
	S --> SE FOR STRING
	N --> SE FORM NUMERICO
	D --> SE FOR DECIMAL
	0 --> SE NAO FOR OBRIGATORIO
	1 --> SE FOR OBRIGATORIO
	NOME DO CAMPO NA TABELA DE DADOS
	EXEMPLO: CONTATO --> S0CONTATO
	CASO TENHA ALTERAÇÕES NOS FORMATOS, ALTERAR ESTA FUNCAO
	*/
foreach($post as $nomeCampo => $valor){ 
   $nomeCampo = lCod($nomeCampo);   //campo codificado
   $err = "";
    
   switch (substr($nomeCampo,0,2)) {
		case 's0':
			$param[substr($nomeCampo,2,1000)] = toString($valor);
			break;
		case 's1':
			if (!$valor) {
				$err .= substr($nomeCampo,2,1000).",";
			} else {
				$param[substr($nomeCampo,2,1000)] = toString($valor);
			}
			break;
		case 'n0':
		 	if ($valor <= 0) {
				$valor = 0;
			}
			$param[substr($nomeCampo,2,1000)] = $valor;
			break;
		case 'n1':
			if (!$valor) {
				$err .= substr($nomeCampo,2,1000).",";
			} else {
				if (is_numeric($valor) ==  false) {
					$err .= substr($nomeCampo,2,1000) . " digite somente numeros";
				} else {
					$param[substr($nomeCampo,2,1000)] = $valor;
				}	
			}
			
			break;
		case 'd0':
			if (!$valor) {
				$valor = 0;
			}
			$param[substr($nomeCampo,2,1000)] = toDecimal($valor);
			break;
		case 'd1':
			if (!$valor) {
				$err .= substr($nomeCampo,2,1000).",";
			} else {
				$valor = toDecimal($valor);
				if (is_numeric($valor) ==  false) {
					$err .= substr($nomeCampo,2,1000) . " digite somente numeros";
				} else {
					$param[substr($nomeCampo,2,1000)] = $valor;
				}
			}
			break;
   }
}   
   if ($data == 1) {
		$param['dt_cadastro'] = "DATA_ATUAL";	   
   }
   
   
   if(!$err) {
		return $param;
   }else {
		return $err;   
   }
}


function ocorrencia($idOcorr){
	switch ($idOcorr) {
		case '0':
			$ocorr = "SEM OCORRENCIA";
			break;	
		case '1':
			$ocorr =  "OCORRENCIA 1";
			break;	
		case '2':
			$ocorr =  "OCORRENCIA 2";
			break;	
		case '3':
			$ocorr =  "OCORRENCIA 3";
			break;	
	 }
	 return $ocorr;
}
function f_situacao($situacao){
	switch ($situacao) {
		case '0':
			$situacao = "OBJETO EXISTENTE";
			break;	
		case '5':
			$situacao = "OBJETO EM AGUARDO RECEBIMENTO NA EXPEDIÇÃO";
			break;		
		case '6':
			$situacao = "OBJETO EM AGUARDO RECEBIMENTO NO DEPARTAMENTO";
			break;		
		case '10':
			$situacao = "OBJETO/ENVOLUCRO COM INICIO DE MOVIMENTACAO";
			break;	
		case '30':
			$situacao = "OBJETO/ENVOLUCRO COM ATRIBUICAO DE TIPO DE ENVIO";
			break;	
		case '50':
			$situacao = "OBJETO/ENVOLUCRO EM EXECUCAO";
			break;	
		case '60':
			$situacao =  "OBJETO/ENVOLUCRO RECEBIDO NO CELULAR, AGUARDANDO LEITURA EXPEDICAO DESTINO";
			break;	
		case '90':
			$situacao =  "DOCUMENTO AGUARDANDO RECEBIMENTO PELO DESTINATÁRIO FINAL";
			break;	
		case '100':
			$situacao =  "OBJETO/ENVOLUCRO RECEBIDO PELO SEU DESTINATARIO";
			break;

	 }
	 return $situacao;
}

function f_tipoEnvio($var) {
	/*
	1 = CARTA REGISTRADA AR 	
	2 = SEDEX		
	3 = SEDEX 10	
	4 = CORREIO SIMPLES
	5 = ENTREGADOR	
	6 = CIRCULACAO INTERNA	
	7 = ENTREGA NO LOCAL
	8 = SEDEX AR		
	9 = SEDEX 10 AR	
	10= EMMS Internacional
	*/	
	switch ($var) {
		case '1':
			$msg = "CORREIOS"; //"CARTA REGISTRADA AR";
			break;
		case '2':
			$msg = "MALOTE (TRANSLADO)"; //SEDEX
			break;
		case '3':
			$msg = "SEDEX 10";
			break;
		case '4':
			$msg = "CORREIO SIMPLES";
			break;	
		case '5':
			$msg = "ENTREGADOR (MOTOBOY)";
			break;	
		case '6':
			$msg = "CIRCULAÇÃO INTERNA (MENSAGERIA)";
			break;	
		case '7':
			$msg = "ENTREGA NO LOCAL";
			break;			
		case '8':
			$msg = "SEDEX AR";
			break;			
		case '9':
			$msg = "SEDEX 10 AR";
			break;
		case '10':
			$msg = "EMMS Internacional";
			break;
		case '11':
			$msg = "PAC";
			break;
		case '12':
			$msg = "PAC AR";
			break;	
		//TIPO DE OBJETO (CARTA SIMPLES, TELEGRAMA, LOGISTICA REVERSA) SISTEMA ARMAZENA TIPO DE ENVIO FIXO 
		case '21':
			$msg = "CARTA SIMPLES";
			break;		
		case '22':
			$msg = "TELEGRAMA";
			break;	
		case '23':
			$msg = "LOGISTICA REVERSA";
			break;	
		case '30':
			$msg = "CARTÃO POSTAL";
			break;		
		case '40':
			$msg = "POSTAGEM";
			break;			
		default:
			$msg = "N/INFO";
			break;				
						
	}
	return $msg;
}

function f_envolucro($tipo) {
	switch ($tipo) {
		case '1':
			$msg = "Objeto";
			break;
		case '10':
			$msg = "Vai Vem";
			break;
		case '20':
			$msg = "Malote";
			break;
		case '30':
			$msg = "Caixa";
			break;
		case '40':
			$msg = "Saco";
			break;
		case '50':
			$msg = "Veiculo";
			break;
	}
	return $msg;
}

function geraTimestamp($data) {
	$partes = explode('/', $data);
	return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
}

function f_dataDiff($data1,$data2){
	// Define os valores a serem usados
	$data_inicial = date('d/m/Y',strtotime($data1));
	$data_final = date('d/m/Y',strtotime($data1));

	$time_inicial = geraTimestamp($data_inicial);
	$time_final = geraTimestamp($data_final);

	// Calcula a diferença de segundos entre as duas datas:
	$diferenca = $time_final - $time_inicial; // 19522800 segundos

	// Calcula a diferença de dias
	$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

 	return $dias;
}

function f_tipoPortePago($tipoPortePago) {
	switch($tipoPortePago) {
		case '1':
			$msn = "PORTE PAGO SEDEX";
			break;
		case '2':
			$msn = "PORTE PAGO SEDEX 10";
			break;
		case '3':
			$msn = "PORTE PAGO CARTA COM AR";
			break;
	}
			
	return $msn;
}



function tipoCores($tipo) {
	switch ($tipo) {
		case '1': 
			$msn = "#ffe4e1";
			break;
		case '2':
			$msn = "#b4eeb4";
			break; 
		case '3': 
			$msn = "#8fd6ff";
			break;
		case '4':	
			$msn = "#ffe671"; 
			break;
		case '5': 
			$msn = "#a1e971";
			break; 
		case '6': 
			$msn = "#ff2c2c"; 
			break;
		case '7': 
			$msn = "#6546ea"; 
			break;
		case '8': 
			$msn = "#ff9000";
			break;
		case '9': 
			$msn = "#00CED1";
			break;
		case '10': 
			$msn = "#20B2AA";
			break;
		case '11': 
			$msn = "#B0C4DE";
			break;
		case '12': 
			$msn = "#FA8072";
			break;
		case '13': 
			$msn = "#87CEEB";
			break;
		case '14': 
			$msn = "#DDA0DD";
			break;
		case '15': 
			$msn = "#0000FF";
			break;
		case '16': 
			$msn = "#FFA500";
			break;
		case '17': 
			$msn = "#00FA9A";
			break;
		case '18': 
			$msn = "#2E8B57";
			break;
		case '19': 
			$msn = "#808000";
			break;
		case '20': 
			$msn = "#00FFFF";
			break;
		case '21': 
			$msn = "#87CEEB";
			break;
		case '22': 
			$msn = "#8B0000";
			break;
		case '23': 
			$msn = "#FA8072";
			break;
		case '24': 
			$msn = "#FF1493";
			break;
		case '25': 
			$msn = "#DDA0DD";
			break;
		case '26': 
			$msn = "#A9A9A9";
			break;
	}
	return $msn;
}
function diaSemanaData($data, $nomeDia=""){	
	$dia	= date("d", strtotime($data));
	$mes	= date("m", strtotime($data));
	$ano	= date("Y", strtotime($data));
	
	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
	if(!$nomeDia){
		switch($diasemana) {
			case"0": $dia_semana = "domingo"; break;
			case"1": $dia_semana = "segunda"; break;
			case"2": $dia_semana = "terca"; break;
			case"3": $dia_semana = "quarta"; break;
			case"4": $dia_semana = "quinta"; break;
			case"5": $dia_semana = "sexta"; break;
			case"6": $dia_semana = "sabado"; break;	
			default: $dia_semana = "nInfo"; break;	
		}
	}else{
		$dia_semana = $diasemana;
	}
	return $dia_semana;	
}
function diaSemana($dia){	
	switch($dia) {
		case"0": $dia_semana = "domingo"; break;
		case"1": $dia_semana = "segunda"; break;
		case"2": $dia_semana = "terca"; break;
		case"3": $dia_semana = "quarta"; break;
		case"4": $dia_semana = "quinta"; break;
		case"5": $dia_semana = "sexta"; break;
		case"6": $dia_semana = "sabado"; break;	
		default: $dia_semana = "nInfo"; break;	
	}
	return $dia_semana;	
}
function listaDiaSemana($frequencia){
	$freqDia = "";
	$arrayFreq = explode("|",$frequencia);
	if(count($arrayFreq)>1){
		foreach($arrayFreq as $f){
			if($freqDia){
				$freqDia .= ", ".diaSemana($f);
			}else{
				$freqDia = diaSemana($f);
			}
		}
	}else{
		$freqDia = diaSemana(trim($frequencia));	
	}	
	return $freqDia;
}

function f_numCorreios() {
	
	$numero = rand(11111111, 99999999);
	
	return "SX".$numero." BR";		
}

function totalDiasUteis($dtInicio, $dtAtual){	
	if($dtInicio!="" && $dtAtual!=""){
		$dtIncrementa = $dtInicio;
		$totalDias 	  = 0;
		$totalDiasUteis = 0; 
		while($dtIncrementa < $dtAtual){
			$totalDias++;			
			$dtIncrementa = date('Y-m-d', strtotime($dtIncrementa. ' + 1 days'));	
			if(date('w',strtotime($dtIncrementa)) != "0" && date('w',strtotime($dtIncrementa))!="6"){
				$totalDiasUteis++;
			}							
			//return echo "DIA: ".$totalDias . " Dias Uteis: ".$totalDiasUteis." ".$dtIncrementa . " ".date('w',strtotime($dtIncrementa))."<br>";				
		}
		return $totalDiasUteis;				
	}else{
		return 0;
	}	
}

function f_situacaoRequisicao($situacao)  {
	switch ($situacao) {
		case '1':
			$msg = "AGUARDO DE ROTERIZAÇÃO";
			break;
		case '10':
			$msg = "ROTEIRIZADA";
			break;
		case '30':
			$msg = "EM PROTOCOLO";
			break;
		case '50':
			$msg = "EM EXECUÇÃO";
			break;
		case '100':
			$msg = "FINALIZADO";
			break;
	}
	return $msg;
}

function f_tipoServico($servico) {
	switch ($servico) {
		case '1':
			$msg = 'COLETA';
			break;
		case '2':
			$msg = 'ENTREGA';
			break;
		case '3':
			$msg = 'COLETA E ENTREGA';
			break;
	}
	return $msg;
}
function numeroDiaSemana($data = ""){
	if($data==""){
		$dia	= date("d");
		$mes	= date("m");
		$ano	= date("Y");
	}else{
		$dia	= date("d", strtotime($data));
		$mes	= date("m", strtotime($data));
		$ano	= date("Y", strtotime($data));
	}
	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
	
	return $diasemana;	
}

function f_localEntrega($tipo) {
	switch ($tipo) {
		case '1':
			$msg = "COPA";
			break;
		case '2':
			$msg = "BUFFET";
			break;
		case '3':
			$msg = "LIMPEZA";
			break;
		case '4':
			$msg = "MATERIAL GRAFICO";
			break;
		case '5':
			$msg = "LEITORAS";
			break;
		case '6':
			$msg = "ENXOVAL";
			break;
		case '-1':
			$msg = "ALMOXARIFADO";
			break;
	}
	return $msg;
}

function f_tipoEntrega ($tipo) {
	switch ($tipo) {
		case '1':
			$msg = "Pessoalmente";
			break;
		case '2':
			$msg = "Malote";
			break;
		case '3':
			$msg = "Correios";
			break;
	}
	return $msg;
}

function f_tipoSituacao ($tipo) {
    switch ($tipo) {
        case "-10":
            $msg = "A Confirmar";
            break;
		case "1":
			$msg = "A Entregar";
			break;
		case "50":
			$msg = "Em Execução";
			break;
		case "100":
			$msg = "Finalizado";
			break;
	}
	return $msg;
}

function f_tipoLocal ($tipo) {
	switch ($tipo) {
		case 1: return "Copa";
		case 2: return "Buffet";
		case 3: return "Limpeza";
		case 4: return "Material Gráfico";
		case 5: return "Leitoras";
		case 6: return "Enxoval";
		default: return "";
	}
}

/**
 * STR_TIPO -> Passar uma string com todos os tipos de produtos. ex.: (1,2,3,4)
 * PESQUISA_TIPO_PRODUTO -> passar o retorno do banco de dados com 'id_tipo_produto' e 'tipo_produto'
 */
function f_strTipoLocal ($strTipo, $pesquisaTipoProduto) {
    // TRATANDO PESQUIA DO TIPO DE PRODUTO 
    $arrTipoProduto = array();
    foreach ($pesquisaTipoProduto as $t) { 
        $arrTipoProduto[$t["id_tipo_produto"]] = $t["tipo_produto"]; 
    }

    // VERIFICANDO OS TIPOS QUE PERTENCEM AO STR_TIPO
    $retornoTipo = "";
    $arrTipo = explode(",", $strTipo);

    if ($arrTipo) {
        foreach ($arrTipo as $t) {
            $retornoTipo .= $arrTipoProduto[$t].", ";
        }

        $retornoTipo = substr($retornoTipo, 0, -2);
    }

    return $retornoTipo ? $retornoTipo : "N. Info.";
}

function f_formatarDataHora ($data) {
	$data = explode(" ", $data);
	$d = explode("-", $data[0]);
	$h = explode(":", $data[1]);
	$data = $d[2]."/".$d[1]."/".$d[0]." ".$h[0].":".$h[1];
	return $data;
}

function f_formatarData ($data) {
	$data = explode(" ", $data);
	$d = explode("-", $data[0]);
	$data = $d[2]."/".$d[1]."/".$d[0];
	return $data;
}

function getDateTimeMobile($data) {
    if (strlen($data) == 14) {
        $novaData = substr($data, 4, 4)."-";
        $novaData .= substr($data, 2, 2)."-";
        $novaData .= substr($data, 0, 2)." ";
        $novaData .= substr($data, 8, 2).":";
        $novaData .= substr($data, 10, 2).":";
        $novaData .= substr($data, 12, 2);
        return $novaData;
    } else {
        return $data;
    }
}

function getDateMobile($data) {
    $novaData = substr($data, 4, 4)."-";
    $novaData .= substr($data, 2, 2)."-";
    $novaData .= substr($data, 0, 2);
    return $novaData;
}

?>