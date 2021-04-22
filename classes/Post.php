<?php include_once(__DIR__ . "/Db.php");

class Post{
    protected $filename;
    

    /**
     * Get the value of filename
     */ 
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of filename
     *
     * @return  self
     */ 
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    public function save()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into post_image (file_name) values (:filename);");
        $statement->bindValue(':filename', $this->filename);
        return $statement->execute();
    }
}

?>