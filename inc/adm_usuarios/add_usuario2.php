<?php
include_once("../../bibliotecas/conn.php");
include_once("../../bibliotecas/funcoes.php");
include_once("../../bibliotecas/SQLHelper.php");
$obj = new SQLHelper(4);

$nome     = antiInjection($_POST["nomeForm"]);
$cpf      = antiInjection($_POST["cpfForm"]);
$telefone = antiInjection($_POST["telefoneForm"]);
$email    = antiInjection($_POST["emailForm"]);
$estado   = antiInjection($_POST["estadoForm"]);
$cidade   = antiInjection($_POST["cidadeForm"]);
$dt_nasc  = antiInjection($_POST["dataNascForm"]);
$idFuncao = antiInjection($_POST["funcaoForm"]);



// <option value="1">AC</option>
// <option value="2">AL</option>
// <option value="3">AP</option>
// <option value="4">AM</option>
// <option value="5">BA</option>
// <option value="6">CE</option>
// <option value="7">DF</option>
// <option value="8">ES</option>
// <option value="9">GO</option>
// <option value="10">MA</option>
// <option value="11">MT</option>
// <option value="12">MS</option>
// <option value="13">MG</option>
// <option value="14">PA</option>
// <option value="15">PB</option>
// <option value="16">PR</option>
// <option value="17">PE</option>
// <option value="18">PI</option>
// <option value="19">RJ</option>
// <option value="20">RN</option>
// <option value="21">RS</option>
// <option value="22">RO</option>
// <option value="23">RR</option>
// <option value="24">SC</option>
// <option value="25">SP</option>
// <option value="26">SE</option>
// <option value="27">TO</option>   


// echo $nome;
// echo '<br>';
// echo $cpf;
// echo '<br>';
// echo $telefone;
// echo '<br>';
// echo $email;
// echo '<br>';
// echo $dt_nasc;
// echo '<br>';
// echo $funcao;
// echo '<br>';

// die();


$param['nome']      = toString($nome);
$param['cpf']       = toString($cpf);
$param['telefone']  = toString($telefone);
$param['email']     = toString($email);
$param['estado']    = toString($estado);
$param['cidade']    = toString($cidade);
$param['dt_nasc']   = toString($dt_nasc);
$param['id_funcao'] = toString($idFuncao);


$idUltimo = $obj->Insere("usuarios", $param);

if($idUltimo > 0){
    echo "1";
    die();
} else {
    echo "99";
    die();
}
?>

