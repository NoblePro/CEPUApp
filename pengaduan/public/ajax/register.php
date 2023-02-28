<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    if ($username != '') {
        $db = mysqli_connect("localhost", "root", "", "pengaduan");
        $sql = 'SELECT * FROM users WHERE username = "' . $username . '"';
        $sth = $db->query($sql);
        $result = mysqli_fetch_array($sth);
        if (empty($result)) {
            echo '0';
        } else {
            echo '1';
        }
    } else {
        echo '2';
    }
}
