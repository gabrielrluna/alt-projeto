<?php
include_once("../../bibliotecas/conn.php");
include_once("../../bibliotecas/funcoes.php");
include_once("../../bibliotecas/SQLHelper.php");
$obj = new SQLHelper(4);

$idUsuario = antiInjection($_POST["i"]);


$idUltimo = $obj->Apaga("usuarios", "id = {$idUsuario}");

if($idUltimo > 0){
    echo "1";
    die();
} else {
    echo "99";
    die();
}
?>