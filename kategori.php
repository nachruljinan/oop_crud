<?php
require_once 'classes/Database.php';
require_once 'classes/Kategori.php';

session_start();

$db = (new Database())->getConnection();
$kat = new Kategori($db);

$kategori = $kat->read();
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
                <h1>Kategori</h1>
                <a href="create.php" class="btn btn-sm btn-primary mb-2 mt-2">Tambah Kategori</a>

                <!-- menampilkan alert jika ada session message -->
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-primary" role="alert">
                        <?= $_SESSION['message'] ?>
                    </div>
                <?php
                    unset($_SESSION['message']);
                endif
                ?>
                <!-- akhir menampilkan alert jika ada session message -->

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = $kategori->fetch(PDO::FETCH_ASSOC)):
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama_kategori'] ?></td>
                                <td><?= $row['status'] ?></td>
                                <td><?= $row['created_at'] ?></td>
                                <td>
                                    <a href="kategori_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="kategori_delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus artikel ini?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>