<?php setcookie('error', null, 0, '/'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Silahkan Menanggapi, <?= explode(' ', $data[0]['nama'])[0]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="./jQuery MultiSelect Widget Demo_files/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <style>
        textarea {
            width: 400px !important;
        }

        input[type=text],
        input[type=file] {
            width: 50% !important;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#tanggapan-display").hide()
        })
        $(function() {
            $("#form").submit(function(e) {
                var tanggapan = $("#tanggapan").val()
                if (tanggapan != '') {
                    $("#form").submit()
                } else {
                    e.preventDefault()
                }
                if (tanggapan == '') {
                    $("#tanggapan-display").show().fadeOut(1000);
                }
            })
        })
    </script>
</head>

<body>
    <h1 class="position-absolute top-0 start-50 translate-middle-x" style="margin-top:40px; color:blue">CEPU App</h1>
    <div class="card w-50 text-white position-absolute top-50 start-50 translate-middle" style="background-color:#00a92c">
        <div class="card-body">
            <h1 style="text-decoration:underline">Tanggapi</h1>
            <form action="../tanggapi" method="post" id="form">
                <input name="id_peg" value="<?= $data[1]['id_laporan']; ?>" type="hidden">
                <input name="id" value="<?= $data[0]['id']; ?>" type="hidden">
                <div class="mb-3">
                    <label for="laporan" class="form-label">Laporan</label>
                    <input type="text" class="form-control" id="laporan" placeholder="Laporan" value="<?= $data[1]['laporan']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <img src="data:;base64,<?= $data[1]['foto']; ?>" class="img-thumbnail" style="width:400px">
                </div>
                <div class="mb-3">
                    <label for="tanggapan" class="form-label">Tanggapan</label>
                    <input type="text" class="form-control" id="tanggapan" placeholder="Tanggapan" name="tanggapan" <?php if (!empty($data[1]['tanggapan'])) { ?>value="<?= $data[1]['tanggapan']; ?>" <?php } ?>>
                    <p style="color:red;" id="tanggapan-display">Mohon memberikan tanggapan anda!</p>
                </div>
                <input type="submit" value="Tanggapi" class="btn btn-outline-dark">
            </form>
            <?php if (!empty($data[1]['tanggapan'])) { ?><a href="../selesaikan/<?= $data[1]['id_laporan']; ?>" class="btn btn-outline-danger mt-1">Tutup Laporan</a><?php } ?>
        </div>
    </div>
    <div class="position-absolute bottom-0 start-50 translate-middle-x" style="margin-bottom:60px">
        <a href="<?= BASEURL ?>login" class="btn btn-outline-info">LOGOUT</a>
        <a href="<?= BASEURL ?>home" class="btn btn-outline-info">HOME</a>
    </div>
</body>

</html>