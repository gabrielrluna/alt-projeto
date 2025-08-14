<?php
include "../inicio/cabecalho.php";

$projetos = $obj->PesquisaLoop("projetos INNER JOIN usuarios ON projetos.id_profissional = usuarios.id", "projetos.id_projeto, projetos.dt_cadastro, projetos.id_profissional, projetos.prazo, projetos.situacao, projetos.nome_projeto, projetos.id_cliente, usuarios.nome");


?>



    <div class="row">
        <div class="col-6">
            <h2>Projetos</h2>
        </div>
        <div class="col-6">
            <a class="btn btn-primary" href="#">Criar Projeto</a>
        </div>    
    </div>
    <hr>

    <div class="row ">
        <div class="col">
            <select class="form-select" name="" id="">
                <option value="0">Ordenar por</option>
                <option value="1">Nome</option>
                <option value="2">Função</option>
                <option value="3">Projetos Concluídos</option>
                <option value="4">Projetos em Andamento</option>
            </select>
        </div>
        <div class="col">
            <select class="form-select" name="" id="">
                <option value="0">Filtrar por</option>
                <option value="1">Função</option>
            </select>
        </div>
    </div>

    <hr>

    <table class="table table-hover">
         <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Projeto</th>
                <th scope="col">Cliente</th>
                <th scope="col">Responsável</th>
                <th scope="col">Tempo Restante</th>
                <th scope="col">Situação</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>

                <?php
                foreach($projetos as $projeto){
                $idCliente = $projeto['id_cliente'];
                $clientes = $obj->Pesquisa("clientes", "id_cliente, nome_fantasia","id_cliente = {$idCliente}");
                ?>
                <tr class="align-middle">
                    <th scope="row"><?php echo $projeto['id_projeto'] ?></th>
                    <td><?php echo $projeto['nome_projeto'] ?></td>
                    <td><?php echo $clientes['nome_fantasia'] ?></td>
                    <td><?php echo $projeto['nome'] ?></td>
                    <td><?php echo $projeto['dt_cadastro'] ?></td>
                    <td>10</td>


                    <td>
                        <button class="btn btn-button btn-danger" id="exc-<?php echo $projeto['id_projeto'] ?>" onclick="excluirProjeto(<?php echo $projeto['id_projeto'] ?>)">Excluir</button>
                        <button class="btn btn-button btn-primary" id="edit-<?php echo $projeto['id_projeto'] ?>" onclick="editarProjeto(<?php echo $projeto['id_projeto'] ?>)">Editar</button>
                    </td>
                </tr>
                <?php } ?>

        </tbody>        
    </table>
    <div id="resultado" class="d-none"></div>

    <script>
        function excluir(id){
                    $("#resultado").load("exc_usuario.php", {i: id}, function (sRetorno) {
                    if (sRetorno == "1") {
                        ativarModalAlert("Atenção!", "Usuário excluído com sucesso.");
                        $('#alertModal').on('hidden.bs.modal', function () {ev("ver_usuarios.php")});

                    } else {
                        ativarModalAlert("Atenção!", "Algo deu errado. Tente novamente");
                    }
                });
                }
                
        function excluirUsuario(id){
            modalPergunta("Deseja realmente excluir o usuário?","excluir("+id+")");
        }

        function editarUsuario(id){
            console.log(id);
            
        }
    </script>



<?php include "../inicio/rodape.php"; ?>