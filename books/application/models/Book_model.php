<?php

class Book_model extends CI_Model {

	// method untuk menampilkan data buku
	public function showBook($id = false){
		// membaca semua data buku dari tabel 'books'
		if ($id == false){
			$query = $this->db->query("SELECT books.*,kategori.kategori FROM books,kategori WHERE books.idkategori=kategori.idkategori");
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('books', array("idbuku" => $id));
			return $query->row_array();
		}
	}

	public function showKategori($id = false){
		// membaca semua data buku dari tabel 'books'
		if ($id == false){
			$query = $this->db->get('kategori');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('kategori', array("idkategori" => $id));
			return $query->row_array();
		}
	}

	public function showKategori2($id){
		$query = $this->db->get_where('kategori', array("idkategori" => $id));
			return $query->row_array();
	}	

	// method untuk hapus data buku berdasarkan id
	public function delBook($id){
		$this->db->delete('books', array("idbuku" => $id));
	}

	public function delKategori($id){
		$this->db->delete('kategori', array("idkategori" => $id));
	}

	public function count($key=false){
		$query = $this->db->query("SELECT COUNT(*) as 'jml' FROM books");
		return $query->row()->jml;
	}

	public function findcount($key){
		$query = $this->db->query("SELECT COUNT(*) as 'jml' FROM books,kategori WHERE books.idkategori=kategori.idkategori AND (judul LIKE '%$key%' 
									OR pengarang LIKE '%$key%' 
									OR penerbit LIKE '%$key%'
									OR sinopsis LIKE '%$key%'
									OR thnterbit LIKE '%$key%'
									OR kategori LIKE '%$key%')");
		return $query->row()->jml;
	}

	public function findcount2($key=null){
		$query = $this->db->query("SELECT COUNT(*) as 'jml' FROM books WHERE judul LIKE '%$key%' 
									OR pengarang LIKE '%$key%' 
									OR penerbit LIKE '%$key%'
									OR sinopsis LIKE '%$key%'
									OR thnterbit LIKE '%$key%'");
		return $query->row()->jml;
	}

	// method untuk mencari data buku berdasarkan key
	public function findBook($key){

		$query = $this->db->query("SELECT books.*,kategori.kategori FROM books,kategori WHERE books.idkategori=kategori.idkategori AND (judul LIKE '%$key%' 
									OR pengarang LIKE '%$key%' 
									OR penerbit LIKE '%$key%'
									OR sinopsis LIKE '%$key%'
									OR thnterbit LIKE '%$key%'
									OR kategori LIKE '%$key%')");
		return $query->result_array();
	}

	public function findKategori($key){

		$query = $this->db->query("SELECT * FROM kategori WHERE idkategori LIKE '%$key%' 
									OR kategori LIKE '%$key%'");
		return $query->result_array();
	}

	// method untuk insert data buku ke tabel 'books'
	public function insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename){
		$data = array(
					"judul" => $judul,
					"pengarang" => $pengarang,
					"penerbit" => $penerbit,
					"sinopsis" => $sinopsis,
					"idkategori" => $idkategori,
					"thnterbit" => $thnterbit,
					"imgfile" => $filename
		);
		$query = $this->db->insert('books', $data);
	}

	public function insertKat($kategori){
		$query = $this->db->query("INSERT INTO kategori VALUES ('','$kategori')");
	}

	public function updateKat($idkategori,$kategori){
		$data = array("idkategori"=> $idkategori,
						"kategori" => $kategori);
		$this->db->where('idkategori',$idkategori);
		$query = $this->db->update('kategori',$data);
	}

	public function updateBook($id,$judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename){
		$data = array(
					"idbuku" => $id,
					"judul" => $judul,
					"pengarang" => $pengarang,
					"penerbit" => $penerbit,
					"idkategori" => $idkategori,
					"imgfile" => $filename,
					"sinopsis" => $sinopsis,
					"thnterbit" => $thnterbit
		);
		$this->db->where('idbuku', $id);
		$query = $this->db->update('books', $data);
	}

	public function getDataBuku($id){
		$query = $this->db->query("SELECT * FROM books WHERE idbuku='$id'");
		return $query->result_array();
	}

	// method untuk membaca data kategori buku dari tabel 'kategori'
	public function getKategori(){
		$query = $this->db->get('kategori');
		return $query->result_array();
	}

	public function viewKategori($id){
		$query = $this->db->query("SELECT kategori FROM books,kategori WHERE books.idkategori=kategori.idkategori AND idbuku=$id");
		return $query->result_array();
	}

	// method untuk menghitung jumlah buku berdasarkan idkategori
	public function countByCat($idkategori){
		$query = $this->db->query("SELECT count(*) as jum FROM books WHERE idkategori = '$idkategori'");
		return $query->row()->jum;
	}

	public function getRow($limit, $start){
        $query = $this->db->get('books', $limit, $start);
        return $query->result_array();
    }

	public function hitungkategori($kategori){
		$i = 0;
		foreach ($kategori as $kate_item) {
			$idkategori = $kate_item['idkategori'];
			$query = $this->db->query("SELECT count(*) as jum FROM books WHERE idkategori = '$idkategori'");
			$kat['idkategori'] = $kate_item['idkategori'];
			$kat['kategori'] = $kate_item['kategori'];
			$kat['jum'] = $query->row()->jum;
			$kate[$i] = $kat;
			$i++;
 		}
	return $kate;
	}

}
?>