<?php
include "../inicio/cabecalho.php";
?>

    <h2>Adicionar Usuário</h2>
    <div>
        <form action="add_usuario2.php" method="post">
            <div class="mb-2">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nomeForm">
            </div>
            <div class="mb-2">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpfForm">
            </div>

            <div class="mb-2">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" id="telefoneForm">
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="emailForm">
            </div>
            <div class="mb-2">
                <label for="dataNasc" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="dataNascForm">
            </div>
            <div class="mb-2">
                <select class="form-select" aria-label="Default select example">
                    <option selected disabled>Selecione a Função</option>
                    <option value="1">Web Designer</option>
                    <option value="2">Gestor de Tráfego Pago</option>
                    <option value="3">Copywritter</option>
                    <option value="4">Outro</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Criar Usuário</button>
        </form>
        
    </div>
    






<?php include "../inicio/rodape.php"; ?>