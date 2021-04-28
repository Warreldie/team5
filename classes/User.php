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
        $statement->bindValue(':date_of_birth', $this->date_of_birth);
        $statement->bindValue(':email', $this->email);
        return $statement->execute();
    }

    //Function for ajax live checking if username or email already exist
    public static function getAllUsernames(){
        $conn = Db::getInstance();
        $statement = $conn->query("select username from users");
        //$result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }
    //Function for ajax live checking if username or email already exist
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

        if (!$user){
            throw new Exception("Email and/or password is wrong");
        }

        // password_verify() verifies the user
        // this function returns true or false
        if (password_verify($password, $hash)){
            return true;
        } else {
            return false;
        }
    }


    //setters and getters for feature 5 (changing password)
    protected $password_new;
    protected $password_conf;

    /**
     * Get the value of new password
     */ 
    public function getPassword_new(){
        return $this->passsword_new;
    }

     /**
     * Set the value of new password
     *
     * @return  self
     */ 
    public function setPassword_new($password_new){
        $this->passsword_new = $password_new;

        return $this;
    }
    

    /**
     * Get the value of confirm password
     */ 
    public function getPassword_conf(){
        return $this->passsword_conf;
    }
    
     /**
     * Set the value of confirm password
     *
     * @return  self
     */ 
    public function setPassword_conf($password_conf){
        $this->passsword_conf = $password_conf;

        return $this;
    }
    

    public function check_password($password){
        //this function checks if the current password = password in database
        $password = $this->getPassword();

        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from users where password = :password");
        $statement->bindValue(":password", $password);
        $statement->execute();
        $user = $statement->fetch();
        $hash = $user["password"];

        if (!$password){
            throw new Exception("Current password is wrong");
        }

        if (password_verify($password, $hash)){
            return true;
        } else {
            return false;
        }
    }


    //function to insert new password in the database
    //function also contains password_hash
    public function save_password(){

        $options = [
			'cost' => 15,
		];
		$password_new = password_hash($this->password_new, PASSWORD_DEFAULT, $options);

        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into users (password) values (:password)");

        $password_new = $this->getPassword_new();

        $statement->bindValue(":password", $password_new);

        $result = $statement->execute();

        return $result;

/*
        if ($password_new!==$password_conf){
            throw new Exception("Email and/or password is wrong");
        }
*/
    }









    
}