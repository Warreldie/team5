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
    protected $id;

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
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of post_id to the current post_id from looking at the current filename with special id and timestamp
     *
     * @return  self
     */ 
    public function setId()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT id FROM posts WHERE post_image = :filename");
        $statement->bindValue(':filename', $this->filenamenew);
        $statement->execute();
        $this->id = $statement->fetch()["id"];
        return $this;
    }
    //We save all the information from the post in the database
    public function save()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO posts (user_id, post_text, post_image) VALUES (4, :description, :filename);");
        $statement->bindValue(':filename', $this->filenamenew);
        $statement->bindValue(':description', $this->description);

        return $statement->execute();
    }
    //Get the post image
    public function getPosts()
    {
        $conn = Db::getInstance();
        $statement = $conn->query("SELECT post_image FROM posts WHERE user_id = 4");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    //Saving the tags in the database
    public function saveTags()
    {
        // Move all the spaces away
        $nospace = str_replace(' ', '', $this->getTags());
        $nolower = explode("#", $nospace);
        $j = 0;

        // Iterate loop to convert array
        // elements into lowercase and 
        // overwriting the original array
        foreach ($nolower as $element) {
            $nolower[$j] = strtolower($element);
            $j++;
        }
        foreach ($nolower as $element) {
            //This looks if certain tags already exist or not
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from tags where text = :text");
            $statement->bindValue(":text", $element);
            $statement->execute();
            $result = $statement->fetch();

            if (!$result && !($element == "")) {
                //This puts the new tags in the databank
                $statement = $conn->prepare("INSERT INTO tags (text) VALUES (:tag);");
                $statement->bindValue(":tag", $element);
                $result = $statement->execute();
            } else {
                //Tag already exist
            }
            if (!($element == "")) {
                //Get the tags id
                $statement = $conn->prepare("select id from tags where text = :text");
                $statement->bindValue(":text", $element);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                //Save tags_id and post_id in the table post_tags
                $tagId = $result[0]["id"];
                $this->setId();
                $postId = $this->getId();
                $statement = $conn->prepare("INSERT into posts_tags (post_id, tag_id) VALUES (:postId, :tagId)");
                $statement->bindValue(":postId", $postId);
                $statement->bindValue(":tagId", $tagId);
                $result = $statement->execute();
            }
        }
    }
}
