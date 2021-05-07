<?php
include_once(__DIR__ ."/Db.php");

    class Comment{
        protected $text;
        protected $postId;
        protected $userId;


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

        //save comment in database
        public function save(){ 

            $text = $this->getText();
            $postId = 3; //test
            $userId = 20; //test


            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into comments (text, post_id, user_id) values (:text, :postId, :userId)");

            $statement->bindValue(":text", $text);
            $statement->bindValue(":postId", $postId);
            $statement->bindValue(":userId", $userId);

            $result = $statement->execute();
            return $result;

        }

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

        protected $time;

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

        // get timestamp database
        public static function getTimeStamp(){
            
            $userId = 20; //test

            $conn = Db::getInstance();
            $statement = $conn->prepare('select * from comments where user_id = :userId');

            $statement->bindValue(":userId", $userId);

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        //https://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
        //https://css-tricks.com/snippets/php/time-ago-function/
   

       /* public function timeDiff(){
            
            $now = new DateTime();
            $time = $this->getTime();

            // convert to unix timestamps
            $time=strtotime($time);
            $now=strtotime($now);
            
            // perform subtraction to get the difference (in seconds) between times
            $timeDiff=$now-$time;
            
            // return the difference
            return $timeDiff;
        }
        */











    }


