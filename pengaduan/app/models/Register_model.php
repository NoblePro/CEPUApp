<?php

class Register_model
{
    public function input($data = [])
    {
        $query = 'INSERT INTO users(nama, nik, password, telp, username, level) VALUES ("' . $data['nama'] . '","' . $data['nik'] . '","' . $data['password'] . '","' . $data['telpon'] . '","' . $data['username'] . '","masyarakat")';
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeQuery($query);
        return $this->memory;
    }

    public function checkNIK($nik)
    {
        $query = 'SELECT * FROM `users` where nik="'.$nik.'"';
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeSelectQuery($query);
        return $this->memory;
    }
}
