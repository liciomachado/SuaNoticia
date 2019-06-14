<?php

include 'conectaBanco.php';

if (isset($_SESSION['logado'])) { //verifica se a sessão já não estava aberta e destrói a sessão
    $_SESSION = array();
    session_unset();
    session_destroy();
}

// resgata variáveis do formulário
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$password = isset($_POST['senha']) ? $_POST['senha'] : '';

//$passwordHash = sha1($password);

$sql = "SELECT * FROM tb_usuario WHERE login = :usuario AND senha = :password";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':password', $password);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) <= 0) {
    echo "Email ou senha incorretos";
    exit;
}

// pega o primeiro usuário
$user = $users[0];

session_start();
$_SESSION['logado'] = "LOGADO";
$_SESSION['user_id'] = $user['id_usuario'];
$_SESSION['nomeUser'] = $user['nome'];
$_SESSION['tipoConta'] = $user['tipo_conta'];

header('Location: ../index.php');
?>