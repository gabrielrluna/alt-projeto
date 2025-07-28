<?php
include_once("../../bibliotecas/conn.php");
include_once("../../bibliotecas/funcoes.php");
include_once("../../bibliotecas/SQLHelper.php");
$obj = new SQLHelper(4);

$nome     = antiInjection($_POST["nomeForm"]);
$cpf      = antiInjection($_POST["cpfForm"]);
$telefone = antiInjection($_POST["telefoneForm"]);
$email    = antiInjection($_POST["emailForm"]);
$dt_nasc  = antiInjection($_POST["dataNascForm"]);
$funcao   = antiInjection($_POST["nomeForm"]);


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


$param['nome']     = toString($nome);
$param['cpf']      = toString($cpf);
$param['telefone'] = toString($telefone);
$param['email']    = toString($email);
$param['dt_nasc']  = toString($dt_nasc);
$param['funcao']   = toString($funcao);


$idUltimo = $obj->Insere("usuarios", $param);

if($idUltimo > 0){
    echo "1";
    die();
} else {
    echo "99";
    die();
}
?>

