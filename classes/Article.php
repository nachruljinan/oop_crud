<?php
class Article
{
    private $conn;
    private $table_name = "articles";

    public function __construct($db)
    {
        $this->conn = $db;
        if (!isset($_SESSION['id_user'])) {
            header("Location: login.php");
            exit;
        }
    }

    public function create($title, $content, $kategori, $gambar)
    {
        $query = "INSERT INTO " . $this->table_name . " (title, content, id_kategori, gambar) VALUES (:title, :content, :id_kategori, :gambar)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":id_kategori", $kategori);
        $stmt->bindParam(":gambar", $gambar);
        return $stmt->execute();
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " 
        INNER JOIN users ON users.id_user = " . $this->table_name . ".id_user 
        INNER JOIN kategori ON kategori.id_kategori = " . $this->table_name . ".id_kategori 
        ORDER BY " . $this->table_name . ".created_at DESC";
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

    public function update($id, $title, $content, $gambarBaru = null)
    {
        // Jika ada gambar baru, ambil gambar lama untuk dihapus
        if ($gambarBaru) {
            $query = "SELECT gambar FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && !empty($result['gambar'])) {
                $gambarLama = 'uploads/' . $result['gambar'];
                if (file_exists($gambarLama)) {
                    unlink($gambarLama);
                }
            }
            $query = "UPDATE " . $this->table_name . " SET title = :title, content = :content, gambar = :gambar WHERE id = :id";
        } else {
            $query = "UPDATE " . $this->table_name . " SET title = :title, content = :content WHERE id = :id";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        if ($gambarBaru) {
            $stmt->bindParam(":gambar", $gambarBaru);
        }
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        // Ambil nama file gambar
        $query = "SELECT gambar FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && !empty($result['gambar'])) {
            $gambarPath = 'uploads/' . $result['gambar'];

            // Hapus file gambar jika ada
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
