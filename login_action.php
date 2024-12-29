<?php
session_start();
require_once 'classes/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $conn->prepare($query);
        $stmt->execute(['username' => $username]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && md5($password) === $user['password']) {
            // Login berhasil
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            // Login gagal
            $_SESSION['message'] = "Username atau password salah.";
            header("Location: login.php");
            exit;
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
