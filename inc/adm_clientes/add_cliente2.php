<?php
include_once("../../bibliotecas/conn.php");
include_once("../../bibliotecas/funcoes.php");
include_once("../../bibliotecas/SQLHelper.php");
$obj = new SQLHelper(4);

$razaoSocial  = antiInjection($_POST["razaoForm"]);
$nomeFantasia = antiInjection($_POST["nomeForm"]);
$cnpj         = antiInjection($_POST["cnpjForm"]);
$inscEst      = antiInjection($_POST["inscEstForm"]);
$inscMun      = antiInjection($_POST["inscMunForm"]);
$cep          = antiInjection($_POST["cepForm"]);
$estado       = antiInjection($_POST["estadoForm"]);
$cidade       = antiInjection($_POST["cidadeForm"]);
$logradouro   = antiInjection($_POST["logradouroForm"]);
$numero       = antiInjection($_POST["numeroForm"]);
$complemento  = antiInjection($_POST["complementoForm"]);
$telefone     = antiInjection($_POST["telefoneForm"]);
$email        = antiInjection($_POST["emailForm"]);
$resonsavel   = antiInjection($_POST["responsavelForm"]);
$fundacao     = antiInjection($_POST["fundacaoForm"]);
$sitForm      = antiInjection($_POST["sitForm"]);

$param['razao_social']       = toString($razaoSocial);
$param['nome_fantasia']      = toString($nomeFantasia);
$param['cnpj']               = toString($cnpj);
$param['insc_estadual']      = toString($inscEst);
$param['insc_municipal']     = toString($inscMun);
$param['cep']                = toString($cep);
$param['estado']             = toString($estado);
$param['cidade']             = toString($cidade);
$param['logradouro']         = toString($logradouro);
$param['numero']             = toString($numero);
$param['complemento']        = toString($complemento);
$param['tel']                = toString($telefone);
$param['email']              = toString($email);
$param['responsavel']        = toString($resonsavel);
$param['ano_fundacao']       = toString($fundacao);
$param['sit_cadastral'] = toString($sitForm);
$param['situacao']           = toString("ativo");



$idUltimo = $obj->Insere("clientes", $param);

if($idUltimo > 0){
    echo "1";
    die();
} else {
    echo "99";
    die();
}
?>

