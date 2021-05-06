<?php
include_once(__DIR__ . "/Db.php");

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
            $postId = 3;
            $userId = 20;


            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into comments (text, post_id, user_id) values (:text, :postId, :userId)");

            $statement->bindValue(":text", $text);
            $statement->bindValue(":postId", $postId);
            $statement->bindValue(":userId", $userId);

            $result = $statement->execute();
            return $result;

        }

        // get all comments 
        public static function getAll($postId){
            
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
        /*public static function timeSincePost($time) {
            $now = new DateTime;
            $ago = new DateTime($time);
            $diff = $now->diff($ago);
        
            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;
        
            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );

            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }
        
            $string = array_slice($string, 0, 1);
            return $string ? implode(', ', $string) . ' ago' : 'just now';
            
        }*/

        //https://css-tricks.com/snippets/php/time-ago-function/
       /* public static function timeAgo($time){
            $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
            $lengths = array("60","60","24","7","4.35","12","10");

            
            
        //  $now = new DateTime;
        //  $ago = $time;
        //  $difference= $now->diff($ago);
            
            $now = time();

            $difference = $now - $time;
               

            for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                $difference /= $lengths[$j];
            }

            $difference = round($difference);

            if($difference != 1) {
                $periods[$j].= "s";
            }

            return "$difference $periods[$j]";
            }
        */

        //https://www.w3schools.in/php-script/time-ago-function/
        public function getTimeAgo(){
            
            $time= $this->getTime();
            $time_difference = time() - $time;

            if( $time_difference < 1 ) { return 'less than 1 second ago'; }
            $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                        30 * 24 * 60 * 60       =>  'month',
                        24 * 60 * 60            =>  'day',
                        60 * 60                 =>  'hour',
                        60                      =>  'minute',
                        1                       =>  'second'
            );

            foreach( $condition as $secs => $str ){
                $d = $time_difference / $secs;

                if( $d >= 1 )
                {
                    $t = round( $d );
                    return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
                }
            }
        }       


















    }


