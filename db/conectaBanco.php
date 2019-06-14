<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_noticiario', 'root', '', []);
} catch (PDOException $e) {
    echo '<br><br><br>Erro ao conectar com o MySQL!!!<br><br>' . $e->getMessage();
    exit();
}
?>
