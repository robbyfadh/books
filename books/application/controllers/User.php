<?php
class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}
	public function finduser(){
		
		// baca key dari form cari data
		$key = $_POST['key'];
		// ambil session fullname untuk ditampilkan ke header
		$data['role'] = $_SESSION['role'];
		$data['fullname'] = $_SESSION['fullname'];
		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['user'] = $this->user_model->findUser($key);
		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/users', $data);
        $this->load->view('dashboard/footer');
	}

	public function adduser(){
		$data['role'] = $_SESSION['role'];
		$data['fullname'] = $_SESSION['fullname'];
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/adduser', $data);
        $this->load->view('dashboard/footer');	
	}

	public function insertuser(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
		$role = $_POST['role'];
		$this->user_model->insertuser($username,$password,$fullname,$role);
		redirect('dashboard/users');
	}

	public function edituser($id){
		$data['users'] = $this->user_model->showUser2($id);
		$data['role'] = $_SESSION['role'];
		$data['fullname'] = $_SESSION['fullname'];
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/edituser', $data);
        $this->load->view('dashboard/footer');	
	}

	public function updateuser(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
		$role = $_POST['role'];
		$this->user_model->updateuser($username,$password,$fullname,$role);
		redirect('dashboard/users');
	}

	public function delete($id){
		$this->user_model->delUser($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/users');
	}
}