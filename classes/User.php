<?php 
include_once(__DIR__ . "/Db.php");

class User
{
    protected $username;
    protected $password;
    protected $passwordConfirm;
    protected $leeftijd;
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
     * Get the value of passwordConfirm
     */ 
    public function getPasswordConfirm()
    {
        return $this->passwordConfirm;
    }

    /**
     * Set the value of passwordConfirm
     *
     * @return  self
     */ 
    public function setPasswordConfirm($passwordConfirm)
    {
        $this->passwordConfirm = $passwordConfirm;

        return $this;
    }

    /**
     * Get the value of leeftijd
     */ 
    public function getLeeftijd()
    {
        return $this->leeftijd;
    }

    /**
     * Set the value of leeftijd
     *
     * @return  self
     */ 
    public function setLeeftijd($leeftijd)
    {
        $this->leeftijd = $leeftijd;

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
}