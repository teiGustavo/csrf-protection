<?php

namespace Gteixeira\CsrfProtection;

class Csrf
{
    public static function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }
    }

    # Exemplo de função que deve ser criada para facilitar a reutilização em N formulários
    public static function csrf(): string
    {
        return "<input type='hidden' name='csrf' id='csrf' value='{$_SESSION['csrf']}'>";
    }

    public static function check(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return;
        }

        if (!isset($_POST['csrf'])) {
            throw new \Exception('CSRF token is not found');
        }

        if (!isset($_SESSION['csrf'])) {
            throw new \Exception('CSRF token is not found');
        }

        if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
            throw new \Exception('CSRF token is mismatch');
        }
    }
}
