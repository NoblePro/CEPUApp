<?php

class Login extends Controller
{
	public function index()
	{
		setcookie('id', null, 0, '/');
		$this->view('login/index');
	}
	public function userCheck()
	{
		$hasil = false;
		$id = '';
		$username = $_POST['username'];
		$password = $_POST['password'];
		$result = $this->model('Login_model')->check($username);
		if ($result) {
			foreach ($result as $row) {
				if (password_verify($password, $row['password'])) {
					$hasil = true;
					$id = $row['id'];
				}
			}
		}
		if ($hasil) {
			setcookie('id', $id, 0, '/');
			header("Location:http://localhost/pengaduan/public/home");
		} else {
			setcookie('error', 'Login atau Password salah!', 0, '/');
			header("Location:http://localhost/pengaduan/public/login");
		}
	}
}
