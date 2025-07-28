<?php
include "../inicio/cabecalho.php";
?>

    <h2>Adicionar Usuário</h2>
    <div>
        <form action="add_usuario2.php" method="POST" id="enviaForm">
            <div class="mb-2">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nomeForm" id="nomeForm">
                <small class="d-none" id="erro_nome" style="color: red">Preencha o campo</small>
            </div>
            <div class="mb-2">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" name="cpfForm" id="cpfForm" >
                <small class="d-none" id="erro_cpf" style="color: red">Preencha o campo</small>

            </div>

            <div class="mb-2">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" name="telefoneForm" id="telefoneForm">
                <small class="d-none" id="erro_telefone" style="color: red">Preencha o campo</small>

            </div>
            <div class="mb-2">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="emailForm" id="emailForm">
                <small class="d-none" id="erro_email" style="color: red">Preencha o campo</small>

            </div>
            <div class="mb-2">
                <label for="dataNasc" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" name="dataNascForm" id="dataNascForm">
                <small class="d-none" id="erro_dt_nasc" style="color: red">Preencha o campo</small>

            </div>
            <div class="mb-2">
                <select class="form-select" name="funcaoForm" id="funcaoForm" aria-label="Default select example">
                    <option selected disabled>Selecione a Função</option>
                    <option value="1">Web Designer</option>
                    <option value="2">Gestor de Tráfego Pago</option>
                    <option value="3">Copywritter</option>
                    <option value="4">Outro</option>
                </select>
            </div>

            <button type="button" class="btn btn-primary" id="btnForm" onclick="validarForm()">Criar Usuário</button>
        </form>
        
    </div>
    

    <script>

        function validarForm() {
            var erro = false; // Verifica se tem erro.
            var id = "#btnForm"; // ID do botão.
            // bloquearBotao(id);

            // Verificando Usuario
            var nome = $("#nomeForm").val();
            if (nome == "") {
                $("#erro_nome").removeClass("d-none");
                erro = true;
            } else {
                $("#erro_nome").addClass("d-none");
            }

            // Verificando CPF
            var cpf = $("#cpfForm").val();
            if (cpf == "") {
                $("#erro_cpf").removeClass("d-none");
                erro = true;
            } else {
                $("#erro_cpf").addClass("d-none");
            }

            // Verificando E-mail
            var email = $("#emailForm").val().trim();
            if (email.length < 3) {
                $("#erro_email").removeClass("d-none");
                erro = true;
            } else {
                $("#erro_email").addClass("d-none");
            }

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
                    $('#alertModal').on('hidden.bs.modal', function () {ev("ver_usuarios.php")});
                } else {
                    ativarModalAlert("Atenção!", "Ocorreu algum erro inesperado, tente novamente.");
                    desbloquearBotao("#btnForm");
                }
            }
        });
    }
    </script>

<?php include "../inicio/rodape.php"; ?>