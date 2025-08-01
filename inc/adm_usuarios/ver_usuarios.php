<?php
include "../inicio/cabecalho.php";
?>

    <div class="row">
        <div class="col-6">
            <h2>Lista de Usuários</h2>
        </div>
        <div class="col-6">
            <a class="btn btn-primary" href="#">Adicionar usuário</a>
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
                <th scope="col">Usuário</th>
                <th scope="col">Função</th>
                <th scope="col">Projetos Concluídos</th>
                <th scope="col">Projetos em Andamento</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>

                <?php
                $usuarios = $obj->PesquisaLoop("usuarios", "id, nome, funcao");
                foreach($usuarios as $usuario){?>
                <tr class="align-middle">
                    <th scope="row"><?php echo $usuario['id'] ?></th>
                    <td><?php echo $usuario['nome'] ?></td>
                    <td><?php echo $usuario['funcao'] ?></td>
                    <td>10</td>
                    <td>3</td>
                    <td>
                        <button class="btn btn-button btn-danger" id="exc-<?php echo $usuario['id'] ?>" onclick="excluirUsuario(<?php echo $usuario['id'] ?>)">Excluir</button>
                        <button class="btn btn-button btn-primary" id="edit-<?php echo $usuario['id'] ?>" onclick="editarUsuario(<?php echo $usuario['id'] ?>)">Editar</button>
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