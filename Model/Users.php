<?php

class Users{
    private $id, $username, $email, $password;
    
    public function __construct() {
        $this->id = -1;
        $this->setUsername('');
        $this->setEmail('');
        $this->setPassword('');
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    

    public function setPassword($password) {
        if(!empty($password) && strlen($password) >= 8 && strlen($password) <= 20){
            
                $options = [ 
                            'cost' => 11 
                          ];
                $newPass = password_hash($password, PASSWORD_BCRYPT, $options);
                
                $this->password = $newPass;
        }else{
            $this->password=false;
        }
        return $this;
    }
            

    public function saveToDB(PDO $conn){
        if ($this->getId() == -1){
            
            $sql = 'INSERT INTO `Users` VALUES (NULL, :username, :email, :password);';
            
            $sqlParams = [
                        'username'=> $this->getUsername(),
                        'email'=> $this->getEmail(),
                        'password'=> $this->getPassword()
                        ];
            
        } else {
            
            $sql = 'UPDATE `Users` SET '
                    . '`username` = :username, '
                    . '`email` = :email, '
                    . '`password` = :password '
                    . 'WHERE `id` = :id;';
            
            $sqlParams = [
                        'id' => $this->id,
                        'username' => $this->getUsername(),
                        'email' => $this->getEmail(),
                        'password' => $this->getPassword(),
                        ];
        }
        
        try{
            $query = $conn->prepare($sql);
            $result = $query->execute($sqlParams);
            
            if ($this->getId() == -1){
              
                $this->id = $conn->lastInsertId();
                
                } 
                
            return $result;
            
        } catch (PDOException $ex){
            echo $ex->getMessage();
        }
        
    }
    
    static public function loadUserById(PDO $conn, $id){
        
        if ($id){
            
            $sql = 'Select * From `Users` Where `id`= :id;';
            
            try{
                $query = $conn->prepare($sql);
                $result = $query->execute(['id' => $id]);
                
                if ($result && $query->rowCount() > 0){
                $row = $query->fetch();
                
                $loadedUser = new Users();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->email = $row['email'];
                $loadedUser->password = $row['password'];
                
                return $loadedUser;
                }
                
            }catch (PDOException $ex){
                echo $ex->getMessage();
            }
        }
        
        return null;
    }
    
    static public function loadAllUsers(PDO $conn){
        
        $sql = 'Select * From `Users`;';
        $usersArr = [];
        
        try{
            $query = $conn->prepare($sql);
            $result = $query->execute();
            
            if ($result && $query->rowCount() > 0){
            $allUsers = $query->fetchAll();
            
                foreach ($allUsers as $user){
                    $loadedUser = new Users();
                    $loadedUser->id = $user['id'];
                    $loadedUser->username = $user['username'];
                    $loadedUser->email = $user['email'];
                    $loadedUser->password = $user['password'];
                    
                    $usersArr[] = $loadedUser;
                }
                return $usersArr;
            }
            
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
        return null;
    }
    
    public function delete(PDO $conn){
        
        if ($this->id != -1){
            
            $sql = 'Delete From `Users` Where `id` = :id;';
            
            try{
                $query = $conn->prepare($sql);
                $result = $query->execute(['id' => $this->id]);
                
                if ($result) {
                    $this->id = -1;
                } else {
                    return false;
                }
                
            }catch (PDOException $ex){
                echo $ex->getMessage();
            }
        }
        return true;
    }
}
            
