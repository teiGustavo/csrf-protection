<?php

require __DIR__ . '/../vendor/autoload.php';

use Gteixeira\CsrfProtection\Csrf;

session_start();

Csrf::create();
Csrf::check();
?>

<form action="" method="post">
    <?= Csrf::csrf(); ?>
    
    <label for="nome">Nome: </label>
    <input type="text" name="nome" id="nome" required>

    <button type="submit">Enviar</button>
</form>