<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | CEPU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="./jQuery MultiSelect Widget Demo_files/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#username-display").hide()
            $("#password-display").hide()
            $("#nama-display").hide()
            $("#telpon-display").hide()
            $("#nik-display").hide()
        })
        $(function() {
            $("#form").submit(function(e) {
                var username = $("#username").val()
                var password = $("#password").val()
                var nama = $("#nama").val()
                var telpon = $("#telpon").val()
                var nik = $("#nik").val()
                var test = $("#userCheck").html()
                if (username != '' && password != '' && nama != '' && telpon != '' && nik != '' && test == 'Username Tersedia!') {
                    $("#form").submit()
                } else {
                    e.preventDefault()
                }
                // if (username == '') {
                //     $("#username-display").show().fadeOut(1000);
                // }
                if (password == '') {
                    $("#password-display").show().fadeOut(1000);
                }
                if (nama == '') {
                    $("#nama-display").show().fadeOut(1000);
                }
                if (telpon == '') {
                    $("#telpon-display").show().fadeOut(1000);
                }
                if (nik == '') {
                    $("#nik-display").show().fadeOut(1000);
                }
            })
        })

        function type(hasil) {
            var display = document.getElementById("userCheck")
            if (hasil == 0) {
                display.innerHTML = "Username Tersedia!"
                display.setAttribute("style", "color:lime")
            }
            if (hasil == 1) {
                display.innerHTML = "Username Tidak Tersedia!"
                display.setAttribute("style", "color:red")
            }
            if (hasil == 2) {
                display.innerHTML = "Username Mohon Diisi!"
                display.setAttribute("style", "color:orange")
            }
        }

        function ketik() {
            var input = $("#username").val()
            $.ajax({
                url: 'http://localhost/pengaduan/public/ajax/register.php',
                method: 'post',
                data: {
                    username: input
                },

                success: function(res) {
                    type(res)
                }
            })
        }
    </script>
    <style>
        input[type=text],
        input[type=password] {
            width: 50%;
            display: inline
        }

        label {
            display: block
        }

        p {
            display: inline
        }
    </style>
</head>

<body>
        <h1 class="position-absolute top-0 start-50 translate-middle-x" style="margin-top:40px; color:blue; margin-top:60px">CEPU App</h1>
        <div class="card w-50 text-white position-absolute top-50 start-50 translate-middle" style="background-color:#00a92c">
            <div class="card-body">
                <h1 style="text-decoration:underline">Register</h1>
            <form action="register/input" method="post" id="form">
                <div class="mb-3">
                    <label for="Nama Lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap..." name="nama">
                    <p style="color:red;" id="nama-display">Mohon mengisi Nama Lengkap</p>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username..." onkeyup="ketik()" name="username" value="">
                    <p id="userCheck"></p>
                    <p style="color:red;" id="username-display">Mohon mengisi username</p>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password..." name="password">
                    <p style="color:red;" id="password-display">Mohon mengisi password</p>
                </div>
                <div class="mb-3">
                    <label for="Telpon" class="form-label">Telpon</label>
                    <input type="text" class="form-control" id="telpon" placeholder="Telpon..." name="telpon">
                    <p style="color:red;" id="telpon-display">Mohon mengisi Telpon</p>
                </div>
                <div class="mb-3">
                    <label for="NIK" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" placeholder="NIK..." name="nik">
                    <p style="color:red;" id="nik-display">Mohon mengisi NIK</p>
                </div>
                <input type="submit" value="Daftar" class="btn btn-primary btn-lg">
                <?php if (isset($_COOKIE['error'])) {
                    echo '<p style="color:red">' . $_COOKIE['error'] . '</p>';
                    setcookie('error', null, 0, '/');
                } ?>
            </form>
            </div>
        </div>
        <div class="position-absolute bottom-0 start-50 translate-middle-x" style="margin-bottom:60px">
            <a href="<?= BASEURL ?>login" class="btn btn-outline-info">LOGIN</a>
        </div>
    </body>

</html>