<?php
include("../../bibliotecas/funcoes.php");

$idProjeto = antiInjection($_POST['i']);
echo $idProjeto;

?>