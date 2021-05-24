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
            $db_password = "";
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

        /* 
        // get all comments 
        public static function getAll(){
            $postId = 3; //test

            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from comments where post_id = :postId');
            $statement->bindValue(":postId", $postId);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        */

        // get all comments 
        public static function getAllFromId($postId){
            //test
            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from comments where post_id = :postId');
            $statement->bindValue(":postId", $postId);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // get timestamp database
        public static function getTimeStamp(){
            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from comments where post_id = :postId');
            $statement->bindValue(":postId", 21);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            //var_dump( $result);
            return $result;
            /* 
            // time to time ago
            $now = new DateTime();
            $past = new DateTime(json_encode($result)); //array to string
            $interval = $now->diff($past);
            echo $interval;
            $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
            echo $elapsed;
            */
        }
        /*
        //https://stackoverflow.com/questions/15688775/php-find-difference-between-two-datetimes
        public function timeDiff(){
            $now = new DateTime();
            $past = new DateTime('2011-01-03 17:13:00');
            $interval = $now->diff($past);
            $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
            echo $elapsed;
        }
        */

        
        

            










    }