<?php setcookie('error',null,0,'/'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Silahkan Mengcepu, <?= explode(' ', $data['nama'])[0]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="./jQuery MultiSelect Widget Demo_files/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <style>
        input[type=text],
        input[type=file],
        textarea {
            width: 50% !important;
            display: inline !important;
        }

        label {
            display: block
        }

        p {
            display: inline
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#laporan-display").hide()
            $("#fotolaporan-display").hide()
            $("#gambar").hide()
        })
        $(function() {
            $("#form").submit(function(e) {
                var laporan = $("#laporan").val()
                var foto = $("#foto").val()
                if (laporan != '' && foto != '') {
                    $("#form").submit()
                } else {
                    e.preventDefault()
                }
                if (laporan == '') {
                    $("#laporan-display").show().fadeOut(1000);
                }
                if (foto == '') {
                    $("#fotolaporan-display").html("Mohon mengikutsertakan Foto Laporan Anda")
                    $("#fotolaporan-display").show().fadeOut(1000);
                }
            })

            $("#foto").change(function() {
                data = new FormData();
                data.append('file', $('#foto')[0].files[0]);
                $.ajax({
                    url: 'http://localhost/pengaduan/public/ajax/foto.php',
                    method: 'post',
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,

                    success: function(res) {
                        if (res == 'error') {
                            $("#fotolaporan-display").html("Hanya Menerima Gambar!")
                            $("#fotolaporan-display").show().fadeOut(1000);
                            $("#foto").val("")
                            $("#gambar").hide()
                            change("")
                        } else{
                            change(res)
                            $("#gambar").show()
                        }
                    }
                })
            })
        })

        function change(img){
            document.getElementById("gambar").setAttribute("src", img)
        }
    </script>
</head>

<body>
<h1 class="position-absolute top-0 start-50 translate-middle-x" style="margin-top:40px; color:blue">CEPU App</h1>
        <div class="card w-50 text-white position-absolute top-50 start-50 translate-middle" style="background-color:#00a92c">
            <div class="card-body">
                <h1 style="text-decoration:underline">Adukan</h1>
    <form action="input" method="post" id="form" enctype="multipart/form-data">
        <input name="nik" value="<?= $data['nik'];?>" type="hidden">
        <div class="mb-3">
            <label for="laporan" class="form-label">Laporan</label>
            <textarea class="form-control" id="laporan" placeholder="Laporan" name="laporan"></textarea>
            <p style="color:red;" id="laporan-display">Mohon mengisi Laporan Anda</p>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
            <p style="color:red;" id="fotolaporan-display">Mohon mengikutsertakan Foto Laporan Anda</p>
            <br><br>
            <img src="" id="gambar" class="img-thumbnail" style="width:400px">
        </div>
        <input type="submit" value="Kirim" class="btn btn-primary btn-lg">
    </form>
    </div>
        </div>
        <div class="position-absolute bottom-0 start-50 translate-middle-x" style="margin-bottom:60px">
            <a href="<?= BASEURL ?>login" class="btn btn-outline-info">LOGOUT</a>
            <a href="<?= BASEURL ?>home" class="btn btn-outline-info">HOME</a>
        </div>
    </body>

</html>