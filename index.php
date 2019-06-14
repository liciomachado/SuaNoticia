<?php include 'cabecalho.php'; ?>

<!--CONTAINER NOTICIAS E AVISOS-->
<div class="container">
    <div class="row">
        <br>
        <!--DIV NOTICIAS-->
        <div class="col-md-9">
            <br>
            <h1>Ultimas Notícias</h1> 
            <br>
            <div class="row">
                <!--PUXA O ARRAY DE NOTICIAS-->
                <?php
                if (isset($_SESSION['logado']) && $_SESSION['tipoConta'] == 'nivel1') {
                    $rsNoticia = $pdo->prepare("SELECT * from tb_noticia order by id_noticia DESC");
                } else {
                    $rsNoticia = $pdo->prepare("SELECT * FROM tb_noticia WHERE (data_entra <= CURRENT_DATE AND data_sai > CURRENT_DATE) order by id_noticia desc LIMIT 5");
                }

                if ($rsNoticia->execute()) {
                    if ($rsNoticia->rowCount() > 0) {
                        while ($mostraNoticia = $rsNoticia->fetch(PDO::FETCH_OBJ)) {
                            echo "<div class='col-6' >";
                            echo "<div class='card-body'>";
                           echo "<h4><a href='detalheNoticia.php?idNoticia={$mostraNoticia->id_noticia}' class='' >{$mostraNoticia->titulo_noticia}</a></h4>";
                            echo "<p class='card-text'>{$mostraNoticia->resumo_noticia}</p>";
                            echo "<p class='dataAdireita'>";
                            echo date_format(new DateTime($mostraNoticia->data_noticia), 'd/m/Y');
                            echo "</p>";
                            
                            echo "<br>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                }
                ?>
                <!--FIM ARRAY NOTICIAS-->

            </div>
        </div>
        <!--FIM DIV NOTICIAS-->

        <!--DIV AVISOS-->
        <div class="col-md-3">
            <br>
            <h2>Avisos</h2>
            <br>
            <!--PUXA O ARRAY DE AVISOS-->

            <div id="whatever-gallery">
                <?php
                if (isset($_SESSION['logado']) && $_SESSION['tipoConta'] == 'nivel1') {
                    $rs2 = $pdo->prepare("SELECT * from tb_avisos order by id_avisos DESC");
                } else {
                    $rs2 = $pdo->prepare("SELECT * FROM tb_avisos WHERE (data_entrada <= CURRENT_DATE AND data_saida >= CURRENT_DATE)");
                }

                if ($rs2->execute()) {
                    if ($rs2->rowCount() > 0) {
                        while ($mostraAvisos = $rs2->fetch(PDO::FETCH_OBJ)) {
                            echo "<div>";
                            echo "<p class='textoJustificado'>{$mostraAvisos->aviso}</p>";
                            echo "<p class='dataAdireita'> {$mostraAvisos->Criador_Aviso}</p>";
                            if (isset($_SESSION['logado'])) {
                                if ($_SESSION['tipoConta'] == 'nivel1' || $_SESSION['tipoConta'] == 'nivel3') {

                                    echo '<form action="gerenciamentoAviso.php" method="POST">';
                                    echo "<input type='hidden' name='idAviso' value='{$mostraAvisos->id_avisos}'>";
                                    echo"<button class='btn btn-warning oculto' type='submit' name='editaAviso'><i class='fas fa-edit'></i>Alterar</button>";
                                    echo '</form>';
                                    echo '<form action="db/acoes.php" method="POST">';
                                    echo "<input type='hidden' name='idAviso' value='{$mostraAvisos->id_avisos}'>";
                                    echo"<button class='btn btn-dark oculto' type='submit' name='deletaAviso'><i class='fas fa-edit'></i>Deletar</button>";
                                    echo '</form>';
                                }
                            }
                            echo "</div>";
                        }
                    }
                }
                ?>
            </div>
            <!--FIM ARRAY AVISOS-->
        </div>
        <!--FIM DIV AVISOS-->
    </div>
</div>
<!--FIM CONTAINER NOTICIAS E AVISOS-->
<?php include 'rodape.php'; ?>
