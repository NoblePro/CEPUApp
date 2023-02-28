<?php setcookie('error', null, 0, '/'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di halaman Users, <?= explode(' ', $data[0]['nama'])[0]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="./jQuery MultiSelect Widget Demo_files/jquery-ui.css">
    <style>
        textarea {
            width: 400px !important;
        }

        table,
        tr,
        td {
            border: 1px solid black;
            color: white !important;
        }
    </style>
</head>

<body>
    <center>
        <h1 style="margin-top:40px; color:blue; margin-bottom:30px">CEPU App</h1>
        <div class="card w-75 text-white" style="background-color:#00a92c">
            <div class="card-body">
                <h1 style="text-decoration:underline; margin-bottom: 20px">Daftar User</h1>
                <?php
                if (empty($data[1])) {
                    echo '<h1 style="margin-top:40px; color:white; margin-bottom:30px">Tidak ada user!</h1><br>';
                } else {
                ?>
                    <table class="table table-striped" style="text-align:center;">
                        <tr>
                            <td>ID</td>
                            <td>Nama</td>
                            <td>Username</td>
                            <td>Telpon</td>
                            <td>NIK</td>
                            <td>Level</td>
                            <td>Aksi</td>
                        </tr>
                        <?php foreach ($data[1] as $row) { ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['username']; ?></td>
                                <td><?= $row['telp']; ?></td>
                                <td><?= $row['nik']; ?></td>
                                <td><?= $row['level']; ?></td>
                                <td><a href="edit/<?= $row['id']; ?>" class="btn btn-outline-dark text-white">Edit</a> | <a href="hapus/<?= $row['id']; ?>" class="btn btn-outline-dark text-white">Hapus</a></td>
                            </tr>
                    <?php }
                    } ?>
                    </table>
                    <a href="tambah" class="btn btn-outline-dark text-white btn-lg">Tambah</a>
            </div>
        </div>
        <div style="margin-bottom:60px; margin-top:30px">
            <a href="<?= BASEURL ?>login" class="btn btn-outline-info">LOGOUT</a>
            <a href="<?= BASEURL ?>home" class="btn btn-outline-info">LAPORAN</a>
        </div>
    </center>
</body>

</html>