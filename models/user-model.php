<?php

class UserModel extends Model implements IModel
{
    private string $id, $username, $password, $role, $name = '';


    public function ___construct(){
        parent::__construct();
    }

    // actions
    public function insert(): bool{
        try{
            $query = $this->prepare('INSERT INTO users (username,password,role,name) VALUES (:username, :password, :role, :name)');
            $query->execute([
                'username' => $this->username,
                'password' => $this->password,
                'role' => $this->role,
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
            $query = $this->prepare('SELECT * FROM users WHERE id= :id');
            $query->execute([ 'id' => $id ]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $this->set([
                "id" => $user['id'],
                "username" => $user['username'],
                "password" => $user['password'],
                "name" => $user['name'],
                "role" => $user['role'],
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
            while($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new UserModel();
                $item->set([
                    "id" => $p['id'],
                    "username" => $p['username'],
                    "password" => $p['password'],
                    "name" => $p['name'],
                    "role" => $p['role'],
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
            $query = $this->prepare('UPDATE users SET username = :username, password = :password, role = :role, name = :name WHERE id= :id');
            $query->execute([ 
                'id' => $this->id,
                "username" => $this->username,
                "password" => $this->password,
                "name" => $this->name,
                "role" => $this->role,
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
    public function set(array $array): void {
        foreach($array as $key => &$val) {
            $this->{$key} = ($key!=='password') ? $val : $this->getHashedPassword($val);
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

    // getters
    public function getID() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }
    public function getRole() { return $this->role; }
    public function getName() { return $this->name; }

    // setters
    public function setID($id) { $this->id = $id; }
    public function setUsername($username) { $this->username = $username; }
    public function setRole($role) { $this->role = $role; }
    public function setName($name) { $this->name = $name; }
    public function setPassword($password) { 
        $this->password =  $this->getHashedPassword($password); 
    }

    private function getHashedPassword(string $password) {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]); //a mayor costo, mas seguro pero mas procesamiento
    }
}
