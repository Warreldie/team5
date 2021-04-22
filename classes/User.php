<?php 
include_once(__DIR__ . "/Db.php");

class User
{
    protected $username;
    protected $password;
    protected $date_of_birth;
    protected $email;

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


    public function register()
    {
        $options = [
            'cost' => 15
        ];
        $password = password_hash($this->password, PASSWORD_DEFAULT, $options);

        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into users (username, password, date_of_birth, email) values (:username, :password, :date_of_birth, :email);");
        $statement->bindValue(':username', $this->username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':leeftijd', $this->date_of_birth);
        $statement->bindValue(':email', $this->email);
        return $statement->execute();
    }


    public static function getAllUsernames(){
        $conn = Db::getInstance();
        $statement = $conn->query("select username from users");
        //$result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }
    public static function getAllEmails(){
        $conn = Db::getInstance();
        $statement = $conn->query("select email from users");
        //$result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }

    public function canLogin($email, $password){
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
    
}