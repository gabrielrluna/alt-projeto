<?php
include "../inicio/cabecalho.php";
?>

    <h2>Adicionar Usuário</h2>
    <div>
        <form action="add_cliente2.php" method="POST" id="enviaForm">
            <div class="row">
                <div class="mb-2 col">
                    <label for="razao" class="form-label">Razão Social</label>
                    <input type="text" class="form-control" name="razaoForm" id="razaoForm">
                    <small class="d-none" id="erro_razao" style="color: red">Preencha o campo</small>
                </div>
                <div class="mb-2 col">
                    <label for="nome" class="form-label">Nome Fantasia</label>
                    <input type="text" class="form-control" name="nomeForm" id="nomeForm">
                    <small class="d-none" id="erro_nome" style="color: red">Preencha o campo</small>
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-12 col-lg-4">
                    <label for="cnpj" class="form-label">CNPJ</label>
                    <input type="number" class="form-control" name="cnpjForm" id="cnpjForm" >
                    <small class="d-none" id="erro_cnpj" style="color: red">Preencha o campo</small>
                </div>
                <div class="mb-2 col-12 col-lg-4">
                    <label for="inscEst" class="form-label">Inscrição Estadual</label>
                    <input type="number" class="form-control" name="inscEstForm" id="inscEstForm" >
                    <small class="d-none" id="erro_inscEst" style="color: red">Preencha o campo</small>
                </div>
                <div class="mb-2 col-12 col-lg-4">
                    <label for="inscMun" class="form-label">Inscrição Municipal</label>
                    <input type="number" class="form-control" name="inscMunForm" id="inscMunForm" >
                    <small class="d-none" id="erro_inscMun" style="color: red">Preencha o campo</small>
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-12 col-lg-4">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="number" class="form-control" name="cepForm" id="cepForm" >
                    <small class="d-none" id="erro_cep" style="color: red">Preencha o campo</small>
                </div>
                <div class="mb-2 col-12 col-lg-3">
                    <label for="cpf" class="form-label">Estado</label>
                    <select class="form-select" name="estadoForm" id="estadoForm" aria-label="Default select example">
                        <option selected disabled>Selecione o Estado</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MT">MT</option>
                        <option value="MS">MS</option>
                        <option value="MG">MG</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PR">PR</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SP">SP</option>
                        <option value="SE">SE</option>
                        <option value="TO">TO</option>                           
                    </select>
                </div>
                <div class="mb-2 col-12 col-lg-5">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" name="cidadeForm" id="cidadeForm" >
                    <small class="d-none" id="erro_cidade" style="color: red">Preencha o campo</small>
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-12 col-lg-7">
                    <label for="logradouro" class="form-label">Logradouro</label>
                    <input type="tel" class="form-control" name="logradouroForm" id="logradouroForm">
                    <small class="d-none" id="erro_logradouro" style="color: red">Preencha o campo</small>
                </div>
                <div class="mb-2 col">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" name="numeroForm" id="numeroForm">
                    <small class="d-none" id="erro_numero" style="color: red">Preencha o campo</small>
                </div>
                <div class="mb-2 col">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" name="complementoForm" id="complementoForm">
                </div>
            </div>


            <div class="row">
                <div class="mb-2 col">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="tel" class="form-control" name="telefoneForm" id="telefoneForm">
                    <small class="d-none" id="erro_telefone" style="color: red">Preencha o campo</small>

                </div>
                <div class="mb-2 col">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="emailForm" id="emailForm">
                    <small class="d-none" id="erro_email" style="color: red">Preencha o campo</small>

                </div>
            </div>

            <div class="row">
                <div class="mb-2 col-12 col-lg-7">
                    <label for="responsavel" class="form-label">Responsável</label>
                    <input type="text" class="form-control" name="responsavelForm" id="responsavelForm">
                    <small class="d-none" id="erro_responsavel" style="color: red">Preencha o campo</small>
                </div>
                <div class="mb-2 col-6 col-lg-2">
                    <label for="fundacao" class="form-label">Ano de Fundação</label>
                    <input type="text" class="form-control" name="fundacaoForm" id="fundacaoForm">
                    <small class="d-none" id="erro_fundacao" style="color: red">Preencha o campo</small>
                </div>
                <div class="mb-2 col">
                    <label for="sit" class="form-label">Situação Cadastral</label>
                    <select class="form-select" name="sitForm" id="sitForm" aria-label="Default select example">
                        <option selected disabled>Selecione uma opção</option>
                        <option value="ativo">Ativo</option>
                        <option value="inapto">Inapto</option>
                        <option value="suspenso">Suspenso</option>
                        <option value="baixado ou cancelado">Baixado ou Cancelado</option>
                        <option value="nulo">Nulo</option>
                         
                    </select>
                </div>
            </div>

            <button type="button" class="btn btn-primary" id="btnForm" onclick="validarForm()">Adicionar Cliente</button>
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
                    ativarModalAlert("Sucesso", "Cliente cadastrado com sucesso.");
                    // bloquearBotao("#btnForm", false);
                    
                    // Ao fechar o modal, ir para a lista de usuários.
                    $('#alertModal').on('hidden.bs.modal', function () {ev("ver_clientes.php")});
                } else {
                    ativarModalAlert("Atenção!", "Ocorreu algum erro inesperado, tente novamente.");
                    // desbloquearBotao("#btnForm");
                }
            }
        });
    }
    </script>

<?php include "../inicio/rodape.php"; ?>