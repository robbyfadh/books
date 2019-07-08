<?php
class Dashboard extends CI_Controller {
        public function __construct(){
            parent::__construct();
            // cek keberadaan session 'username'    
            $this->load->library('pagination');            
            if (!isset($_SESSION['username'])){
                // jika session 'username' blm ada, maka arahkan ke kontroller 'login'
                redirect('login');
            }
            
        }
        // halaman index dari dashboard -> menampilkan grafik statistik jumlah data buku berdasarkan kategori
        public function index(){
            $data['kategori'] = $this->book_model->getKategori();
            
            $data['countCat'] = $this->book_model->hitungkategori($data['kategori']);

            $jumlahBuku = 0;
            foreach($data['countCat'] as $countCat){
                $jumlahBuku += $countCat['jum'];
                
            }
            // baca data session 'fullname' untuk ditampilkan di view
            $data['role'] = $_SESSION['role'];
            $data['fullname'] = $_SESSION['fullname'];
            // tampilkan view 'dashboard/index'
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/index');
            $this->load->view('dashboard/footer', $data);
        }
        // method untuk menambah data buku
        public function add(){
            // panggil method getKategori() di model_book untuk membaca data list kategori dari tabel kategori untuk ditampilkan ke view
            $data['kategori'] = $this->book_model->showKategori();
            // menghitung jumlah data buku per kategori untuk ditampilkan di view
            
            $data['countBukuTeks'] = 0;
            $data['countMajalah'] = 0;
            $data['countSkripsi'] = 0;
            $data['countThesis'] = 0;
            $data['countDisertasi'] = 0;
            $data['countNovel'] = 0;
            
            // baca data session 'fullname' untuk ditampilkan di view
            $data['role'] = $_SESSION['role'];
            $data['fullname'] = $_SESSION['fullname'];
            // tampilkan view 'dashboard/add'
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/add', $data);
            $this->load->view('dashboard/footer', $data);
        }

            public function editbuku($id){
            $data['buku'] = $this->book_model->getDataBuku($id);
            // panggil method getKategori() di model_book untuk membaca data list kategori dari tabel kategori untuk ditampilkan ke view
            $data['kategori'] = $this->book_model->getKategori();
            // baca data session 'fullname' untuk ditampilkan di view
            $data['role'] = $_SESSION['role'];
            $data['fullname'] = $_SESSION['fullname'];
            // tampilkan view 'dashboard/add'
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/editbuku', $data);
            $this->load->view('dashboard/footer', $data);
        }
        // method untuk menampilkan seluruh data buku
        public function books($key=null){
            
            $config['base_url'] = site_url('dashboard/books');
            $config['total_rows'] = $this->db->count_all('books');
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
            $data['row'] = $this->book_model->getRow($config['per_page'],$data['page']);
            $data['pagination'] = $this->pagination->create_links();

            // panggil method showBook() dari book_model untuk membaca seluruh data buku
            $data['book'] = $this->book_model->showBook();
            $data['cat'] = $this->book_model->getKategori();

            $data['countBukuTeks'] = 0;
            $data['countMajalah'] = 0;
            $data['countSkripsi'] = 0;
            $data['countThesis'] = 0;
            $data['countDisertasi'] = 0;
            $data['countNovel'] = 0;
            // baca data session 'fullname' untuk ditampilkan di view
            $data['role'] = $_SESSION['role'];
            $data['fullname'] = $_SESSION['fullname'];
            $data['hitung'] = $this->book_model->count($key);
            //$data['count'] = $this->book_model->Count();

            // tampilkan view 'dashboard/books'
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/books', $data);
            $this->load->view('dashboard/footer', $data);
        }
        public function view($id){
            $data['buku'] = $this->book_model->getDataBuku($id);
            $data['kategori'] = $this->book_model->viewKategori($id);
            // baca data session 'fullname' untuk ditampilkan di view
            $data['role'] = $_SESSION['role'];
            $data['fullname'] = $_SESSION['fullname'];
            // tampilkan view 'dashboard/books'
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/view', $data);
            $this->load->view('dashboard/footer', $data);
        }

        public function kategori(){
            // panggil method showBook() dari book_model untuk membaca seluruh data buku
            $data['kategori'] = $this->book_model->showKategori();
            // baca data session 'fullname' untuk ditampilkan di view
            $data['role'] = $_SESSION['role'];
            $data['fullname'] = $_SESSION['fullname'];
            // tampilkan view 'dashboard/books'
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/kategori', $data);
            $this->load->view('dashboard/footer', $data);
        }

        public function users(){
            // panggil method showBook() dari book_model untuk membaca seluruh data buku
            $data['user'] = $this->user_model->showUser();
            // baca data session 'fullname' untuk ditampilkan di view
            $data['role'] = $_SESSION['role'];
            $data['fullname'] = $_SESSION['fullname'];
            // tampilkan view 'dashboard/books'
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/users', $data);
            $this->load->view('dashboard/footer', $data);
        }

        // method untuk proses logout
        public function logout(){
            // hapus seluruh data session
            session_destroy();
            // redirect ke kontroller 'login'
            redirect('login');
        }
}