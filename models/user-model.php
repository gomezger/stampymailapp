<?php

class UserModel extends Model implements IModel
{
    private string $id, $username, $password, $name = '';


    public function ___construct(){
        parent::__construct();
    }

    // actions
    public function insert(): bool{
        try{
            $query = $this->prepare('INSERT INTO users (username,password,name) VALUES (:username, :password, :name)');
            $query->execute([
                'username' => $this->username,
                'password' => $this->password,
                'name' => $this->name
            ]);

            return true;
        }catch(PDOException $e){
            error_log('USERMODEL::save->PDOException '. $e);
            return false;
        }
    }
    public function find($id): UserModel{
        try{
            $query = $this->prepare('SELECT * FROM users WHERE id = :id');
            $query->execute([ 'id' => $id ]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $this->set([
                "id" => $id,
                "username" => $user['username'],
                "password" => $user['password'],
                "name" => $user['name'],
            ]);
            return $this;
        }catch(PDOException $e) {
            error_log('USERMODEL::find->PDOException '. $e);
            return null;
        }
    }
    public function all(): array {
        try{
            $query = $this->query('SELECT * FROM users');
            $items = [];
            while($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new UserModel();
                $item->set([
                    "id" => $p['id'],
                    "username" => $p['username'],
                    "password" => $p['password'],
                    "name" => $p['name'],
                ]);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e) {
            error_log('USERMODEL::all->PDOException '. $e);
            return [];
        }
    }
    public function update(): bool {
        try{
            $query = $this->prepare('UPDATE users SET username = :username, password = :password, name = :name WHERE id= :id');
            $query->execute([ 
                'id' => $this->id,
                "username" => $this->username,
                "password" => $this->password,
                "name" => $this->name,
            ]);
            return true;
        }catch(PDOException $e) {
            error_log('USERMODEL::find->PDOException '. $e);
            return false;
        }
    }
    public function delete($id): bool{
        try {
            $query = $this->prepare('DELETE FROM users WHERE id= :id');
            $query->execute([ 'id' => $id ]);
            return true;
        }catch(PDOException $e) {
            error_log('USERMODEL::delete->PDOException '. $e);
            return false;
        }
    }
    public function set(array $array, bool $password = false): void {
        foreach($array as $key => &$val) {
            $this->{$key} = ($key==='password' && $password) 
                ? $this->getHashedPassword($val)
                : $val; 
        }
    }

    public function exists(string $username): bool {        
        try {
            $query = $this->prepare('SELECT username FROM users WHERE username= :username');
            $query->execute([ 'username' => $username ]);
            return $query->rowCount() > 0;
        }catch(PDOException $e) {
            error_log('USERMODEL::exists->PDOException '. $e);
            return false;
        }
    }
    
    public function passwordVerify(string $password, $id): bool {        
        try {
            $user = $this->find($id);
            return password_verify($password, $user->getPassword());
        }catch(PDOException $e) {
            error_log('USERMODEL::exists->PDOException '. $e);
            return false;
        }
    }

    private function getHashedPassword(string $password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // getters
    public function getID() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }
    public function getName() { return $this->name; }

    // setters
    public function setID($id) { $this->id = $id; }
    public function setUsername($username) { $this->username = $username; }
    public function setName($name) { $this->name = $name; }
    public function setPassword($password) { 
        $this->password =  $this->getHashedPassword($password); 
    }

}
