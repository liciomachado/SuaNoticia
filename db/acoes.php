<?php

include './conectaBanco.php';

session_start();

//ACAO PARA SALVAR UMA NOVA NOTICIA
if (isset($_POST['salvaNoticia'])) {

    $encoded_image = "data:" . $_FILES['imagem']['type'] . ";base64," . base64_encode(file_get_contents($_FILES['imagem']['tmp_name']));

    $nova_noticia = array(
        ':titulo' => $_POST['titulo'],
        ':resumo' => $_POST['resumo'],
        ':noticia' => $_POST['noticia'],
        ':imagem' => $encoded_image,
        ':dataEntrada' => $_POST['dataEntrada'],
        ':dataSaida' => $_POST['dataSaida'],
        ':dataAgora' => date("Y-m-d H:i:s"),
        ':criadorNoticia' => $_SESSION['nomeUser']
    );
    $stmt = $pdo->prepare("INSERT INTO tb_noticia (titulo_noticia,resumo_noticia,noticia,img_noticia,data_entra,data_sai,data_noticia,Criador_Noticia)
        VALUES (:titulo,:resumo,:noticia,:imagem,:dataEntrada,:dataSaida,:dataAgora,:criadorNoticia)");
    $stmt->execute($nova_noticia);

    if ($stmt->rowCount() > 0) {
        header('location: ../index.php');
    } else {
        echo "<br><br><br>ERRO novo!!!!!";
    }
}
//ACAO PARA DELETAR NOTICIA
if (isset($_POST['deleteNoticia'])) {

    $deletaNoticia = array(':id' => $_POST['idNoticia']);

    $stmt = $pdo->prepare("DELETE FROM tb_noticia WHERE id_noticia = :id");
    $stmt->execute($deletaNoticia);

    if ($stmt->rowCount() > 0) {
        header('location: ../index.php');
    } else {
        echo "<br><br><br>ERRO novo!!!!!";
    }
}

//ALTERA UMA NOTICIA
if (isset($_POST['atualizaNoticia'])) {

    if(empty($_FILES["imagem"]["tmp_name"])) {
        $alteraNoticia = array(':id' => $_POST['idNoticia'],
        ':titulo' => $_POST['titulo'],
        ':resumo' => $_POST['resumo'],
        ':noticia' => $_POST['noticia'],
        ':dataEntrada' => $_POST['dataEntrada'],
        ':dataSaida' => $_POST['dataSaida']);
    $stmt = $pdo->prepare("UPDATE `tb_noticia` SET `titulo_noticia`= :titulo,"
            . "`resumo_noticia`=:resumo,"
            . "`noticia`=:noticia,"
            . "`data_entra`=:dataEntrada,"
            . "`data_sai`=:dataSaida "
            . " WHERE id_noticia = :id");
    $stmt->execute($alteraNoticia);
    }else {
        $encoded_image = "data:" . $_FILES['imagem']['type'] . ";base64," . base64_encode(file_get_contents($_FILES['imagem']['tmp_name']));

        $alteraNoticia = array(':id' => $_POST['idNoticia'],
        ':titulo' => $_POST['titulo'],
        ':resumo' => $_POST['resumo'],
        ':noticia' => $_POST['noticia'],
        ':imagem' => $encoded_image,
        ':dataEntrada' => $_POST['dataEntrada'],
        ':dataSaida' => $_POST['dataSaida']);
        $stmt = $pdo->prepare("UPDATE `tb_noticia` SET `titulo_noticia`= :titulo,"
            . "`resumo_noticia`=:resumo,"
            . "`noticia`=:noticia,"
            . "`img_noticia`=:imagem,"
            . "`data_entra`=:dataEntrada,"
            . "`data_sai`=:dataSaida "
            . " WHERE id_noticia = :id");
    $stmt->execute($alteraNoticia);
    }
        header('location: ../index.php');
    
}

//ACAO PARA SALVAR UM NOVO AVISO
if (isset($_POST['salvaAviso'])) {

    $pegaCriador = $_SESSION['nomeUser'];

    $novo_aviso = array(
        ':aviso' => $_POST['aviso'],
        ':dataEntrada' => $_POST['dataEntrada'],
        ':dataSaida' => $_POST['dataSaida'],
        ':dataAgora' => date("Y-m-d H:i:s"),
        ':criador' => $pegaCriador
    );
    $stmt = $pdo->prepare("INSERT INTO tb_avisos (aviso,data_entrada,data_saida,data_cadastro,Criador_Aviso)
        VALUES (:aviso,:dataEntrada,:dataSaida,:dataAgora,:criador)");
    $stmt->execute($novo_aviso);

    if ($stmt->rowCount() > 0) {
        header('location: ../index.php');
    } else {
        echo "<br><br><br>ERRO novo!!!!!";
    }
}
//DELETA UM AVISO
if (isset($_POST['deletaAviso'])) {

    $deletaAviso = array(':id' => $_POST['idAviso']);

    $stmt = $pdo->prepare("DELETE FROM tb_avisos WHERE id_avisos     = :id");
    $stmt->execute($deletaAviso);

    if ($stmt->rowCount() > 0) {
        header('location: ../index.php');
    } else {
        echo "<br><br><br>ERRO novo!!!!!";
    }
}

//ALTERA UM AVISO
if (isset($_POST['alteraAviso'])) {

    $alteraAviso = array(':id' => $_POST['idAviso'],
        ':aviso' => $_POST['aviso'],
        ':dataEntrada' => $_POST['dataEntrada'],
        ':dataSaida' => $_POST['dataSaida'],);

    $stmt = $pdo->prepare("UPDATE `tb_avisos` SET `aviso`= :aviso,`data_entrada`=:dataEntrada,`data_saida`=:dataSaida WHERE id_avisos = :id");
    $stmt->execute($alteraAviso);

    if ($stmt->rowCount() > 0) {
        header('location: ../index.php');
    } else {
        echo "<br><br><br>ERRO novo!!!!!";
    }
}

//CADASTRO DE USUARIOS
if (isset($_POST['cadatrarUsuario'])) {

    $novo_usuario = array(
        ':usuario' => $_POST['usuario'],
        ':nome' => $_POST['nome'],
        ':senha' => $_POST['senha'],
        ':tipo' => $_POST['tipo']
    );
    $stmt = $pdo->prepare("INSERT INTO tb_usuario (login,nome,senha,tipo_conta)
        VALUES (:usuario,:nome,:senha,:tipo)");
    $stmt->execute($novo_usuario);

    if ($stmt->rowCount() > 0) {
        header('location: ../index.php');
    } else {
        echo "<br><br><br>ERRO novo!!!!!";
    }
}
// ALTERA DADOS DA EMPRESA 
if (isset($_POST['alteraEmpresa'])) {

    $encoded_image = "data:" . $_FILES['imagem']['type'] . ";base64," . base64_encode(file_get_contents($_FILES['imagem']['tmp_name']));
    $alteraEmpresa = array(':id' => 1,
        ':nome' => $_POST['nome'],
        ':tel' => $_POST['tel'],
        ':email' => $_POST['email'],
        ':logo' => $encoded_image);

    if (empty($_FILES["imagem"]["tmp_name"])) {
        $stmt = $pdo->prepare("UPDATE `tb_empresa` SET `nome_empresa`= :nome,`telefone`=:tel,`email`=:email  WHERE id_empresa = :id");
    } else {
        $stmt = $pdo->prepare("UPDATE `tb_empresa` SET `nome_empresa`= :nome,`telefone`=:tel,`email`=:email,`logo`=:logo WHERE id_empresa = :id");
    }
    $stmt->execute($alteraEmpresa);

    if ($stmt->rowCount() > 0) {
        header('location: ../index.php');
    } else {
        echo "<br><br><br>ERRO novo!!!!!";
    }
}

//DELETA UM USUARIO
if (isset($_POST['deletaUsuario'])) {

    $deletaUsuario = array(':id' => $_POST['idUsuario']);

    $stmt = $pdo->prepare("DELETE FROM tb_usuario WHERE id_usuario = :id");
    $stmt->execute($deletaUsuario);

    if ($stmt->rowCount() > 0) {
        header('location: ../gerenciamentoSite.php');
    } else {
        echo "<br><br><br>ERRO novo!!!!!";
    }
}
//ALTERA UM USUARIO
if (isset($_POST['alterarUsuario'])) {

    $alteraUsuario = array(':id' => $_POST['idUsuario'],
        ':login' => $_POST['usuario'],
        ':nome' => $_POST['nome'],
        ':senha' => $_POST['senha'],
        ':tipoConta' => $_POST['tipo']);

    $stmt = $pdo->prepare("UPDATE `tb_usuario` SET `login`= :login,`nome`=:nome,`senha`=:senha,`tipo_conta`=:tipoConta WHERE id_usuario = :id");
    $stmt->execute($alteraUsuario);

    if ($stmt->rowCount() > 0) {
        header('location: ../gerenciamentoSite.php');
    } else {
        echo "<br><br><br>ERRO novo!!!!!";
    }
}
   
