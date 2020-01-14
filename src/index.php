<?php

namespace CoR;

require_once '../vendor/autoload.php';

use CoR\Server;
use CoR\ThrottlingMiddleware;
use CoR\UserExistsMiddleware;
use CoR\RoleCheckMiddleware;
use CoR\RoleCheckGmailMiddleware;

$server = new Server();
$server->register('admin@example.com', 'admin_pass');
$server->register('user@example.com', 'user_pass');

$middleware = new ThrottlingMiddleware(2);
$middleware
    ->linkWith(new UserExistsMiddleware($server))
    ->linkWith(new RoleCheckMiddleware)
    ->linkWith(new RoleCheckGmailMiddleware);

$server->setMiddleware($middleware);

do {
    menu($server);
} while (true);

function menu($server)
{
    echo "\n\n1. Registrar";
    echo "\n2. Logar";
    echo "\n3. Sair\n\n";
    $option = readline();
    switch ($option) {
        case "3":
            die("\n\nsaindo do sistema\n\n");
        case "1":
            register($server);
            break;
        case "2":
            logar($server);
            menu($server);
            break;
       default:
            break;
    }
}

function register($server)
{
    echo "\nEMAIL: \n";
    $email = readline();
    echo "PASSWORD: \n";
    $password = readline();
    $server->register($email, $password);
}

function logar($server)
{
    echo "\nEnter your email:\n";
    $email = readline();
    echo "Enter your password:\n";
    $password = readline();
    $success = $server->logIn($email, $password);
}
