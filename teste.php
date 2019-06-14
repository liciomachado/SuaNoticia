<form class="form-group needs-validation justify-content-center" action="db/acoes.php" method="post">
            <h2>Registrar novo usuario</h2
            <div class="form-row">
                <div class="form-group col-md-12">
                    <p>Usuario</p>
                    <input type="text" class="form-control" name="usuario" placeholder="Insira seu nome de usuario" required="">

                    <p>Nome de Perfil</p>
                    <input type="text" class="form-control" name="nome" placeholder="Insira seu nome completo" required="">

                    <p>Senha</p>
                    <input type="password" class="form-control" name="senha" placeholder="Insira sua senha" required="">

                    <p>Tipo de Conta</p>
                    <select type="select" class="form-control" name="tipo" placeholder="Tipo de conta" required="">
                        <option value="nivel1">Administrador</option>
                        <option value="nivel2">Gerenciador de Noticias</option>
                        <option value="nivel3">Gerenciador de Avisos</option>
                    </select>

                    <button type="submit" class="btn btn-warning mb-2" id="botao" name="cadatrarUsuario" class="btn">Cadastrar Usuario</button>
                </div>
            </div>
</form>