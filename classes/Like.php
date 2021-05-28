<?php

    class Like {

        private $postId;
        private $userId;
        private $status;

        public function updateStatus() {

            include_once(__DIR__ . "/Db.php");
            $conn = Db::getInstance();

            if($this->status === "true") {
                $q = $conn->prepare("UPDATE likes SET status = 0 WHERE user_id = :user_id AND post_id = :post_id");
            } else if($this->status === "false") {
                $q = $conn->prepare("UPDATE likes SET status = 1 WHERE user_id = :user_id AND post_id = :post_id");
            }

            $q->bindValue(":user_id", $this->userId);
            $q->bindValue(":post_id", $this->postId);
            $q->execute();
            
        }

        public function saveLike() {

            include_once(__DIR__ . "/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("INSERT INTO likes (user_id, post_id, status) VALUES (:user_id, :post_id, 1)");
            $q->bindValue(':user_id', $this->userId);
            $q->bindValue(':post_id', $this->postId);
            $q->execute();

        }

        public function loadLike() {

            include_once(__DIR__ . "/Db.php");

            
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT * FROM likes WHERE post_id = :post_id AND user_id = :user_id");
            $q->bindValue(":post_id", $this->postId);
            $q->bindValue(":user_id", $this->userId);
            $q->execute();

            //$status = $q->fetch()["status"];
            //$this->status = $status;

        }

        public static function getNumberOfLikes($postId) {

            include_once(__DIR__ . "/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT COUNT(*) FROM likes WHERE post_id = :post_id AND status = 1");
            $q->bindValue(":post_id", $postId);
            $q->execute();

            return $q->fetch()["COUNT(*)"];

        }

        public static function getLikeStatus($postId, $userId) {

            include_once(__DIR__ . "/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT status FROM likes WHERE post_id = :post_id AND user_id = :user_id");
            $q->bindValue(":post_id", $postId);
            $q->bindValue(":user_id", $userId);
            $q->execute();

            return $q->fetch()["status"];

        }

        /**
         * Get the value of postId
         */ 
        public function getPostId()
        {
            return $this->postId;
        }

        /**
         * Set the value of postId
         *
         * @return  self
         */ 
        public function setPostId($postId)
        {
            $this->postId = $postId;
            return $this;
        }

        /**
         * Get the value of userId
         */ 
        public function getUserId()
        {
            return $this->userId;
        }

        /**
         * Set the value of userId
         *
         * @return  self
         */ 
        public function setUserId($userId)
        {
            $this->userId = $userId;
            return $this;
        }

        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setStatus($status)
        {
            $this->status = $status;
            return $this;
        }

    }