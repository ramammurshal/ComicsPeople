<?php

namespace App\Controllers;

// use model di folder model
use \App\Models\ComicsModel;

class Comics extends BaseController
{
  // var global di dalam model
  protected $comicsModel;

  // buat construct apabila sebuah method ingin menggunakan model
  public function __construct()
  {
    $this->comicsModel = new ComicsModel();
  }

  public function index()
  {
    // findAll() -> method bawaan ci4 utk get all data
    // $comic = $this->comicsModel->findAll();

    $data = [
      "title" => "Daftar Komik",
      // getComic() tanpa slug
      "komik" => $this->comicsModel->getComic(),
    ];

    // cara konek manual ke db
    // $db = \Config\Database::connect();
    // $comic = $db->query("SELECT * FROM comics");
    // foreach ($comic->getResultArray() as $row) {
    //   d($row);
    // }

    // Dapatin data dari db pake model
    // $comicsModel = new \App\Models\ComicsModel();
    // $comicsModel = new ComicsModel();
    // $comic = $this->comicsModel->findAll();
    // dd($comic);

    return view('comics/index', $data);
  }

  public function detail($slug)
  {
    // ambil data pertama dengan slug === $slug
    // $comic = $this->comicsModel->where(["slug" => $slug])->first();
    // dd($comic);

    // $comic = $this->comicsModel->getComic($slug);
    // dd($comic);

    $data = [
      "title" => "Detail Komik",
      "komik" => $this->comicsModel->getComic($slug)
    ];

    if (empty($data["komik"])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException("Judul komik {$slug} tidak ditemukan :(");
    }

    return view('comics/detail', $data);
  }

  public function create()
  {
    // add session utk validasi input
    // session();

    $data = [
      "title" => "Form tambah data",
      // ambil validation data jika ada
      "validation" => \Config\Services::validation(),
    ];

    return view('comics/create', $data);
  }

  // tambah data
  public function save()
  {
    // request->getVar() untuk mendapatkan semua data yang dikirimkan, baik get atau post
    // dd($this->request->getVar());
    /*
      catatan:
      - apabila hanya ingin ambil data spesifik bisa seperti ini saja getVar("judul")
      - apabila hanya ingin ambil data dgn request spesifik, bisa getGet() atau getPost(), kalo getVar() bisa langsung keduanya
    */


    // melakukan validasi terhadap inputan
    if (!$this->validate([
      // melakukan validasi satu-satu sesuai kolom yang ada di database
      // pisahkan rule dengan |
      // required berarti wajib diisi, is_unique berarti harus unik dan isi harus unik terhadap kolom tabel apa 
      // "judul" => "required|is_unique[comics.judul]",

      // melakukan validasi secara lebih detail
      "judul" => [
        "rules" => "required|is_unique[comics.judul]",
        "errors" => [
          "required" => "{field} komik harus diisi",
          "is_unique" => "{field} komik sudah terdaftar",
        ]
      ],
      "sampul" => [
        // is_image dan mime_in harus digabungkan agar apabila ada user jahat yang mengubah file tertentu menjadi png, maka itu tetap akan tidak bisa 
        // di dalam [] jangan ada spasi 
        // "rules" => "uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]",
        "rules" => "max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]",
        "errors" => [
          // "uploaded" => "Pilih gambar sampul terlebih dahulu",
          "max_size" => "Ukuran gambar terlalu besar",
          "is_image" => "Yang anda pilih bukan gambar",
          "mime_in" => "Yang anda pilih bukan gambar",
        ]
      ],
    ])) {
      // mengambil pesan kesalahan
      // $validation = \Config\Services::validation();
      // dd($validation);
      // redirect dengan chaining dengan input dan validasi pesan kesalahan
      // return redirect()->to("/comics/create")->withInput()->with("validation", $validation);
      // tak coba tanpa withValidation juga jalan
      return redirect()->to("/comics/create")->withInput();
    }

    // dd($this->request->getFile('sampul'));

    // ambil gambar
    $fileSampul = $this->request->getFile("sampul");

    // perkondisian ada/tidaknya sampul
    // error = 4 artinya tidak ada gambar yang diupload
    if ($fileSampul->getError() == 4) {
      $namaSampul = "default.jpg";
    } else {
      // generate nama sampul random
      $namaSampul = $fileSampul->getRandomName();

      // pindahkan file gambar ke folder img (awalnya berada di penyimpanan ci)
      $fileSampul->move("img", $namaSampul);

      // ambil nama file (jika tidak ingin random name)
      // $namaSampul = $fileSampul->getName();
    }


    // url_title adalah fungsi bawaan CI, akan membuat sebuah string akan menjadi seperti bentuk url
    /*
      parameter1 : string mana
      parameter2 : pengganti spasinya jadi apa
      parameter3 : apakah ingin diganti jadi lowercase semua?
    */
    $slug = url_title($this->request->getVar("judul"), "-", true);
    // save method bawaan model CI utk save data ke database secara satu2
    $this->comicsModel->save([
      "judul" => $this->request->getVar("judul"),
      "slug" => $slug,
      "penulis" => $this->request->getVar("penulis"),
      "penerbit" => $this->request->getVar("penerbit"),
      "sampul" => $namaSampul
    ]);

    // menambahkan (set) flash data dalam bentuk session ketika data berhasil ditambahkan
    session()->setFlashdata("pesan", "Data berhasil ditambahkan.");

    // redirect ke halaman tertentu
    return redirect()->to("/comics");
  }

