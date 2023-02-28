<?php

class Home_model
{
    public function getData($id)
    {
        $query = 'SELECT * FROM `users` WHERE id=' . $id;
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeSelectQuery($query);
        return $this->memory;
    }

    public function getLaporan()
    {
        $query = 'SELECT * FROM `pengaduan` p, `users` u WHERE p.nik=u.nik';
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeSelectQuery($query);
        return $this->memory;
    }

    public function getTanggapan()
    {
        $query = 'SELECT * FROM `pengaduan` p, `users` u, `tanggapan` t WHERE p.nik=u.nik and p.id_laporan=t.id_peg';
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeSelectQuery($query);
        return $this->memory;
    }

    public function input($data = [])
    {
        $query = 'INSERT INTO pengaduan(nik, laporan, foto, tgl, status) VALUES ("' . $data['nik'] . '","' . $data['laporan'] . '","' . $data['foto'] . '",now(),"belum")';
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeQuery($query);
        return $this->memory;
    }

    public function getDetail($id)
    {
        $query = 'SELECT * FROM `pengaduan`, `tanggapan` WHERE pengaduan.status != "selesai" and pengaduan.id_laporan=' . $id . ' and tanggapan.id_peg = ' . $id;
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeSelectQuery($query);
        return $this->memory;
    }

    public function getDetailTanggapan($id)
    {
        $query = 'SELECT * FROM `pengaduan` WHERE pengaduan.status != "selesai" and pengaduan.id_laporan='.$id;
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeSelectQuery($query);
        return $this->memory;
    }

    public function checkTanggapan($id)
    {
        $query = 'SELECT * FROM `tanggapan` WHERE id_peg=' . $id;
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeSelectQuery($query);
        return $this->memory;
    }
    public function tanggapan($data = [])
    {
        $query = 'INSERT INTO tanggapan(id_peg, tgl_tang, tanggapan, id_petugas) VALUES ("' . $data['id_peg'] . '",now(),"' . $data['tanggapan'] . '",' . $data['id'] . ')';
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeQuery($query);
        return $this->memory;
    }

    public function menanggapi($id)
    {
        $query = 'UPDATE `pengaduan` set status="proses" where id_laporan=' . $id;
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeQuery($query);
        return $this->memory;
    }

    public function ubah_tanggapan($data = [])
    {
        $query = 'UPDATE `tanggapan` set tanggapan="' . $data['tanggapan'] . '", tgl_tang = now() where id_peg=' . $data['id_peg'];
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeQuery($query);
        return $this->memory;
    }

    public function selesaikan($id)
    {
        $query = 'UPDATE `pengaduan` set status="selesai" where id_laporan = ' . $id;
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeQuery($query);
        return $this->memory;
    }

    public function getUsers()
    {
        $query = 'SELECT * FROM `users` where 1';
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeSelectQuery($query);
        return $this->memory;
    }

    public function deleteUser($id)
    {
        $query = 'DELETE FROM `users` where id=' . $id;
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeQuery($query);
        return $this->memory;
    }
    public function editUser($data)
    {
        $query = 'UPDATE `users` SET `nama`="'.$data['nama'].'",`username`="'.$data['username'].'",`password`="'.$data['password'].'",`telp`="'.$data['telpon'].'",`nik`="'.$data['nik'].'",`level`="'.$data['level'].'" where id=' . $data['id'];
        $dbcontroller = new DBController();
        $this->memory = $dbcontroller->executeQuery($query);
        return $this->memory;
    }
}
