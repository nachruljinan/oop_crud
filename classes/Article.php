<?php
class Article
{
    private $conn;
    private $table_name = "articles";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($title, $content)
    {
        $query = "INSERT INTO " . $this->table_name . " (title, content) VALUES (:title, :content)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        return $stmt->execute();
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $content)
    {
        $query = "UPDATE " . $this->table_name . " SET title = :title, content = :content WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
