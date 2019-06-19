<?php include './db/conectaBanco.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1">-->
        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap/css/estilos.css">
        <link rel="stylesheet" href="css/style.css">
        <title>SuaNoticia.com</title>
        <link rel="shortcut icon" href="img/iconEmpresa.png" />

    </head>
    <body onload="carregaUser('modoUser','modoAdm')">
        <!--PUXA DADOS EMPRESA-->
        <?php
        session_start();
        $rs = $pdo->prepare("SELECT * from tb_empresa WHERE id_empresa = 1");
        $rs->execute();
        $mostraEmpresa = $rs->fetch(PDO::FETCH_OBJ);
        ?>
            
        <!--        CABEÇALHO-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between ">
            <a class="navbar-brand" href="index.php">
                <?php
                echo "<img src='img/iconEmpresa.png' width='30' height='30' class='d-inline-block align-top'>";
                //echo "<img src='{$mostraEmpresa->logo}' width='30' height='30' class='d-inline-block align-top'>";
                echo "{$mostraEmpresa->nome_empresa}";
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">
                            <?php
                            echo "{$mostraEmpresa->telefone}";
                            ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">
                            <?php
                            echo "{$mostraEmpresa->email}";
                            ?></a>

                    </li>

                </ul>
                <?php
                if (!isset($_SESSION['logado'])) {
                    echo('<form class="form-inline" action="login.html">
                            <button class="btn btn-outline-success" type="submit">Logar-se</button>
                         </form>');
                } else {
                    ?>
                    <ul class="nav nav-pills">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                <img src="img/user.png" width="30" height="30" class="d-inline-block align-top" alt="">
                            <!--IMAGEM COM ERRO--> 
                          <!--<?php //echo "<img src='{$mostraEmpresa->logo}' width='30' height='30' class='d-inline-block align-top'>";?>-->
                                <?php echo $_SESSION['nomeUser']; ?></a>
                            <div class="dropdown-menu">
                                <?php
                                if ($_SESSION['tipoConta'] == 'nivel1') {
                                    echo '<a class="dropdown-item" href="gerenciamentoSite.php">Configurações do site</a>';
                                }
                                if ($_SESSION['tipoConta'] == 'nivel1' || $_SESSION['tipoConta'] == 'nivel2') {
                                    echo '<a class="dropdown-item" href="gerenciamentoNoticia.php">Gerenciar Noticias</a>';
                                }
                                if ($_SESSION['tipoConta'] == 'nivel1' || $_SESSION['tipoConta'] == 'nivel3') {
                                    echo '<a class="dropdown-item" href="gerenciamentoAviso.php">Gerenciar Avisos</a>';
                                }
                                ?>
                            </div>
                        </li>
                        <?php
                        echo('<form class="form-inline" action="logoff.php">
                            <button class="btn btn-secondary" type="submit">Sair</button>
                         </form>');
                    }
                    ?>
                </ul>
            </div>
        </nav>
        <!--FIM CABEÇALHO-->