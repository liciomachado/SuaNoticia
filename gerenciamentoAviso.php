<?php
include './cabecalho.php';
include './validaLogin.php';

if ($_SESSION['tipoConta'] == 'nivel2') {
    header('location:index.php');
}

if (isset($_POST['editaAviso'])) {

    $aviso = array(':idAviso' => $_POST['idAviso']);
    $idAviso = $_POST['idAviso'];
    
    $rs = $pdo->prepare("SELECT * from tb_avisos WHERE id_avisos = :idAviso ");
    $rs->execute($aviso);
    $mostraAviso = $rs->fetch(PDO::FETCH_OBJ);
    $dataFormatadaEntrada = date('Y-m-d\TH:i', strtotime($mostraAviso->data_entrada));
    $dataFormatadaSaida = date('Y-m-d\TH:i', strtotime($mostraAviso->data_saida));
}
?>

<div class="container">
    <div class="row formulario">
        <div class="col-md-12">
            <?php
            if (isset($_POST['editaAviso'])) {
                echo '<div class = "display-4">Alterar Aviso</div>';
            } else {
                echo '<div class = "display-4">Inserir Aviso</div>';
            }
            ?>
        </div>
    </div>   
    <div class="row cadastro">
        <div class="col-md-12">
            <form class="form-group needs-validation justify-content-center" method="post" action="db/acoes.php" novalidate>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputDesc">Aviso</label>
                        <textarea class="form-control" id="inputDesc" rows="2" name="aviso" placeholder="Noticia completa" required><?php
                            if (isset($_POST['editaAviso'])) {
                                echo $mostraAviso->aviso;
                            }
                            ?>
                        </textarea>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPreco">Disponivel de:</label>
                        <input type="datetime-local" class="form-control"  name="dataEntrada" required 
                               value="<?php echo $dataFormatadaEntrada ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Até:</label>
                        <input type="datetime-local" class="form-control" name="dataSaida" required 
                               value="<?php
                            if (isset($_POST['editaAviso'])) {
                                echo $dataFormatadaSaida;
                            }
                            ?>">
                    </div>

                </div>
                <div id="botao">
                    <?php
                    if (isset($_POST['editaAviso'])) {
                        echo "<input type='hidden' name='idAviso' value='$idAviso'>";
                        echo '<button type="submit" class="btn btn-warning mb-2" id="botao" name="alteraAviso" class="btn">Atualizar</button>';
                    } else {
                        echo '<button type="submit" class="btn btn-warning mb-2" id="botao" name="salvaAviso" class="btn">Salvar</button>';
                    }
                    ?>                
                </div>   
            </form>
        </div>
    </div>
</div>
<?php
include './rodape.php';
?>