<?php include_once(__DIR__ . "/Db.php");

class Post{
    protected $file;
    protected $filename;
    protected $filetmpname;
    protected $filesize;
    protected $fileerror;
    protected $filetype;

    /**
     * Get the value of file
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */ 
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

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

    /**
     * Get the value of filetmpname
     */ 
    public function getFiletmpname()
    {
        return $this->filetmpname;
    }

    /**
     * Set the value of filetmpname
     *
     * @return  self
     */ 
    public function setFiletmpname($filetmpname)
    {
        $this->filetmpname = $filetmpname;

        return $this;
    }

    /**
     * Get the value of filesize
     */ 
    public function getFilesize()
    {
        return $this->filesize;
    }

    /**
     * Set the value of filesize
     *
     * @return  self
     */ 
    public function setFilesize($filesize)
    {
        $this->filesize = $filesize;

        return $this;
    }

    /**
     * Get the value of fileerror
     */ 
    public function getFileerror()
    {
        return $this->fileerror;
    }

    /**
     * Set the value of fileerror
     *
     * @return  self
     */ 
    public function setFileerror($fileerror)
    {
        $this->fileerror = $fileerror;

        return $this;
    }

    /**
     * Get the value of filetype
     */ 
    public function getFiletype()
    {
        return $this->filetype;
    }

    /**
     * Set the value of filetype
     *
     * @return  self
     */ 
    //Thinking off a total new fuction to see if the format is allowed
    public function setFiletype($filename)
    {
        $filenamefilterd = strtolower(end(explode(".", $filename)));
        $this->filetype = $filenamefilterd;

        return $this;
    }

    public function save()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into posts (post_image) values (:filename);");
        $statement->bindValue(':filename', $this->filenamenew);
        return $statement->execute();
    }
}

?>