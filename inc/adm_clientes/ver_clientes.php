<?php
include "../inicio/cabecalho.php";
?>

    <div class="row">
        <div class="col-6">
            <h2>Lista de Clientes</h2>
        </div>
        <div class="col-6">
            <a class="btn btn-primary" href="#">Adicionar Cliente</a>
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
                <th scope="col">Nome Fantasia</th>
                <th scope="col">CNPJ</th>
                <th scope="col">Responsável</th>
                <th scope="col">Telefone</th>
                <th scope="col">Projetos Concluídos</th>
                <th scope="col">Projetos em Andamento</th>
                <th scope="col">Situação</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>

                <?php
                $clientes = $obj->PesquisaLoop("clientes", "id_cliente, nome_fantasia, cnpj, responsavel, tel, email, situacao");
                foreach($clientes as $cliente){?>
                <tr class="align-middle">
                    <th scope="row"><?php echo $cliente['id_cliente'] ?></th>
                    <td><?php echo $cliente['nome_fantasia'] ?></td>
                    <td><?php echo $cliente['cnpj'] ?></td>
                    <td><?php echo $cliente['responsavel'] ?></td>
                    <td><?php echo $cliente['tel'] ?></td>
                    <td>10</td>
                    <td>3</td>
                    <td><?php echo $cliente['situacao'] ?></td>

                    <td>
                        <button class="btn btn-button btn-danger" id="exc-<?php echo $cliente['id_cliente'] ?>" onclick="excluirCliente(<?php echo $cliente['id_cliente'] ?>)">Excluir</button>
                        <button class="btn btn-button btn-primary" id="edit-<?php echo $cliente['id_cliente'] ?>" onclick="editarCliente(<?php echo $cliente['id_cliente'] ?>)">Editar</button>
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