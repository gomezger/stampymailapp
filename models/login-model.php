<?php

include_once 'user-model.php';

class LoginModel extends Model
{

    public function ___construct()
    {
        parent::__construct();
    }

    public function login(string $username, string $password)
    {
        try {
            $query = $this->prepare('SELECT * FROM users WHERE username = :username');
            $query->execute(['username' => $username]);


            if ($query->rowCount() == 1) {
                $item = $query->fetch(PDO::FETCH_ASSOC);

                $user = new UserModel();
                $user->set($item);
    
                return $user->passwordVerify($password, $user->getID()) ? $user : null;
            }

            return null;

        } catch (PDOException $e) {
            error_log('LoginModel::login->exception ' . $e);
            return null;
        }
    }
}
