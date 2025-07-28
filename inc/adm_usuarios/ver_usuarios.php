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
            <tr>
                <th scope="row">1</th>
                <td>José da Silva</td>
                <td>Faxineiro</td>
                <td>10</td>
                <td>3</td>
                <td>
                    <button class="btn btn-button btn-danger">Excluir</button>
                    <button class="btn btn-button btn-primary">Editar</button>
                </td>
            </tr>
        </tbody>        
    </table>







<?php include "../inicio/rodape.php"; ?>