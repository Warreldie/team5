<?php include_once(__DIR__ . "/Db.php");

class Post{
    protected $file;
    protected $filename;
    protected $filenamenew;
    protected $filetmpname;
    protected $filesize;
    protected $fileerror;
    protected $filetype;
    protected $filedestination;
    protected $description;

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
     * Get the value of filenamenew
     */ 
    public function getFilenamenew()
    {
        return $this->filenamenew;
    }

    /**
     * Set the value of filenamenew
     * By using new unique id based on time and in the back the filetype so we can use the filetype again
     * @return  self
     */ 
    public function setFilenamenew()
    {
        $this->filenamenew = uniqid('', true) . "." . $this->getFiletype();

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
     * The filetype we get from the back of the filename and we set it in lowercase
     * @return  self
     */ 
    public function setFiletype()
    {
        $filetypeunfilterd = explode(".", $this->getFilename());

        $this->filetype = strtolower(end($filetypeunfilterd));

        return $this;
    }
    
    /**
     * Get the value of filedestination
     */ 
    public function getFiledestination()
    {
        return $this->filedestination;
    }

    /**
     * Set the value of filedestination
     * In map content with the unique name
     * @return  self
     */ 
    public function setFiledestination()
    {
        $this->filedestination =  "content/" . $this->getFilenamenew();

        return $this;
    }
    //Looking of the type of document is allowed
    public function allowed()
    {
        //We get the filetype by setting it and test of it is allowed by diffrent types
        $this->setFiletype();
        $allowed = array("jpg", "jpeg", "png", "pdf");

        if(in_array($this->getFiletype(), $allowed)){
            return true;
        }else{
            return false;
        }
    }
    //Move the file from a folder from the customer to our folder on the server
    public function move(){
        move_uploaded_file($this->getFiletmpname(), $this->getFiledestination());
    }
    
    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
    //We save all the information in the database
    public function save()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into posts (user_id, post_text, post_image) values (4, :description, :filename);");
        $statement->bindValue(':filename', $this->filenamenew);
        $statement->bindValue(':description', $this->description);

        return $statement->execute();
    }
}
?>