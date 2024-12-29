<?php
require_once 'classes/Database.php';
require_once 'classes/Article.php';
require_once 'classes/Kategori.php';

session_start();

$db = (new Database())->getConnection();
$article = new Article($db);
$kat = new Kategori($db);

$kategori = $kat->read();

if ($_POST) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $idKategori = $_POST['id_kategori'];
    $gambar = null;

    // Handle file upload
    if (!empty($_FILES['gambar']['name'])) {
        $uploadDir = 'uploads/';
        $gambar = basename($_FILES['gambar']['name']);
        $targetFile = $uploadDir . $gambar;

        if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
            $_SESSION['message'] = "Gagal mengupload gambar.";
            header("Location: index.php");
            exit;
        }
    }

    if ($article->create($title, $content, $idKategori, $gambar)) {
        $_SESSION['message'] = "Artikel berhasil disimpan!";
    } else {
        $_SESSION['message'] = "Terjadi kesalahan saat menyimpan artikel!";
    }
    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OOP CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include './includes/navbar.php' ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="mb-4">Add Article</h1>

                <form method="post" enctype="multipart/form-data">

                    <div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form-label">Judul Artikel</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="id-kategori" class="col-sm-2 col-form-label">Kategori Artikel</label>
                        <div class="col-sm-8">
                            <select name="id_kategori" id="id-kategori" class="form-control">
                                <?php while ($row = $kategori->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="content" class="col-sm-2 col-form-label">Konten</label>
                        <div class="col-sm-8">
                            <textarea name="content" id="content" class="form-control" rows="9"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-8">
                            <input type="file" name="gambar" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            <a href="index.php" class="btn btn-sm btn-secondary">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>