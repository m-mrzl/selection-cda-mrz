<?php
class Articles{

    // Connection
    private $conn;

    // Table
    private $db_table = "articles";

    // Columns
    public $id;
    public $title;
    public $content;
    public $date;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

    // GET ALL
public function getArticles(){
        $sqlQuery = "SELECT id, title, content, date FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createArticles(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        title = :title, 
                        content = :content, 
                        date = :date";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->content=htmlspecialchars(strip_tags($this->content));
        $this->date=htmlspecialchars(strip_tags($this->date));

        // bind data
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":date", $this->date);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // READ single
    public function getSingleArticle(){
        $sqlQuery = "SELECT
                        id, 
                        title, 
                        content,
                        date
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $dataRow['title'];
        $this->content = $dataRow['content'];
        $this->date = $dataRow['date'];
    }

    // UPDATE
    public function updateArticle(){
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        title = :title, 
                        content = :content, 
                        date = :date,
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->content=htmlspecialchars(strip_tags($this->content));
        $this->date=htmlspecialchars(strip_tags($this->date));

        // bind data
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // DELETE
    function deleteArticle(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
?>