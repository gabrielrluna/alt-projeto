<?php
include "../inicio/cabecalho.php";

$idProjeto = antiInjection($_POST['idProjeto']);
$cliente = antiInjection($_POST['cliente']);
$projeto = $obj->Pesquisa("projetos","id_projeto, id_profissional, prazo, dt_cadastro, situacao, nome_projeto, descricao, id_cliente","id_projeto = {$idProjeto}");


?>

    <h2>Enviar Projeto</h2>
    <div>
        <p><b>Projeto: </b><?php echo $projeto['nome_projeto']; ?> </p>
        <p><b>Cliente: </b><?php echo $cliente; ?> </p>
        <p><b>Data de criação do projeto: </b><?php echo $projeto['dt_cadastro']; ?> </p>
        <p><b>Prazo para entrega: </b><?php echo $projeto['prazo']; ?> </p>
    </div>
    <div>
        <form action="env_projeto2.php" method="POST" id="enviaForm">
            <div>
                <label for="urlProjeto" class="form-label">Link do projeto</label>
                <input type="url" class="form-control" name="urlForm" id="urlForm">
                <input type="hidden" name="idProjeto" value="<?php echo $idProjeto; ?>">
            </div>
            <div class="mb-2 col">
                <label for="obsProjeto">Observações</label>
                <textarea class="form-control" name="obsForm" id="obsForm" placeholder="Insira observações que você queira deixar para a pessoa que fará a avaliação do projeto."></textarea>
            </div>

            <button type="button" class="btn btn-primary" id="btnForm" onclick="validarForm()">Enviar Projeto</button>
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
                enviaDados(<?php echo $idProjeto; ?>);
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

        function enviaDados (idProjeto) {
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
                    $('#alertModal').on('hidden.bs.modal', function () {ev("ver_projeto.php","idProjeto=>"+idProjeto)});
                } else {
                    ativarModalAlert("Atenção!", "Ocorreu algum erro inesperado, tente novamente.");
                    // desbloquearBotao("#btnForm");
                }
            }
        });
    }
    </script>

<?php include "../inicio/rodape.php"; ?>