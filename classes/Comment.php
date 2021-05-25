<?php
include_once(__DIR__ ."/Db.php");

    class Comment{
        protected $text;
        protected $postId;
        protected $userId;
        protected $time;


        /**
        * Get the value of text
        */ 
        public function getText(){
            return $this->text;
        }

        /**
         * Set the value of text
         *
         * @return  self
        */ 
        public function setText($text){
            $this->text = $text;

            return $this;
        }

        /**
        * Get the value of postId
        */ 
        public function getPostId(){
            return $this->postId;
        }

        /**
         * Set the value of postId
         *
         * @return  self
        */ 
        public function setPostId($postId){
            $this->postId = $postId;

            return $this;
        }

        /**
        * Get the value of userId
        */ 
        public function getUserId(){
            return $this->userId;
        }

        /**
         * Set the value of userId
         *
         * @return  self
        */ 
        public function setUserId($userId){
            $this->userId = $userId;

            return $this;
        }
                /**
        * Get the value of time
        */ 
        public function getTime(){
            return $this->time;
        }

        /**
         * Set the value of time
         *
         * @return  self
        */ 
        public function setTime($time){
            $this->time = $time;

            return $this;
        }
        //save comment in database
        public function save(){ 

            $text = $this->getText();
            $postId = $this->getPostId(); 
            $userId = $this->getUserId(); 

            echo "We geraken in de save";
            /*
            $db_name = "warrel_netimdtok";
            $db_user = "warrel_netimdtok";
            $db_password = "php@team5";
            $db_host = "warrel.net.mysql";
            */
            $db_name = "imdtok";
            $db_user = "root";
            $db_password = "root";
            $db_host = "localhost";

            //$conn = Db::getInstance();
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $statement = $conn->prepare("insert into comments (text, post_id, user_id) values (:text, :postId, :userId)");

            $statement->bindValue(":text", $text);
            $statement->bindValue(":postId", $postId);
            $statement->bindValue(":userId", $userId);

            //echo "We geraken voorbij de connectie";

            $result = $statement->execute();
            return $result;
        }

        // get all comments 
        public static function getAllFromId($postId){
        
            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from comments where post_id = :postId');
            $statement->bindValue(":postId", $postId);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        
       
        
    }