<?php
class Book extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}
	// method hapus data buku berdasarkan id
	public function delete($id){
		$this->book_model->delBook($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	public function delkat($id){
		$this->book_model->delKategori($id);
		redirect('dashboard/kategori');
	}

	// method untuk tambah data buku
	public function insert(){
		// target direktori fileupload
		$target_dir = "c:/xampp/htdocs/books/assets/images/";
		
		// baca nama file upload
		$filename = $_FILES["imgcover"]["name"];
		// menggabungkan target dir dengan nama file
		$target_file = $target_dir . basename($filename);
		// proses upload
		move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);
		// baca data dari form insert buku
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];
		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	public function addkat(){
		$data['role'] = $_SESSION['role'];
		$data['fullname'] = $_SESSION['fullname'];
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/addkat', $data);
        $this->load->view('dashboard/footer');		
	}

	public function editkat($id){
		$data['kategori'] = $this->book_model->showKategori2($id);
		$data['role'] = $_SESSION['role'];
		$data['fullname'] = $_SESSION['fullname'];
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editkat', $data);
        $this->load->view('dashboard/footer');		
	}

	public function insertKat(){
		$kategori = $_POST['kategori'];
		$this->book_model->insertKat($kategori);
		redirect('dashboard/kategori');
	}

	public function updateKate(){
		$kategori = $_POST['kategori'];
		$idkategori = $_POST['idkategori'];
		$this->book_model->updateKat($idkategori, $kategori);
		redirect('dashboard/kategori');
	}

	// method untuk edit data buku berdasarkan id
	public function edit(){
		// target direktori fileupload
		$target_dir = "c:/xampp/htdocs/books/assets/images/";
		
		// baca nama file upload
		$filename = $_FILES["imgcover"]["name"];
		// menggabungkan target dir dengan nama file
		$target_file = $target_dir . basename($filename);
		// proses upload
		move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);
		// baca data dari form insert buku
		$id = $_POST['id'];
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];
		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->updateBook($id,$judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	// method untuk mencari data buku berdasarkan 'key'
	public function findbooks(){
		$key = "";
			if(isset($_POST['key'])){
				$key = $_POST['key'];
				$_SESSION['key'] = $key;
			}else{
				$key = $_SESSION['key'];
			}
		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$datafind = $this->book_model->findBook($key);
		$data['cat'] = $this->book_model->getKategori();
		    $config['base_url'] = site_url('book/findbooks');
            $config['total_rows'] = count($datafind);
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $choice = $config['total_rows'] / $config['per_page'];
            $config['num_links'] = floor($choice);

            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Prev';

            $this->pagination->initialize($config);
            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['row'] = array_slice($datafind, $data['page'],$config['per_page']);
            $data['pagination'] = $this->pagination->create_links();
		// ambil session fullname untuk ditampilkan ke header
		$data['role'] = $_SESSION['role'];
		$data['fullname'] = $_SESSION['fullname'];
		$data['hitung'] = $this->book_model->findcount($key);
		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/books', $data);
        $this->load->view('dashboard/footer');
	}
	public function findkategori(){
		
		// baca key dari form cari data
		$key = $_POST['key'];
		// ambil session fullname untuk ditampilkan ke header
		$data['role'] = $_SESSION['role'];
		$data['fullname'] = $_SESSION['fullname'];
		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['kategori'] = $this->book_model->findKategori($key);
		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/kategori', $data);
        $this->load->view('dashboard/footer');
	}
}
?>