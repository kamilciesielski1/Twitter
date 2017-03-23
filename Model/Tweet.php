<?php

class Tweet{
    
    private $id, $userId, $text, $creationDate;
    
    public function __construct() {
        $this->id = -1;
        $this->setUserId('');
        $this->setText('');
        $this->setCreationDate('');
    }
    
    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getText() {
        return $this->text;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    static public function loadTweetById(PDO $conn, $id){
        
        if ($id){
            
            $sql = 'Select * From `Tweet` Where `id`= :id;';
            
            try{
                $query = $conn->prepare($sql);
                $result = $query->execute(['id' => $id]);
                
                if ($result && $query->rowCount() > 0){
                $row = $query->fetch();
                
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];
                
                return $loadedTweet;
                }
                
            }catch (PDOException $ex){
                echo $ex->getMessage();
            }
        }
        
        return null;
    }
    
    static public function loadAllTweetsByUserId(PDO $conn, $userId){
        
        $sql = 'Select * From `Tweet` Where `userId` = :userId Order By `creationDate` Desc;';
        $tweetArr = [];
        
        try{
            $query = $conn->prepare($sql);
            $result = $query->execute(['userId' => $userId]);
            
            if ($result && $query->rowCount() > 0){
            $allTweets = $query->fetchAll();
            
                foreach ($allTweets as $tweet){
                    $loadedTweet = new Tweet();
                    $loadedTweet->id = $tweet['id'];
                    $loadedTweet->userId = $tweet['userId'];
                    $loadedTweet->text = $tweet['text'];
                    $loadedTweet->creationDate = $tweet['creationDate'];
                    
                    $tweetArr[] = $loadedTweet;
                }
                return $tweetArr;
            }
            
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
        return null;
    }
    
    static public function loadAllTweets(PDO $conn){
        
        $sql = 'Select * From `Tweet` Order By `creationDate` Desc;';
        $tweetArr = [];
        
        try{
            $query = $conn->prepare($sql);
            $result = $query->execute();
            
            if ($result && $query->rowCount() > 0){
            $allTweets = $query->fetchAll();
            
                foreach ($allTweets as $tweet){
                    $loadedTweet = new Tweet();
                    $loadedTweet->id = $tweet['id'];
                    $loadedTweet->userId = $tweet['userId'];
                    $loadedTweet->text = $tweet['text'];
                    $loadedTweet->creationDate = $tweet['creationDate'];
                    
                    $tweetArr[] = $loadedTweet;
                }
                return $tweetArr;
            }
            
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
        return null;
    }
    
    public function saveToDB(PDO $conn){
        if ($this->getId() == -1){
            
            $sql = 'INSERT INTO `Tweet` VALUES (NULL, :userId, :text, :creationDate);';
            
            $sqlParams = [
                        'userId'=> $this->getUserId(),
                        'text'=> $this->getText(),
                        'creationDate'=> $this->getCreationDate()
                        ];
            
        } else {
            
            $sql = 'UPDATE `Tweet` SET '
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
}

