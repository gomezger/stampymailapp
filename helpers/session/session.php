<?php

class Session
{
    private string $sessionName = '';

    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setCurrentUser(string $user): void{
        $_SESSION[$this->sessionName] = $user;
    }

    public function getCurrentUser(): string{
        return $_SESSION[$this->sessionName];
    }

    public function closeSession(): void {
        session_unset();
        session_destroy();
    }

    public function exists(): bool {
        return isset($_SESSION[$this->sessionName]);
    }
}
