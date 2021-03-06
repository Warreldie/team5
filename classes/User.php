<?php
include_once(__DIR__ . "/Db.php");

class User
{
    protected $username;
    protected $password;
    protected $date_of_birth;
    protected $email;
    protected $passwordNew;
    protected $emailNew;
    protected $bio;
    protected $userId;
    protected $profilePic;

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    /**
     * Get the value of date_of_birth
     */
    public function getDate_of_birth()
    {
        return $this->date_of_birth;
    }

    /**
     * Set the value of date_of_birth
     *
     * @return  self
     */
    public function setDate_of_birth($date_of_birth)
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    /**
     * Get the value of new password
     */
    public function getPasswordNew()
    {
        return $this->passwordNew;
    }

    /**
     * Set the value of new password
     *
     * @return  self
     */
    public function setPasswordNew($passwordNew)
    {
        $this->passwordNew = $passwordNew;

        return $this;
    }

    /**
     * Get the value of new email
     */
    public function getEmailNew()
    {
        return $this->emailNew;
    }

    /**
     * Set the value of new email
     *
     * @return  self
     */
    public function setEmailNew($emailNew)
    {
        $this->emailNew = $emailNew;

        return $this;
    }
    /**
     * Get the value of bio
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @return  self
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

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
     * Get the value of userId
     */
    public function setuserId($x)
    {
        if (strpos($x, '@') && strpos($x, '.com')) {
            $conn = Db::getInstance();
            $statement = $conn->prepare('select id from users where email = :email');
            $statement->bindValue(":email", $x);
            $statement->execute();
            $user = $statement->fetchAll();
            return $user;
        } else {
            $conn = Db::getInstance();
            $statement = $conn->prepare('select id from users where username = :username');
            $statement->bindValue(":username", $x);
            $statement->execute();
            $user = $statement->fetchAll();
            return $user;
        }
        return $this->userId;
    }

    /**
     * Get the value of profilePic
     */
    public function getProfilePic()
    {
        return $this->profilePic;
    }

    /**
     * Set the value of profilePic
     *
     * @return  self
     */
    public function setProfilePic($profilePic)
    {
        $this->profilePic = $profilePic;

        return $this;
    }

    public function register()
    {
        $options = [
            'cost' => 12
        ];
        $password = password_hash($this->password, PASSWORD_DEFAULT, $options);

        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into users (username, password, date_of_birth, email) values (:username, :password, :date_of_birth, :email);");
        $statement->bindValue(':username', $this->username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':date_of_birth', $this->date_of_birth);
        $statement->bindValue(':email', $this->email);
        return $statement->execute();
    }

    //Function for ajax live checking if username or email already exist
    public static function getAllUsernames()
    {
        $conn = Db::getInstance();
        $statement = $conn->query("select username from users");
        //$result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }

    //Function for ajax live checking if username or email already exist
    public static function getAllEmails()
    {
        $conn = Db::getInstance();
        $statement = $conn->query("select email from users");
        //$result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }
    public function canLogin($email, $password)
    {
        //this function checks if a user can login
        $email = $this->getEmail();
        $password = $this->getPassword();

        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from users where email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();
        $user = $statement->fetch();
        $hash = $user["password"];

        if (!$user) {
            throw new Exception("Email and/or password is wrong");
        }

        // password_verify() verifies the user
        // this function returns true or false
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }

    //Checks if the current password = password from database
    public function checkPassword()
    {
        $password = $this->getPassword();
        $userId = 20; //test
        // $email = $_SESSION["user"];

        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from users where id = :id");
        $statement->bindValue(":id", $userId);
        $statement->execute();
        $user = $statement->fetch();
        $hash = $user["password"];

        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }

    //Insert new password in database
    //Also contains password_hash
    public function savePassword()
    {
        $userId = 20; //test
        $passwordNew = $this->getPasswordNew();

        $options = [
            'cost' => 12,
        ];
        $passwordNew = password_hash($this->passwordNew, PASSWORD_DEFAULT, $options);

        $conn = Db::getInstance();
        $statement = $conn->prepare("update users set password = :password where id = :id");

        $statement->bindValue(":password", $passwordNew);
        $statement->bindValue(":id", $userId);

        $result = $statement->execute();

        return $result;
    }

    //Checks if current email = email from database
    public function checkEmail()
    {
        $email = $this->getEmail();
        $userId = 20;

        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from users where email = :email and id = :id");
        $statement->bindValue(":email", $email);
        $statement->bindValue(":id", $userId);
        $statement->execute();
        $user = $statement->fetch();
        return $user;
    }

    //Insert new email in database
    public function saveEmail()
    {
        $userId = 20; //test
        $emailNew = $this->getEmailNew();

        $conn = Db::getInstance();
        $statement = $conn->prepare("update users set email = :email where id = :id");

        $statement->bindValue(":email", $emailNew);
        $statement->bindValue(":id", $userId);

        $result = $statement->execute();

        return $result;
    }
    public static function getAllEmail()
    {
        $userId = 20; //test
        $conn = Db::getInstance();

        $statement = $conn->prepare('select * from users where id = :id');
        $statement->bindValue(":id", $userId);

        $statement->execute();
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }
    public function loadProfilePic()
    {
        include_once(__DIR__ . "/Db.php");
        $conn = Db::getInstance();

        $q = $conn->prepare("SELECT profile_picture FROM users WHERE id = :id");
        $q->bindValue(":id", $this->userId);
        $q->execute();

        $res = $q->fetch()["profile_picture"];
        $this->profilePic = $res;
    }

    //Insert bio in database
    public function saveBio()
    {
        $userId = 20; //test
        $bio = $this->getBio();

        //Conn
        $conn = Db::getInstance();

        //Insert query
        $statement = $conn->prepare("update users set bio = :bio where id = :id");

        $statement->bindValue(":bio", $bio);
        $statement->bindValue(":id", $userId);

        $user = $statement->execute();

        //Return result
        return $user;
    }
    public static function getAllBio()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare('select * from users');
        $statement->execute();
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }
    public static function getAllName()
    {
        $userId = 20; //test
        $conn = Db::getInstance();

        $statement = $conn->prepare('select * from users where id = :id');
        $statement->bindValue(":id", $userId);

        $statement->execute();
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }
    public function getUsernameFromId($x)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select username from users where id = :user_id');
        $statement->bindValue(":user_id", $x);
        $statement->execute();
        $user = $statement->fetch();
        return $user;
    }
    public function getPostId($x)
    {
        $conn = Db::getInstance();
        $statement = $conn->query("SELECT * FROM posts WHERE user_id = $x");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function setId($id)
    {
        $this->userId = $id;
        return $this;
    }
}
