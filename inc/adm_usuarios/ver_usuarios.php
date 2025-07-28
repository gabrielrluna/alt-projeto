<?php
include "../inicio/cabecalho.php";
?>

    <h2>Lista de Usuários</h2>

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
                <tr>
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

    <script>
        function excluirUsuario(id){
            alert(id)
        }

        function editarUsuario(id){
            alert(id)

        }
    </script>





<?php include "../inicio/rodape.php"; ?>