<?php include_once(__DIR__ . "/Db.php");

class Post
{
    protected $file;
    protected $filename;
    protected $filenamenew;
    protected $filetmpname;
    protected $filesize;
    protected $fileerror;
    protected $filetype;
    protected $filedestination;
    protected $description;
    protected $tags;

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

        if (in_array($this->getFiletype(), $allowed)) {
            return true;
        } else {
            return false;
        }
    }
    //Move the file from a folder from the customer to our folder on the server
    public function move()
    {
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
    /**
     * Get the value of tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the value of tags
     *
     * @return  self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }
    //We save all the information in the database
    public function save()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO posts (user_id, post_text, post_image) VALUES (4, :description, :filename);");
        $statement->bindValue(':filename', $this->filenamenew);
        $statement->bindValue(':description', $this->description);

        return $statement->execute();
    }
    public function getPosts()
    {
        $conn = Db::getInstance();
        $statement = $conn->query("SELECT post_image FROM posts WHERE user_id = 4");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function saveTags()
    {
        $nospace = str_replace(' ', '', $this->getTags());
        $nolower = explode("#", $nospace);
        $j = 0;
  
        // Iterate loop to convert array
        // elements into lowercase and 
        // overwriting the original array
        foreach( $nolower as $element ) { 
            $nolower[$j] = strtolower($element);
            $j++;
        }

        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT text FROM tags");
        $statement->execute();
        $tagsdb = $statement->fetchAll(PDO::FETCH_OBJ);
            var_dump($tagsdb);
            var_dump($nolower);
            $exists = array_search($nolower, $tagsdb);
            var_dump($exists);
        //$exists = array_search("", $tagsdb);
        //Function to see if tag already exists
        //De tags id krijgen van de huidig die dat ik zal posten
        //De tags ids saven samen met de post save
        /*for($i = 1; $i<count($tags); $i++) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO tags (text) VALUES (:tag);");
            $statement->bindValue(":tag", $tags[$i]);
            $result = $statement->execute();
            var_dump($result);
        }*/
    }
}
