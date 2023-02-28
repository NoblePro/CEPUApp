<?php

class Register extends Controller
{
	public function index()
	{
		$this->view('register/index');
	}
	public function input($test = 0)
	{
		$data['username'] = $_POST['username'];
		$data['nama'] = $_POST['nama'];
		$data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$data['telpon'] = $_POST['telpon'];
		$data['nik'] = $_POST['nik'];

		if (!$this->model('Register_model')->checkNIK($_POST['nik'])) {
			if ($this->model('Register_model')->input($data)) {
				if ($test == 0) {
					header("Location:http://localhost/pengaduan/public/login/index");
				} else {
					header("Location:http://localhost/pengaduan/public/home/users");
				}
			} else {
				setcookie('error', 'Register Error', 0, '/');
				header("Location:http://localhost/pengaduan/public/register");
			}
		} else {
			if ($test == 0) {
				setcookie('error', 'NIK Double!', 0, '/');
				header("Location:http://localhost/pengaduan/public/register");
			} else {
				setcookie('error', 'NIK Double!', 0, '/');
				header("Location:http://localhost/pengaduan/public/home/users");
			}
		}
	}
}
