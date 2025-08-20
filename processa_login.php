<?php



    //  session_start();

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $username = $_POST['login'];
          $password = md5($_POST['senha']);
          // // echo $password;
          // // die();
          // $connect = mysql_connect("localhost")
          // $db = mysql_select_db("alt_teste");

//             if (isset($entrar)) {

//     $verifica = mysql_query("SELECT * FROM usuarios WHERE login =
//     "$login" AND senha = "$senha"") or die("erro ao selecionar");
//       if (mysql_num_rows($verifica)<=0){
//         echo"<script language="javascript" type="text/javascript">
//         alert("Login e/ou senha incorretos");window.location
//         .href="login.html";</script>";
//         die();
//       }else{
//         setcookie("login",$login);
//         header("Location:index.php");
//       }
//   }

     //     try {
     //         $conn = new PDO("mysql:host=SEU_HOST;dbname=SEU_BANCO_DE_DADOS", "SEU_USUARIO", "SUA_SENHA");
     //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     //         $stmt = $conn->prepare("SELECT id, username, password FROM usuarios WHERE username = :username");
     //         $stmt->bindParam(':username', $username);
     //         $stmt->execute();
     //         $user = $stmt->fetch(PDO::FETCH_ASSOC);

     //         if ($user && password_verify($password, $user['password'])) {
     //             $_SESSION['user_id'] = $user['id'];
     //             $_SESSION['username'] = $user['username'];
     //             header("Location: pagina_protegida.php"); // Redireciona para a página protegida
     //             exit();
     //         } else {
     //             echo "Usuário ou senha inválidos.";
     //         }
     //     } catch(PDOException $e) {
     //         echo "Erro: " . $e->getMessage();
     //     }
     //     $conn = null;
     }
     ?>