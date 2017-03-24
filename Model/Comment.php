<?php

class Comment{
    
    private $id, $userId, $tweetId, $creationDate, $text;
    
    public function __construct() {
        $this->id = -1;
        $this->setUserId('');
        $this->setTweetId('');
        $this->setCreationDate('');
        $this->setText('');
    }
        
    
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getTweetId() {
        return $this->tweetId;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getText() {
        return $this->text;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setTweetId($tweetId) {
        $this->tweetId = $tweetId;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setText($text) {
        $this->text = $text;
    }

    static public function loadCommentsById(PDO $conn, $id){
        
        if ($id){
            
            $sql = 'Select * From `Comment` Where `id`= :id;';
            
            try{
                $query = $conn->prepare($sql);
                $result = $query->execute(['id' => $id]);
                
                if ($result && $query->rowCount() > 0){
                $row = $query->fetch();
                
                $loadedCom = new Comment();
                $loadedCom->id = $row['id'];
                $loadedCom->userId = $row['userId'];
                $loadedCom->tweetId = $row['tweetId'];
                $loadedCom->creationDate = $row['creationDate'];
                $loadedCom->text = $row['text'];
                
                return $loadedCom;
                }
                
            }catch (PDOException $ex){
                echo $ex->getMessage();
            }
        }
        
        return null;
    }
    
    static public function loadAllCommentsByTweetId(PDO $conn, $tweetId){
        
        $sql = 'Select * From `Comment` Where `tweetId` = :tweetId Order By `creationDate` Desc;';
        $commArr = [];
        
        try{
            $query = $conn->prepare($sql);
            $result = $query->execute(['tweetId' => $tweetId]);
            
            if ($result && $query->rowCount() > 0){
            $allComms = $query->fetchAll();
            
                foreach ($allComms as $comm){
                    $loadedComm = new Comment();
                    $loadedComm->id = $comm['id'];
                    $loadedComm->userId = $comm['userId'];
                    $loadedComm->tweetId = $comm['tweetId'];
                    $loadedComm->creationDate = $comm['creationDate'];
                    $loadedComm->text = $comm['text'];
                    
                    $commArr[] = $loadedComm;
                }
                return $commArr;
            }
            
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
        return null;
    }
    
    public function saveToDB(PDO $conn){
        if ($this->getId() == -1){
            
            $sql = 'INSERT INTO `Comment` VALUES (NULL, :userId, :tweetId, :creationDate, :text);';
            
            $sqlParams = [
                        'userId'=> $this->getUserId(),
                        'tweetId' => $this->getTweetId(),
                        'creationDate'=> $this->getCreationDate(),
                        'text'=> $this->getText()
                        ];
            
        } else {
            
            $sql = 'UPDATE `Comment` SET '
                    . '`text` = :text, '
                    . '`creationDate` = :creationDate,'
                    . 'WHERE `id` = :id;';
            
            $sqlParams = [
                        'id' => $this->id,
                        'text' => $this->getText(),
                        'creationDate' => $this->getCreationDate()
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
            
            $sql = 'Delete From `Comment` Where `id` = :id;';
            
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