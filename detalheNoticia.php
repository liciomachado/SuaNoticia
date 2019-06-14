<?php include 'cabecalho.php'; ?>
<div class="container">
    <br>
    <?php
    $noticia = array(':idNoticia' => $_GET['idNoticia']);

    $rs = $pdo->prepare("SELECT * from tb_noticia WHERE id_noticia = :idNoticia ");
    $rs->execute($noticia);
    $mostraNoticia = $rs->fetch(PDO::FETCH_OBJ);

    echo "<h1>{$mostraNoticia->titulo_noticia}</h1>";

    echo "<p>{$mostraNoticia->noticia}</p>";
    
    echo "<img src='{$mostraNoticia->img_noticia}' width='200' height='220'>";
    
    echo "<p>Escrito por {$mostraNoticia->Criador_Noticia} em {$mostraNoticia->data_noticia} </p>";

    if (isset($_SESSION['logado'])) {
        if ($_SESSION['tipoConta'] == 'nivel1' || $_SESSION['tipoConta'] == 'nivel2') {
            echo '<div class="btn-group">';
            echo "<td><form action='gerenciamentoNoticia.php' method='post' name='detalhes{$mostraNoticia->id_noticia }'>
            
            <input type='hidden' name='idNoticia' value='{$mostraNoticia->id_noticia}'>";

            echo"<button class='btn btn-warning' type='submit' name='editaNoticia'><i class='fas fa-edit'></i>Alterar</button>";
            echo"</form>";
            echo "<form action='db/acoes.php' method='post' name='detalhes{$mostraNoticia->id_noticia}'>
            <input type='hidden' name='idNoticia' value='{$mostraNoticia->id_noticia}'>";
            echo"<button class='btn btn-dark fas fa-edit' type='submit' name='deleteNoticia'>Deletar</button>";
            echo"</form></td>";
            echo "</div>";
        }
    }
    ?>

</div>
<?php include 'rodape.php'; ?>