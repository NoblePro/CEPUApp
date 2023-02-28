<?php

if (isset($_FILES['file'])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        $data = file_get_contents($_FILES["file"]["tmp_name"]);
        $base64 = 'data:;base64,' . base64_encode($data);
        echo $base64;
    } else {
        echo "error";
    }
}
