<?php
include("../inicio/cabecalho.php");

$idProjeto = antiInjection($_POST['idProjeto']);

$projeto = $obj->Pesquisa("projetos","id_projeto, id_profissional, prazo, dt_cadastro, situacao, nome_projeto, descricao, id_cliente","id_projeto = {$idProjeto}");
$idCliente = $projeto['id_cliente'];
$cliente = $obj->Pesquisa("clientes","id_cliente, nome_fantasia","id_cliente = {$idCliente}");

$qtdEnvio = $obj->PesquisaLoop("envios","id");
$qtdEnvio = count($qtdEnvio);

if($projeto['situacao'] % 2 == 0){
    $btnClass = "disabled";
    $btnText = "Aguarde avaliação";
} else {
    $btnClass = "";
    $btnText  = "Entregar Projeto";
}




?>

<section class="row justify-content-center "  style="min-height: 95vh">
    <div class="col col-lg-7 m-1 bg-light rounded border border-dark d-flex flex-column justify-content-between p-1 ">
        <div>
            <h1><?php echo $projeto['nome_projeto']; ?></h1>
            <p>Data de criação: <?php echo $projeto['dt_cadastro']; ?></p>
            <p>Prazo para entrega: <?php echo $projeto['prazo']; ?></p>
            <p>Descrição do Projeto: <?php echo $projeto['descricao']; ?></p>
            <p>Cliente: <?php echo $cliente['nome_fantasia']; ?></p>
            <p>Quantidade de envios: <?php echo $qtdEnvio; ?></p>

        </div>
        <div class="d-grid gap-2">
            <button type="button" class=" btn btn-primary <?php echo $btnClass; ?>" <?php echo $btnClass; ?> onclick="entregarProjeto('<?php echo $idProjeto; ?>','<?php echo $cliente['nome_fantasia']; ?>')"><?php echo $btnText; ?></button>
            <button type="button" class="btn btn-warning" onclick="ev('ver_projetos.php')">Voltar à lista de projetos</button>
        </div>
    </div>
    <div class="col col-lg-4 m-1 bg-light rounded border border-dark">
        <h1>Histórico de Respostas</h1>
        <hr>
        <?php
        $envios = $obj->PesquisaLoop("envios","url, dt_envio, situacao","id_projeto = {$idProjeto}");
        if(!$envios){?>
            <p>Nenhum envio registrado</p>
        <?php
        } else {
        foreach($envios as $envio){
                    if($envio['situacao'] == 1){
                        $bgColor = "bg-warning";
                    } else if($envio['situacao'] == 2){
                        $bgColor = "bg-danger";
                    } else if($envio['situacao'] == 3){
                        $bgColor = "bg-success";
                    }?>
                    <div class="<?php echo $bgColor; ?>">
                        <p><?php echo $envio['dt_envio']; ?></p>
                        <p><?php echo $envio['url'];?></p>
                        <p>Status: Aguardando aprovação</p>
                    </div>
                <?php } 
        } ?>
        
    </div>
</section>

<script>
    function entregarProjeto(idProjeto,nomeCliente){
        ev("env_projeto.php","idProjeto=>"+idProjeto+"&cliente=>"+nomeCliente);
    }
</script>

<?php include "../inicio/rodape.php"; ?>