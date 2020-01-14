<?php

namespace CoR;

class RoleCheckMiddleware extends Middleware
{
    public function check(string $email, string $password): bool
    {
        if ($email === "admin@example.com") {
            echo "RoleCheckMiddleware: Hello, admin!\n";
        } else {
            echo "RoleCheckMiddleware: Hello, user!\n";
        }
        return parent::check($email, $password);
    }
}
