<?php
include "../inicio/cabecalho.php";
?>

    <h2>Criar Projeto</h2>
    <div>
        <form action="add_projeto2.php" method="POST" id="enviaForm">
            <div class="mb-2">
                <label for="nomeProjeto" class="form-label">Nome do Projeto</label>
                <input type="text" class="form-control" placeholder="Dê um nome para o identificar o projeto que será criado" name="nomeProjetoForm" id="nomeProjetoForm">
                <small class="d-none" id="erro_nome_projeto" style="color: red">Preencha o campo</small>
            </div>
            <div class="mb-2">
                <label for="clienteProjeto" class="form-label">Cliente</label>
                <select class="form-select" name="clienteForm" id="clienteForm" aria-label="Default select example">
                <option selected disabled>Selecione o Cliente</option>
                <?php
                $clientes = $obj->PesquisaLoop("clientes", "id_cliente, nome_fantasia");
                foreach($clientes as $cliente){
                ?>
                <option value="<?php echo $cliente['id_cliente']?>"><?php echo $cliente['nome_fantasia']?></option>                        
                <?php
                }
                ?>
            </select>

            </div>
            <div class="mb-2">
                <label for="cpf" class="form-label">Profissional</label>
                <select class="form-select" name="profissionalForm" id="profissionalForm" aria-label="Default select example">
                    <option selected disabled>Selecione o Profissional</option>
                    <?php
                    $usuarios = $obj->PesquisaLoop("usuarios INNER JOIN funcoes ON usuarios.id_funcao = funcoes.id_funcao", "usuarios.id, usuarios.nome, usuarios.id_funcao, funcoes.funcao");
                    foreach($usuarios as $usuario){
                    ?>
                    <option value="<?php echo $usuario['id']?>"><?php echo $usuario['nome']." - ".$usuario['funcao'] ?></option>                        
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-2 col">
                <label for="prazo" class="form-label">Prazo</label>
                <input type="date" class="form-control" name="prazoForm" id="prazoForm">
                <small class="d-none" id="erro_prazo" style="color: red">Preencha o campo</small>
            </div>
            <div class="mb-2 col">
                <label for="descricao">Descrição do Projeto</label>
                <textarea class="form-control" name="descricaoForm" id="descricaoForm"></textarea>

            </div>

            <button type="button" class="btn btn-primary" id="btnForm" onclick="validarForm()">Criar Projeto</button>
        </form>
        
    </div>
    

    <script>


        function validarForm() {
            var erro = false; // Verifica se tem erro.
            var id = "#btnForm"; // ID do botão.
            // bloquearBotao(id);

            // // Verificando Usuario
            // var nome = $("#nomeForm").val();
            // if (nome == "") {
            //     $("#erro_nome").removeClass("d-none");
            //     erro = true;
            // } else {
            //     $("#erro_nome").addClass("d-none");
            // }

            // // Verificando CPF
            // var cpf = $("#cpfForm").val();
            // if (cpf == "") {
            //     $("#erro_cpf").removeClass("d-none");
            //     erro = true;
            // } else {
            //     $("#erro_cpf").addClass("d-none");
            // }

            // // Verificando E-mail
            // var email = $("#emailForm").val().trim();
            // if (email.length < 3) {
            //     $("#erro_email").removeClass("d-none");
            //     erro = true;
            // } else {
            //     $("#erro_email").addClass("d-none");
            // }

            // SUBMIT do formulário caso não de erro.
            if (erro) {
                // desbloquearBotao(id);
            } else {
                enviaDados();
            }
        }

        // function validarUsuario (sEmail,vIdUsuarioIntegracao) {
        //     $("#resultado").load("validar_usuario.php", {email: sEmail, i: '<?php //echo $id; ?>', idUsuarioIntegracao:vIdUsuarioIntegracao }, function (sRetorno) {
        //         if (sRetorno == "1") {
        //             enviaDados();
        //         } else {
        //             ativarModalAlert("Atenção!", "O email do usuário já existe, tente cadastrar outro.");
        //             desbloquearBotao("#btnForm", false);
        //         }
        //     });
        // }

        function enviaDados () {
        $.ajax({
            type: 'POST',
            url: $('#enviaForm').attr('action'),
            data: $('#enviaForm').serialize(),
            success: function (data) {
                if ($.trim(data) == 99) {
                    ativarModalAlert("Erro!", "Não foi possível cadastrar o usuário, tente novamente.");
                    // desbloquearBotao("#btnForm");
                } else if ($.trim(data) == 1) {
                    ativarModalAlert("Sucesso", "Usuário cadastrado com sucesso.");
                    // bloquearBotao("#btnForm", false);
                    
                    // Ao fechar o modal, ir para a lista de usuários.
                    $('#alertModal').on('hidden.bs.modal', function () {ev("ver_projetos.php")});
                } else {
                    ativarModalAlert("Atenção!", "Ocorreu algum erro inesperado, tente novamente.");
                    // desbloquearBotao("#btnForm");
                }
            }
        });
    }
    </script>

<?php include "../inicio/rodape.php"; ?>