<?php
    /*
        ATENÇÃO!!!

        Este modal faz a pergunta se o usuário deseja excluir ou não o 'elemento'. Para isso é importante saber.

        1 - Função de Trigger - ativarModalPerqunta('id-do-elemento', 'id-da-tr-para-excluir', 'pergunta-para-o-usuario').
        2 - Se a resposta for SIM, deve ter na página atual uma função f_excluir('id-do-elemento', 'id-da-tr').
        2.1 - OBRIGATÓRIO TER ESSA FUNÇÃO, pois ela que irá fazer todo o processo de exclusão do elemento.

        3 - Função de Trigger - desativarModalPergunta(), não precisa passar nada, pois quando ativar, as informações antigas serão apagadas.
    */
?>

<!-- MODAL PERGUNTA - Realmente Deseja Excluir -->
<div class="modal fade" id="perguntaModal" tabindex="-1" role="dialog" aria-labelledby="perguntaModal-Titulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="perguntaModal-Titulo">Atenção !!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button>
            </div>
            <div class="modal-body">
                <span id="perguntaModal-Mensagem"> ... </span>
            </div>
            <div class="modal-footer justify-content-center">
                <button id="pSim" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-success px-3">Sim</button>
                <button data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger px-3">Não</button>
            </div>
        </div>
    </div>
</div>


<!-- Final do MODAL PERGUNTA -->

<script>
// Ativar MODAL PERGUNTA
function ativarModalPergunta (sIdElemento, tr, pergunta) {
	$('#perguntaModal-Mensagem').html(pergunta);
	$("#pSim").attr("onclick", ("f_excluir('" + sIdElemento + "','" + tr + "')"));
	$('#perguntaModal').modal('show');
}

function ativarModalPerguntaSenha (sIdElemento, tr, pergunta) {
	$('#perguntaModal-Mensagem').html(pergunta);
	$("#pSim").attr("onclick", ("f_senha('" + sIdElemento + "','" + tr + "')"));
	$('#perguntaModal').modal('show');
}

function ativarModalDesativar (sIdElemento, conteudo, pergunta, numero) {
	$('#perguntaModal-Mensagem').html(pergunta);
	$("#pSim").attr("onclick", ("f_desativar('" + sIdElemento + "','" + conteudo + "','"+numero+"')"));
	$('#perguntaModal').modal('show');
}	

function modalPergunta (pergunta, minhaFuncao) {
	$('#perguntaModal-Mensagem').html(pergunta);
	$("#pSim").click(minhaFuncao);
	$('#perguntaModal').modal('show');
}

// Desativar MODAL PERGUNTA
function desativarModalPergunta () {
	$('#perguntaModal').modal('hiden');
}
</script>