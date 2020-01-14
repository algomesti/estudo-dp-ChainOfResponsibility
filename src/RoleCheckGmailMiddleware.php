<?php

namespace CoR;

class RoleCheckGmailMiddleware extends Middleware
{
    public function check(string $email, string $password): bool
    {
        $array_email = explode("@", $email);
        if (2 === count($array_email) && 'gmail.com' === $array_email[1]) {
            echo "RoleCheckGmailMiddleware: Hello, GMAIL USER!\n";
            return true;
        }
        return parent::check($email, $password);
    }
}
