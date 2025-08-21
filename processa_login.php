<?php
include("bibliotecas/conn.php");
include("bibliotecas/funcoes.php");


if(isset($_POST['acesso']) || isset($_POST['senha'])){
     if(strlen($_POST['acesso']) == 0){
          echo "Preencha seu acesso";
     } else if(strlen($_POST['senha']) == 0){
          echo "Preencha sua senha";
     } else{
          $acesso = $conn->real_escape_string($_POST['acesso']);
          $senha  = $conn->real_escape_string($_POST['senha']);

          $sql = "SELECT * FROM usuarios WHERE acesso = '$acesso' AND senha = '$senha'";
          $sql_query = $conn->query($sql) or die("Falha na execução do código SQL: " . $conn->error);

          $qtd = $sql_query->num_rows;

          if($qtd == 1){
               $usuario = $sql_query->fetch_assoc();

               if(!isset($_SESSION)){
                    session_start();
               }

               $_SESSION['id'] = $usuario['id'];
               $_SESSION['nome'] = $usuario['nome'];
               $_SESSION['tipo'] = $usuario['tipo_usuario'];

               header("Location: inc/inicio/index.php");
          } else {
               echo "Falha ao logar: Informações inválidas";
          }
     }
}


     ?>