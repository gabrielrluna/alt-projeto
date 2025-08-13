<?php
include_once("../../bibliotecas/conn.php");
include_once("../../bibliotecas/funcoes.php");
include_once("../../bibliotecas/SQLHelper.php");
$obj = new SQLHelper(4);
include("ev.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../style/style.css">

    <title>Projeto Alt</title>
</head>


<body>
    <div class="menu-lateral">
        <div>
            <img src="../../assets/logo/487239370_841478978171287_3989743103304765641_n.jpg" class="img-fluid"  alt="" style="margin: 10px; max-width: 50%;">
        </div>
        <nav class="nav flex-column">
            <!-- Menu Início  -->
            <a href="../inicio/index.php" class="nav-link">
                <span class="icon">
                    <i class="bi bi-house-fill"></i>
                </span>
                <span class="descricao">Início</span>
            </a>
            <!-- Menu Dashboard  -->
            <a href="dashboard.php" class="nav-link">
                <span class="icon">
                    <i class="bi bi-grid-fill"></i>
                </span>
                <span class="descricao">Dashboard</span>
            </a> 
            <!-- Menu Projetos  -->            
            <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#projetos" aria-expanded="false" aria-controls="projetos">
                <span class="icon">
                    <i class="bi bi-folder-fill"></i>
                </span>
                <span class="descricao">Projetos <i class="bi bi-caret-down-fill"></i></span>
            </a>
            <div class="sub-menu collapse" id="projetos">
                <a href="index.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-folder-symlink"></i>
                    </span>
                    <span class="descricao">Ver Projetos</span>
                </a>
                <a href="../adm_projetos/add_projeto.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-folder-plus"></i>
                    </span>
                    <span class="descricao">Criar Projeto</span>
                </a>
                <a href="../adm_usuarios/edit_usuario.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-person-gear"></i>
                    </span>
                    <span class="descricao">Editar Projeto</span>
                </a>   
                <a href="../adm_usuarios/exc_usuario.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-person-dash"></i>
                    </span>
                    <span class="descricao">Excluir Projeto</span>
                </a>                
            </div>

            <!-- Menu Clientes  -->            
            <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#clientes" aria-expanded="false" aria-controls="clientes">
                <span class="icon">
                    <i class="bi bi-clipboard2-fill"></i>
                </span>
                <span class="descricao">Clientes <i class="bi bi-caret-down-fill"></i></span>
            </a>
            <div class="sub-menu collapse" id="clientes">
                <a href="../adm_clientes/ver_clientes.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-clipboard2-fill"></i>
                    </span>
                    <span class="descricao">Ver Clientes</span>
                </a>
                <a href="../adm_clientes/add_cliente.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-clipboard2-plus-fill"></i>
                    </span>
                    <span class="descricao">Criar Cliente</span>
                </a>             
            </div>

            <!-- Menu Avisos  -->
            <a href="#" class="nav-link">
                <span class="icon">
                    <i class="bi bi-bell-fill"></i>
                </span>
                <span class="descricao">Avisos</span>
            </a>

            <!-- Menu Usuarios  -->
            <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#usuarios" aria-expanded="false" aria-controls="usuarios">
                <span class="icon">
                    <i class="bi bi-people-fill"></i>
                </span>
                <span class="descricao">Usuários <i class="bi bi-caret-down-fill"></i></span>
            </a>
            <div class="sub-menu collapse" id="usuarios">
                <a href="../adm_usuarios/ver_usuarios.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-person-down"></i>
                    </span>
                    <span class="descricao">Ver Usuários</span>
                </a>
                <a href="../adm_usuarios/add_usuario.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-person-add"></i>
                    </span>
                    <span class="descricao">Criar Usuário</span>
                </a>
                <a href="../adm_usuarios/edit_usuario.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-person-gear"></i>
                    </span>
                    <span class="descricao">Editar Usuário</span>
                </a>   
                <a href="../adm_usuarios/exc_usuario.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-person-dash"></i>
                    </span>
                    <span class="descricao">Excluir Usuário</span>
                </a>                
            </div>

            <!-- Menu Dashboard  -->
                <a href="../adm_configuracoes/configuracoes.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-gear-fill"></i>
                    </span>
                    <span class="descricao">Configurações</span>
                </a>            
        </nav>
    </div>

    
    <main class="principal">    