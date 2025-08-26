<?php
include("../inicio/cabecalho.php");

$idProjeto = antiInjection($_POST['idProjeto']);

$projeto = $obj->Pesquisa("projetos","id_projeto, id_profissional, prazo, dt_cadastro, situacao, nome_projeto, descricao, id_cliente","id_projeto = {$idProjeto}");
$idCliente = $projeto['id_cliente'];
$cliente = $obj->Pesquisa("clientes","id_cliente, nome_fantasia","id_cliente = {$idCliente}");

?>

<section class="row justify-content-center "  style="min-height: 95vh">
    <div class="col col-lg-7 m-1 bg-light rounded border border-dark d-flex flex-column justify-content-between p-1 ">
        <div>
            <h1><?php echo $projeto['nome_projeto']; ?></h1>
            <p>Data de criação: <?php echo $projeto['dt_cadastro']; ?></p>
            <p>Prazo para entrega: <?php echo $projeto['prazo']; ?></p>
            <p>Descrição do Projeto: <?php echo $projeto['descricao']; ?></p>
            <p>Cliente: <?php echo $cliente['nome_fantasia']; ?></p>

        </div>
        <div class="d-grid gap-2">
            <button type="button" class="btn btn-primary" onclick="entregarProjeto(<?php echo $idProjeto; ?>)">Entregar Projeto</button>
        </div>
    </div>
    <div class="col col-lg-4 m-1 bg-light rounded border border-dark">
        <h1>Histórico de Respostas</h1>
        <hr>
        <div>
            <p>Resposta 1</p>
            <p>Status: Aguardando aprovação</p>
        </div>
        <hr>
        <div>
            <p>Resposta 1</p>
            <p>Status: Aguardando aprovação</p>
        </div>
        <hr>
        <div>
            <p>Resposta 1</p>
            <p>Status: Aguardando aprovação</p>
        </div>
        <hr>

    </div>
</section>

<?php include "../inicio/rodape.php"; ?>