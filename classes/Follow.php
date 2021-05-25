<?php
include_once(__DIR__ . "/Db.php");

class Follow
{
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

    public function save()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT into followers (following_id, follower_id, active) VALUES (:following_id, :follower_id, true)");

        $following_id = $this->getFollow();
        $follower_id = $this->getFollower();

        $statement->bindValue(":following_id", $following_id);
        $statement->bindValue(":follower_id", $follower_id);

        $result = $statement->execute();
        return $result;
    }
    public function exist()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM followers WHERE following_id = :following_id && follower_id = :follower_id");
        $following_id = $this->getFollow();
        $follower_id = $this->getFollower();

        $statement->bindValue(":following_id", $following_id);
        $statement->bindValue(":follower_id", $follower_id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }
    public function active()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT active FROM followers WHERE following_id = :following_id && follower_id = :follower_id");

        $following_id = $this->getFollow();
        $follower_id = $this->getFollower();

        $statement->bindValue(":following_id", $following_id);
        $statement->bindValue(":follower_id", $follower_id);
        $statement->execute();
        $result = $statement->fetch();
        return $result[0];
    }
    public function UnFollow()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE followers SET active = 0 WHERE following_id = :following_id && follower_id = :follower_id;");
        $following_id = $this->getFollow();
        $follower_id = $this->getFollower();

        $statement->bindValue(":following_id", $following_id);
        $statement->bindValue(":follower_id", $follower_id);
        $result = $statement->execute();
        return $result;
    }
    public function Following()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE followers SET active = 1 WHERE following_id = :following_id && follower_id = :follower_id;");
        $following_id = $this->getFollow();
        $follower_id = $this->getFollower();

        $statement->bindValue(":following_id", $following_id);
        $statement->bindValue(":follower_id", $follower_id);
        $result = $statement->execute();
        return $result;
    }
    public function CountFollowing()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT COUNT(follower_id) FROM followers WHERE follower_id = :following_id;");
        $following_id = $this->getFollow();
        $statement->bindValue(":following_id", $following_id);
        $statement->execute();
        $result = $statement->fetch();
        return $result[0];
    }
}
