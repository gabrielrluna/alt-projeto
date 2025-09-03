<?php
include_once("../../bibliotecas/conn.php");
include_once("../../bibliotecas/funcoes.php");
include("../../protect.php");
include_once("../../bibliotecas/SQLHelper.php");
$obj = new SQLHelper(4);

$id          = $_SESSION['id'];

$idProjeto = antiInjection($_POST["idProjeto"]);
$url       = antiInjection($_POST["urlForm"]);
$obs       = antiInjection($_POST["obsForm"]);

$param['id_usuario'] = toString($id);
$param['id_projeto'] = toString($idProjeto);
$param['url']        = toString($url);
$param['obs']        = toString($obs);
$param['situacao']        = 1;

$idUltimo = $obj->Insere("envios", $param);

if($idUltimo > 0){
    $projeto = $obj->Pesquisa("projetos","id_projeto, situacao","id_projeto = {$idProjeto}");
    $situacao = $projeto['situacao'];
    $novaSituacao = $situacao + 1;
    $paramSit['situacao'] = toString($novaSituacao);
    $attSit = $obj->Atualiza("projetos", $paramSit,"id_projeto = {$idProjeto}");
    if($attSit > 0){
        echo "1";
        die();
    }
} else {
    echo "99";
    die();
}
?>
