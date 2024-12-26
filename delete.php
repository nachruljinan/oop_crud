<?php
require_once 'classes/Database.php';
require_once 'classes/Article.php';

session_start();

$db = (new Database())->getConnection();
$article = new Article($db);

$id = $_GET['id'];

if ($article->delete($id)) {
    $_SESSION['message'] = "Artikel berhasil dihapus!";
} else {
    $_SESSION['message'] = "Terjadi kesalahan saat menghapus artikel.";
}

header("Location: index.php");
exit;
