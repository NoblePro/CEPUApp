<?php
if (isset($_POST['username']) && isset($_POST['id'])) {
    $username = $_POST['username'];
    $id = $_POST['id'];
    if ($username != '') {
        $db = mysqli_connect("localhost", "root", "", "pengaduan");
        $sql = 'SELECT * FROM users WHERE username = "' . $username . '" and id != ' .$id;
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
