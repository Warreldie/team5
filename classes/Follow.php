<?php
include_once(__DIR__ ."/Db.php");

    class Follow{
        private $follow;
        private $follower;

        
        /**
         * Get the value of follow
         */ 
        public function getFollow()
        {
                return $this->follow;
        }

        /**
         * Set the value of follow
         *
         * @return  self
         */ 
        public function setFollow($follow)
        {
                $this->follow = $follow;

                return $this;
        }
        
        /**
         * Get the value of follower
         */ 
        public function getFollower()
        {
                return $this->follower;
        }

        /**
         * Set the value of follower
         *
         * @return  self
         */ 
        public function setFollower($follower)
        {
                $this->follower = $follower;

                return $this;
        }

        public function save(){
            $db_name = "imdtok";
            $db_user = "root";
            $db_password = "root";
            $db_host = "localhost";
            //$conn = Db::getInstance(); ===> doesn't work
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $statement = $conn->prepare("INSERT into followers (following_id, follower_id, active) VALUES (:following_id, :follower_id, true)");
            
            $following_id = $this->getFollow();
            $follower_id = $this->getFollower();

            echo "save";
            $statement->bindValue(":following_id", $following_id);
            $statement->bindValue(":follower_id", $follower_id);

            $result = $statement->execute();
            return $result;
        }
        public function exist(){
            $db_name = "imdtok";
            $db_user = "root";
            $db_password = "root";
            $db_host = "localhost";
            //$conn = Db::getInstance(); ===> doesn't work
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $statement = $conn->prepare("SELECT * FROM followers WHERE following_id = :following_id && follower_id = :follower_id");
            $following_id = $this->getFollow();
            $follower_id = $this->getFollower();

            $statement->bindValue(":following_id", $following_id);
            $statement->bindValue(":follower_id", $follower_id);
            $statement->execute();
            $result = $statement->fetch();
            return $result;
        }
        public function active(){
            $db_name = "imdtok";
            $db_user = "root";
            $db_password = "root";
            $db_host = "localhost";
            //$conn = Db::getInstance(); ===> doesn't work
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $statement = $conn->prepare("SELECT active FROM followers WHERE following_id = :following_id && follower_id = :follower_id");
            
            $following_id = $this->getFollow();
            $follower_id = $this->getFollower();

            $statement->bindValue(":following_id", $following_id);
            $statement->bindValue(":follower_id", $follower_id);
            $statement->execute();
            $result = $statement->fetch();
            return $result[0];
        }
        public function UnFollow(){
            $db_name = "imdtok";
            $db_user = "root";
            $db_password = "root";
            $db_host = "localhost";
            //$conn = Db::getInstance(); ===> doesn't work
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $statement = $conn->prepare("UPDATE followers SET active = 0 WHERE following_id = :following_id && follower_id = :follower_id;");
            $following_id = $this->getFollow();
            $follower_id = $this->getFollower();

            $statement->bindValue(":following_id", $following_id);
            $statement->bindValue(":follower_id", $follower_id);
            $result = $statement->execute();
            return $result;
        }
        public function Following(){
            $db_name = "imdtok";
            $db_user = "root";
            $db_password = "root";
            $db_host = "localhost";
            //$conn = Db::getInstance(); ===> doesn't work
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $statement = $conn->prepare("UPDATE followers SET active = 1 WHERE following_id = :following_id && follower_id = :follower_id;");
            $following_id = $this->getFollow();
            $follower_id = $this->getFollower();

            $statement->bindValue(":following_id", $following_id);
            $statement->bindValue(":follower_id", $follower_id);
            $result = $statement->execute();
            return $result;
        }
        public function CountFollowing(){
            $db_name = "imdtok";
            $db_user = "root";
            $db_password = "root";
            $db_host = "localhost";
            //$conn = Db::getInstance(); ===> doesn't work
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $statement = $conn->prepare("SELECT COUNT(follower_id) FROM followers WHERE follower_id = :following_id;");
            $following_id = $this->getFollow();
            $statement->bindValue(":following_id", $following_id);
            $statement->execute();
            $result = $statement->fetch();
            return $result[0];
        }
    }