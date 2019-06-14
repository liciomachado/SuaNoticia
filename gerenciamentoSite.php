<?php
include 'cabecalho.php';
include 'validaLogin.php';

$id = '';
$login = '';
$nome = '';
$senha = '';
$tipoConta = '';

if ($_SESSION['tipoConta'] != 'nivel1') {
    header('location:index.php');
}

if (isset($_POST['editaUsuario'])) {
    $filtro = array(':auxId' => $_POST['idUsuario']);
      $rs = $pdo->prepare("SELECT id_usuario,login,nome,senha,tipo_conta FROM tb_usuario WHERE id_usuario LIKE :auxId");
      if ($rs->execute($filtro)) {
        if ($rs->rowCount() > 0) {
          while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
          $id = $row->id_usuario;
          $nome = $row->nome;
          $login = $row->login;
          $senha = $row->senha;
          $tipoConta = $row->tipo_conta;
          }
        }
      }
}

?>

<div class="container">
    <div class="col-md-12">
        <div class="display-4">
            Gerenciamento do Site
        </div>
        <br>

    </div>
    <!--TABELA DE USUARIOS EXISTENTES-->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">login</th>
          <th scope="col">Nome:</th>
          <th scope="col">Tipo de Conta:</th>
          <th scope="col">Açoes</button></th>
        </tr>
      </thead>
      
      <tbody> <?php
        $rs = $pdo->prepare("SELECT * from tb_usuario");
        if ($rs->execute()) {
          if ($rs->rowCount() > 0) {
            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
              echo "<tr>";
              echo "<th scope='row'>{$row->id_usuario}</td>";
              echo "<td>{$row->login}</td>";
              echo "<td>{$row->nome}</td>";
              echo "<td>{$row->tipo_conta}</td>";

              echo "<td><form action='db/acoes.php' method='POST' name='delCliente{$row->id_usuario}'>
              <input type='hidden' name='idUsuario' value='{$row->id_usuario}'>
              <button class='btn btn-danger' type='submit' name='deletaUsuario'><i class='fas fa-edit'></i>Deletar</button>
              </form></td>";

              echo "<td><form action='gerenciamentoSite.php' method='POST' name='editCliente{$row->id_usuario}'>
              <input type='hidden' name='idUsuario' value='{$row->id_usuario}'>
              <button class='btn btn-secondary' type='submit' name='editaUsuario'>Alterar</button>
              </form></td>";
              echo "</tr>";
            }
          } 
        }

        echo "</tbody>";
        ?>  
      
    </table>
    <!--CRIAR NOVO USUARIO--> 
    <div class="row cadastro">
        <div class="col-md-12">
            <form class="form-group needs-validation justify-content-center" action="db/acoes.php" method="post">
                <?php if($id != ''){
                    echo '<h2>Alterar usuario</h2>';
                }else {
                    echo '<h2>Registrar novo usuario</h2>';
                    echo $id;
                } 
                echo "<input type='hidden' name='idUsuario' value='{$id}'>";
                ?>
                
                <p>Usuario</p>
                <input type="text" class="form-control" name="usuario" value ="<?php echo $login ;?>" placeholder="Insira seu nome de usuario"  required="">

                <p>Nome de Perfil</p>
                <input type="text" class="form-control" name="nome"  value ="<?php echo $nome ;?>"placeholder="Insira seu nome completo" required="">

                <p>Senha</p>
                <input type="password" class="form-control" name="senha"  value ="<?php echo $senha ;?>"placeholder="Insira sua senha" required="">

                <p>Tipo de Conta</p>
                <select type="select" class="form-control" name="tipo" value ="<?php echo $tipoConta ;?>" placeholder="Tipo de conta" required="">
                    <option value="nivel1">Administrador</option>
                    <option value="nivel2">Gerenciador de Noticias</option>
                    <option value="nivel3">Gerenciador de Avisos</option>
                </select>
                <?php if($id != ''){
                    echo '<button type="submit" class="btn btn-warning mb-2" id="" name="alterarUsuario" class="btn">Confirmar alteração de usuario</button>';
                } else {
                    echo '<button type="submit" class="btn btn-warning mb-2" id="" name="cadatrarUsuario" class="btn">Cadastrar Usuario</button>';
                }?>
                
            </form>
        </div>
    </div>

    <!--EDITAR DADOS DA EMPRESA-->

    <?PHP
    $rs = $pdo->prepare("SELECT * from tb_empresa WHERE id_empresa = 1");
    $rs->execute();
    $mostraEmpresa = $rs->fetch(PDO::FETCH_OBJ);
    ?>

    <div class="col-md-12">
        <h2>Alterar Dados da empresa</h2>
        <form enctype="multipart/form-data" class="form-group needs-validation justify-content-center" action="db/acoes.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <p>Nome da Empresa</p>
                    <input type="text" class="form-control" name="nome" value="<?php echo $mostraEmpresa->nome_empresa ?>">
                    <p>Telefone para contato</p>
                    <input type="text" class="form-control" name="tel" value="<?php echo $mostraEmpresa->telefone ?>">
                    <p>Email</p>
                    <input type="text" class="form-control" name="email" value="<?php echo $mostraEmpresa->email ?>">
                    <p>Logo</p>
                    <?php echo "<img src='{$mostraEmpresa->logo}' width='30' height='30' class='d-inline-block align-top'>";?>
                    <input type="file" class="form-control" name="imagem" value="" required="">
                </div>
            </div>

            <button type="submit" class="btn btn-warning mb-2" id="botao" name="alteraEmpresa" class="btn">Alterar dados da empresa</button>

        </form>
    </div>
</div>


<?php include 'rodape.php' ?>