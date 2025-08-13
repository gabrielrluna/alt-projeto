<?php
include("inc/inicio/ev.php");
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Login - Alt</title>
</head>
<body>

    <section class="row">
        <div class="col-8" style="height: 100vh; background: #512354">
            
        </div>
        <div class="row col-4 bg-light align-items-center" style="height: 100vh">
            <div class="">
                <img src="assets/logo/487239370_841478978171287_3989743103304765641_n.jpg" class="img-fluid" alt="">
                <form>
                    <div class="mb-3">
                        <label for="emailForm" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailForm" aria-describedby="emailHelp">
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="senhaEmail" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senhaEmail">
                    </div>


                    <a type="button" onclick="login()" class="btn btn" style="background: #512354; color: #f1cc64">Entrar</a>
                </form>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script>
        function login(){
            ev("inc/inicio/index.php")
        }
    </script>

</body>

<!-- <footer>
    <p class="m-0">Desenvolvido por Webine - <?php //echo date("Y"); ?></p>
</footer> -->
</html>

