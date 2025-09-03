<?php
include("../inicio/cabecalho.php");
$idProjeto = antiInjection($_POST['idProjeto']);
$cliente = antiInjection($_POST['cliente']);

$projeto = $obj->Pesquisa("projetos","id_projeto, id_profissional, prazo, dt_cadastro, situacao, nome_projeto, descricao, id_cliente","id_projeto = {$idProjeto}");
$envio = $obj->Pesquisa("envios","*","id_projeto = {$idProjeto}");

?>

    <h2>Avaliar Projeto</h2>
    <div>
        <p><b>Projeto: </b><?php echo $projeto['nome_projeto']; ?> </p>
        <p><b>Cliente: </b><?php echo $cliente; ?> </p>
        <p><b>Data de criação do projeto: </b><?php echo $projeto['dt_cadastro']; ?> </p>
        <p><b>Prazo para entrega: </b><?php echo $projeto['prazo']; ?> </p>
    </div>
    <div class="d-grid gap-2">
        <a class="btn btn-primary" type="button" href="<?php echo $envio['url']; ?>" target="blank" >Ver Projeto</a>
    </div>
    <div>
        <form action="aval_projeto2.php" method="POST" id="enviaForm">
            <div>
                <label for="situacao" class="form-label">Avaliação do Projeto</label>
                <select class="form-select" name="situacaoForm" id="situacaoForm">
                    <option value="0" selected disabled>Selecione uma opção</option>
                    <option value="1" class="text-success">Aprovado</option>
                    <option value="2" class="text-danger">Reprovado</option>
                </select>
                <input type="hidden" name="idProjeto" value="<?php echo $idProjeto; ?>">
            </div>
            <div class="mb-2 col">
                <label for="obsProjeto">Observações</label>
                <textarea class="form-control" name="obsForm" id="obsForm" placeholder="Observações sobre o projeto enviado."></textarea>
            </div>

            <button type="button" class="btn btn-success" id="btnForm" onclick="validarForm()">Enviar Devolutiva</button>
        </form>
        
    </div>


<?php include "../inicio/rodape.php"; ?>