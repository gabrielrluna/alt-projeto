    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 	<script src="../../js/popper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>

<!-- MODAL ALERT - para alertas ou mensagens de sucesso ou erro -->
        <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModal-Titulo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="alertModal-Titulo">Título</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button> -->
                    </div>
                    <div class="modal-body">
                        <span id="alertModal-Mensagem"> ... </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Final do MODAL ALERT -->
        

        <script>
            // Abrir ou fechar o campo de botões no mobile.
            $("#menu").click(() => {
                let btn_menu = $("#btn-menu");
                if (btn_menu.hasClass("d-none")) btn_menu.addClass("d-block").removeClass("d-none");
                else btn_menu.addClass("d-none").removeClass("d-block");
            });

            // Ativar MODAL ALERT
            function ativarModalAlert (titulo = "Título", mensagem = "Minha mensagem") {
                $('#alertModal-Titulo').text(titulo);
                $('#alertModal-Mensagem').html(mensagem);
                $('#alertModal').modal('show');
            }

            // Desativar MODAL ALERT
            function desativarModalAlert (caminho = false, parametros = false, modal = "#alertModal") {
                if (!caminho) {
                    $(modal).modal('hide');
                } else {
                    $(modal).on('hidden.bs.modal', function (e) { parametros ? ev(caminho, parametros) : ev(caminho) });
                }
            }

            // Ativar Modal - Informar Dados Incompletos
            function alertaDadosIncompletos (titulo = false, texto = false) {
                if (titulo && texto) {
                    $('#alertModal-Titulo').text(titulo);
                    $('#alertModal-Mensagem').html(mensagem);
                } else {
                    $('#alertModal-Titulo').text("Atenção!");
                    $('#alertModal-Mensagem').html("Existem campos obrigatórios no formulário que ainda não foram preenchidos.");
                }
                $('#alertModal').modal('show');
            }
            </script>


<footer class="rodape">
    <p class="m-0">Desenvolvido por Webine - <?php echo date("Y"); ?></p>
</footer>
</html>