  // method to handle delete
  public function delete($id)
  {
    // cari data berdasarkan id (utk delete imgnya)
    $komik = $this->comicsModel->find($id);

    // cek jika file gambarnya default.jpg
    if ($komik["sampul"] != "default.jpg") {
      // hapus gambar pake fungsi unset
      unlink("img/" . $komik["sampul"]);
    }

    $this->comicsModel->delete($id);
    session()->setFlashdata("pesan", "Data berhasil dihapus.");
    return redirect()->to("/comics");
  }

  // method untuk hapus data
  public function edit($slug)
  {
    $data = [
      "title" => "Form Edit Data",
      "validation" => \Config\Services::validation(),
      "komik" => $this->comicsModel->getComic($slug),
    ];

    return view("comics/edit", $data);
  }

  // method utk udpdate data
  public function update($id)
  {
    // cek judul
    $komikLama = $this->comicsModel->getComic($this->request->getVar('slug'));
    if ($komikLama['judul'] == $this->request->getVar('judul')) {
      $rule_judul = "required";
    } else {
      $rule_judul = "required|is_unique[comics.judul]";
    }

    if (!$this->validate([
      "judul" => [
        "rules" => $rule_judul,
        "errors" => [
          "required" => "{field} komik harus diisi",
          "is_unique" => "{field} komik sudah terdaftar",
        ]
      ],
      "sampul" => [
        "rules" => "max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]",
        "errors" => [
          "max_size" => "Ukuran gambar terlalu besar",
          "is_image" => "Yang anda pilih bukan gambar",
          "mime_in" => "Yang anda pilih bukan gambar",
        ]
      ],
    ])) {
      return redirect()->to("/comics/edit/" . $this->request->getVar('slug'))->withInput();
    }

    // get sampul
    $fileSampul = $this->request->getFile("sampul");

    // cek gambar, apakah tetap gambar lama?

    // jika inputan kosong
    if ($fileSampul->getError() == 4) {
      $namaSampul = $this->request->getVar("sampulLama");
    } else {
      // generate nama file random
      $namaSampul = $fileSampul->getRandomName();
      // pindahkan gambar ke img
      $fileSampul->move("img", $namaSampul);
      // hapus file lama
      unlink("img/" . $this->request->getVar("sampulLama"));
    }

    $slug = url_title($this->request->getVar("judul"), "-", true);
    $this->comicsModel->save([
      // beda dengan save, di update ada id
      "id" => $id,
      "judul" => $this->request->getVar("judul"),
      "slug" => $slug,
      "penulis" => $this->request->getVar("penulis"),
      "penerbit" => $this->request->getVar("penerbit"),
      "sampul" => $namaSampul,
    ]);

    session()->setFlashdata("pesan", "Data berhasil diupdate.");

    return redirect()->to("/comics");
  }
}
