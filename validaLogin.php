<?php


/* verifica se não esta logado */
if (!isset($_SESSION['logado'])) {

    require './logoff.php';
}
