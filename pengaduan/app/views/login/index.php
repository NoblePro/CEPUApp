<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CEPU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="./jQuery MultiSelect Widget Demo_files/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#username-display").hide()
            $("#password-display").hide()
        })
        $(function() {
            $("#form").submit(function(e) {
                var username = $("#username").val()
                var password = $("#password").val()
                if (username != '' && password != '') {
                    $("#form").submit()
                } else {
                    e.preventDefault();
                }
                if (username == '') {
                    $("#username-display").show().fadeOut(1000);
                }
                if (password == '') {
                    $("#password-display").show().fadeOut(1000);
                }
            })
        })
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
        <h1 class="position-absolute top-0 start-50 translate-middle-x" style="margin-top:40px; color:blue">CEPU App</h1>
        <div class="card w-50 text-white position-absolute top-50 start-50 translate-middle" style="background-color:#00a92c">
            <div class="card-body">
                <h1 style="text-decoration:underline; margin-top:30px">Login</h1>
        <form action="login/userCheck" method="post" id="form">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Username..." name="username">
                <p style="color:red;" id="username-display">Mohon mengisi username</p>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password..." name="password">
                <p style="color:red;" id="password-display">Mohon mengisi password</p>
            </div>
            <input type="submit" value="Login" class="btn btn-primary btn-lg">
            <?php if (isset($_COOKIE['error'])) {
                echo '<p style="color:red">' . $_COOKIE['error'] . '</p>';
                setcookie('error', null, 0, '/');
            } ?>
        </form>
        </div>
        </div>
        <div class="position-absolute bottom-0 start-50 translate-middle-x" style="margin-bottom:60px">
            <a href="<?= BASEURL ?>register" class="btn btn-outline-info">REGISTER</a>
        </div>
    </body>

</html>