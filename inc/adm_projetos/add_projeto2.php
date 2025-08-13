<?php
include_once("../../bibliotecas/conn.php");
include_once("../../bibliotecas/funcoes.php");
include_once("../../bibliotecas/SQLHelper.php");
$obj = new SQLHelper(4);

$nomeProjeto    = antiInjection($_POST["nomeProjetoForm"]);
$idProfissional = antiInjection($_POST["profissionalForm"]);
$idCliente      = antiInjection($_POST["profissionalForm"]);
$prazo          = antiInjection($_POST["prazoForm"]);
// $idFuncao    = antiInjection($_POST["funcaoForm"]);

// die();


$param['nome_projeto']    = toString($nomeProjeto);
$param['id_profissional'] = toString($cpf);
$param['id_cliente']      = toString($telefone);
$param['prazo']           = toString($email);
$param['situacao']        = 1;



$idUltimo = $obj->Insere("projetos", $param);

if($idUltimo > 0){
    echo "1";
    die();
} else {
    echo "99";
    die();
}
?>

