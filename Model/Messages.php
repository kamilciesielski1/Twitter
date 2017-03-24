<?php

class Messages{
    
    private $id, $senderId, $receiverId, $creationDate, $status, $text;
    
    public function __construct() {
        $this->id = -1;
        $this->setSenderId('');
        $this->setReceiverId('');
        $this->setCreationDate('');
        $this->setStatus('');
        $this->setText('');
    }
    
    public function getId() {
        return $this->id;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function getReceiverId() {
        return $this->receiverId;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getText() {
        return $this->text;
    }

    public function setSenderId($senderId) {
        $this->senderId = $senderId;
    }

    public function setReceiverId($receiverId) {
        $this->receiverId = $receiverId;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setText($text) {
        $this->text = $text;
    }

    
    static public function loadMessageById(PDO $conn, $id){
        
        if ($id){
            
            $sql = 'Select * From `Messages` Where `id`= :id;';
            
            try{
                $query = $conn->prepare($sql);
                $result = $query->execute(['id' => $id]);
                
                if ($result && $query->rowCount() > 0){
                $row = $query->fetch();
                
                $loadedMes = new Messages();
                $loadedMes->id = $row['id'];
                $loadedMes->senderId = $row['senderId'];
                $loadedMes->receiverId = $row['receiverId'];
                $loadedMes->creationDate = $row['creationDate'];
                $loadedMes->status = $row['status'];
                $loadedMes->text = $row['text'];
                
                return $loadedMes;
                }
                
            }catch (PDOException $ex){
                echo $ex->getMessage();
            }
        }
        
        return null;
    }
    
    static public function loadAllMessagesBySenderId(PDO $conn, $senderId){
        
        $sql = 'Select * From `Messages` Where `senderId` = :senderId Order By `creationDate` Desc;';
        $messArr = [];
        
        try{
            $query = $conn->prepare($sql);
            $result = $query->execute(['senderId' => $senderId]);
            
            if ($result && $query->rowCount() > 0){
            $allMessages = $query->fetchAll();
            
                foreach ($allMessages as $mess){
                    $loadedMess = new Messages();
                    $loadedMess->id = $mess['id'];
                    $loadedMess->senderId = $mess['senderId'];
                    $loadedMess->receiverId = $mess['receiverId'];
                    $loadedMess->creationDate = $mess['creationDate'];
                    $loadedMess->status = $mess['status'];
                    $loadedMess->text = $mess['text'];
                    
                    $messArr[] = $loadedMess;
                }
                return $messArr;
            }
            
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
        return null;
    }
    
    
    
    static public function loadAllMessagesByReceiverId(PDO $conn, $receiverId){
        
        $sql = 'Select * From `Messages` Where `receiverId` = :receiverId Order By `creationDate` Desc;';
        $messArr = [];
        
        try{
            $query = $conn->prepare($sql);
            $result = $query->execute(['receiverId' => $receiverId]);
            
            if ($result && $query->rowCount() > 0){
            $allMessages = $query->fetchAll();
            
                foreach ($allMessages as $mess){
                    $loadedMess = new Messages();
                    $loadedMess->id = $mess['id'];
                    $loadedMess->senderId = $mess['senderId'];
                    $loadedMess->receiverId = $mess['receiverId'];
                    $loadedMess->creationDate = $mess['creationDate'];
                    $loadedMess->status = $mess['status'];
                    $loadedMess->text = $mess['text'];
                    
                    $messArr[] = $loadedMess;
                }
                return $messArr;
            }
            
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
        return null;
    }
    
    static public function loadAllMessagesByStatus0(PDO $conn, $receiverId){
        
        $sql = 'Select * From `Messages` Where `receiverId` = :receiverId And `status` = 0 Order By `creationDate` Desc;';
        $messArr = [];
        
        try{
            $query = $conn->prepare($sql);
            $result = $query->execute(['receiverId' => $receiverId]);
            
            if ($result && $query->rowCount() > 0){
            $allMessages = $query->fetchAll();
            
                foreach ($allMessages as $mess){
                    $loadedMess = new Messages();
                    $loadedMess->id = $mess['id'];
                    $loadedMess->senderId = $mess['senderId'];
                    $loadedMess->receiverId = $mess['receiverId'];
                    $loadedMess->creationDate = $mess['creationDate'];
                    $loadedMess->status = $mess['status'];
                    $loadedMess->text = $mess['text'];
                    
                    $messArr[] = $loadedMess;
                }
                return $messArr;
            }
            
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
        return null;
    }
    
    static public function loadAllMessagesByStatus1(PDO $conn, $receiverId){
        
        $sql = 'Select * From `Messages` Where `receiverId` = :receiverId And `status` = 1 Order By `creationDate` Desc;';
        $messArr = [];
        
        try{
            $query = $conn->prepare($sql);
            $result = $query->execute(['receiverId' => $receiverId]);
            
            if ($result && $query->rowCount() > 0){
            $allMessages = $query->fetchAll();
            
                foreach ($allMessages as $mess){
                    $loadedMess = new Messages();
                    $loadedMess->id = $mess['id'];
                    $loadedMess->senderId = $mess['senderId'];
                    $loadedMess->receiverId = $mess['receiverId'];
                    $loadedMess->creationDate = $mess['creationDate'];
                    $loadedMess->status = $mess['status'];
                    $loadedMess->text = $mess['text'];
                    
                    $messArr[] = $loadedMess;
                }
                return $messArr;
            }
            
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
        return null;
    }
    
    public function saveToDB(PDO $conn){
        if ($this->getId() == -1){
            
            $sql = 'INSERT INTO `Messages` VALUES (NULL, :senderId, :receiverId, :creationDate, :status, :text);';
            
            $sqlParams = [
                        'senderId'=> $this->getSenderId(),
                        'receiverId' => $this->getReceiverId(),
                        'creationDate'=> $this->getCreationDate(),
                        'status' => $this->getStatus(),
                        'text'=> $this->getText()
                        ];
            
        } else {
            
            $sql = 'UPDATE `Messages` SET '
                    . '`senderId`=:senderId,'
                    . '`receiverId`=:receiverId,'
                    . '`creationDate`=:creationDate,'
                    . '`status`=:status,'
                    . '`text`=:text '
                    . 'WHERE `id`=:id;';
            
            $sqlParams = [
                        'id' => $this->getId(),
                        'senderId' => $this->getSenderId(),
                        'receiverId' => $this->getReceiverId(),
                        'text' => $this->getText(),
                        'creationDate' => $this->getCreationDate(),
                        'status' => $this->getStatus()
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
    
    public function delete(PDO $conn){
        
        if ($this->id != -1){
            
            $sql = 'Delete From `Messages` Where `id` = :id;';
            
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
