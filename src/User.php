<?php

namespace Occasion;
class User
{
    private string $email;
    private string $password;
    public static array $users = [];//Array waarin de users worden opgeslagen.

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        self::$users[] = $this;
    }

    public function getMail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
