<?php

class Home extends Controller
{
	public function index()
	{
		if (isset($_COOKIE['id'])) {
			$result = $this->model('Home_model')->getData($_COOKIE['id']);
			if ($result) {
				foreach ($result as $row) {
					$laporan  = $this->model('Home_model')->getLaporan();
					$tanggapan = $this->model('Home_model')->getTanggapan();
					$data = [$row, $laporan, $tanggapan];
					$level = $row['level'];
					if ($level == 'masyarakat') {
						$this->view('home/masyarakat', $data);
					} else if ($level == 'admin') {
						$this->view('home/admin', $data);
					} else if ($level == 'petugas') {
						$this->view('home/petugas', $data);
					}
				}
			}
		} else {
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}

	public function pengaduan()
	{
		if (isset($_COOKIE['id'])) {
			$result = $this->model('Home_model')->getData($_COOKIE['id']);
			if ($result) {
				foreach ($result as $row) {
					$level = $row['level'];
					if ($level == 'masyarakat') {
						$this->view('home/pengaduan', $row);
					} else {
						header("Location:http://localhost/pengaduan/public/home");
					}
				}
			}
		} else {
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}

	public function input()
	{
		$result = $this->model('Home_model')->getData($_COOKIE['id']);
		if ($result) {
			foreach ($result as $row) {
				$level = $row['level'];
				if ($level == 'masyarakat') {
					if (isset($_POST['laporan']) && getimagesize($_FILES["foto"]["tmp_name"])) {
						$data['foto'] = addslashes(base64_encode(file_get_contents($_FILES["foto"]["tmp_name"])));
						$data['laporan'] = substr($_POST['laporan'],0,1000);
						$data['nik'] = $_POST['nik'];
						$this->model('Home_model')->input($data);
					}
					header("Location:http://localhost/pengaduan/public/home");
				} else {
					header("Location:http://localhost/pengaduan/public/home");
				}
			}
		} else{
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}

	public function proses($id = -1)
	{
		$result = $this->model('Home_model')->getDetail($id);
		$results = $this->model('Home_model')->getData($_COOKIE['id']);
		if($results){
		if ($result && $results) {
			foreach ($result as $row) {
				foreach ($results as $rows) {
					$data = [$rows, $row];
					$level = $rows['level'];
					if ($level == 'admin' || $level == 'petugas') {
						$this->view('home/proses', $data);
					} else {
						header("Location:http://localhost/pengaduan/public/home");
					}
				}
			}
		} else {
			$result = $this->model('Home_model')->getDetailTanggapan($id);
			$results = $this->model('Home_model')->getData($_COOKIE['id']);
			if($results){
			if ($result && $results) {
				foreach ($result as $row) {
					foreach ($results as $rows) {
						$data = [$rows, $row];
						$level = $rows['level'];
						if ($level == 'admin' || $level == 'petugas') {
							$this->view('home/proses', $data);
						} else {
							header("Location:http://localhost/pengaduan/public/home");
						}
					}
				}
			} else {
				setcookie('error', 'Laporan Error', 0, '/');
				header("Location:http://localhost/pengaduan/public/home");
			}
		} else{
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}
	} else{
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}

	public function tanggapi()
	{
		$result = $this->model('Home_model')->getData($_COOKIE['id']);
		if ($result) {
			foreach ($result as $row) {
				$level = $row['level'];
				if ($level == 'admin' || $level == 'petugas') {
					if (isset($_POST['tanggapan'])) {
						$data['id_peg'] = $_POST['id_peg'];
						$data['tanggapan'] = substr($_POST['tanggapan'],0,1000);
						$data['id'] = $_POST['id'];
						$result = $this->model('Home_model')->checkTanggapan($data['id_peg']);
						if (!$result) {
							$result = $this->model('Home_model')->menanggapi($_POST['id_peg']);
							$result = $this->model('Home_model')->tanggapan($data);
						} else {
							$result = $this->model('Home_model')->menanggapi($_POST['id_peg']);
							$result = $this->model('Home_model')->ubah_tanggapan($data);
						}
						if ($result) {
							$result = $this->model('Home_model')->getData($_COOKIE['id']);
							foreach ($result as $row) {
								$laporan  = $this->model('Home_model')->getLaporan();
								$tanggapan = $this->model('Home_model')->getTanggapan();
								$data = [$row, $laporan, $tanggapan];
								$this->view('home/'.$level, $data);
							}
						} else {
							header("Location:http://localhost/pengaduan/public/home");
						}
					} else {
						header("Location:http://localhost/pengaduan/public/home");
					}
				} else {
					header("Location:http://localhost/pengaduan/public/home");
				}
			}
		} else{
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}

	public function selesaikan($id = -1)
	{
		$result = $this->model('Home_model')->getData($_COOKIE['id']);
		if ($result) {
			foreach ($result as $row) {
				$level = $row['level'];
				if ($level == 'admin' || $level == 'petugas') {
					$result = $this->model('Home_model')->selesaikan($id);
					if ($result) {
						$result = $this->model('Home_model')->getData($_COOKIE['id']);
						foreach ($result as $row) {
							$laporan  = $this->model('Home_model')->getLaporan();
							$tanggapan = $this->model('Home_model')->getTanggapan();
							$data = [$row, $laporan, $tanggapan];
							$this->view('home/admin', $data);
						}
					} else {
						setcookie('error', 'Tutup laporan Error', 0, '/');
						header("Location:http://localhost/pengaduan/public/home");
					}
				} else {
					header("Location:http://localhost/pengaduan/public/home");
				}
			}
		} else{
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}

	public function users()
	{
		$result = $this->model('Home_model')->getData($_COOKIE['id']);
		if ($result) {
			foreach ($result as $row) {
				$level = $row['level'];
				if ($level == 'admin') {
					$result = $this->model('Home_model')->getUsers();
					$results = $this->model('Home_model')->getData($_COOKIE['id']);
					if ($result && $results) {
						foreach ($results as $rows) {
							$data = [$rows, $result];
							$this->view('home/users', $data);
						}
					} else {
						setcookie('error', 'Laporan Error', 0, '/');
						header("Location:http://localhost/pengaduan/public/home");
					}
				} else {
					header("Location:http://localhost/pengaduan/public/home");
				}
			}
		} else{
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}

	public function hapus($id = -1)
	{
		$result = $this->model('Home_model')->getData($_COOKIE['id']);
		if ($result) {
			foreach ($result as $row) {
				$level = $row['level'];
				if ($level == 'admin') {
					$this->model('Home_model')->deleteUser($id);
					header("Location:http://localhost/pengaduan/public/home/users");
				} else {
					header("Location:http://localhost/pengaduan/public/home");
				}
			}
		} else{
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}

	public function edit($id = -1)
	{
		$result = $this->model('Home_model')->getData($_COOKIE['id']);
		if ($result) {
			foreach ($result as $row) {
				$level = $row['level'];
				if ($level == 'admin') {
					$result = $this->model('Home_model')->getData($id);
					if ($result) {
						foreach ($result as $row) {
							$this->view('home/edit', $row);
						}
					} else {
						setcookie('error', 'User Error', 0, '/');
						header("Location:http://localhost/pengaduan/public/home/users");
					}
				} else {
					header("Location:http://localhost/pengaduan/public/home");
				}
			}
		} else{
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}

	public function update()
	{
		$result = $this->model('Home_model')->getData($_COOKIE['id']);
		if ($result) {
			foreach ($result as $row) {
				$level = $row['level'];
				if ($level == 'admin') {
					if (isset($_POST['id'])) {
						$data['id'] = $_POST['id'];
						$data['nama'] = $_POST['nama'];
						$data['username'] = $_POST['username'];
						$data['nik'] = $_POST['nik'];
						$data['telpon'] = $_POST['telpon'];
						$data['level'] = $_POST['level'];
						if ($_POST['password'] != '') {
							$data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
						} else {
							$data['password'] = $_POST['prev-pass'];
						}
						$this->model('Home_model')->editUser($data);
					}
					header("Location:http://localhost/pengaduan/public/home/users");
				} else {
					header("Location:http://localhost/pengaduan/public/home");
				}
			}
		} else{
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}

	public function tambah()
	{
		$result = $this->model('Home_model')->getData($_COOKIE['id']);
		if ($result) {
			foreach ($result as $row) {
				$level = $row['level'];
				if ($level == 'admin') {
					$this->view('home/tambah');
				} else {
					header("Location:http://localhost/pengaduan/public/home");
				}
			}
		} else{
			setcookie('error', 'Login Salah Mohon Login Kembali', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}
}
