<?php

namespace App\Models;

use CodeIgniter\Model;

class ComicsModel extends Model
{
  // set table mana di database
  protected $table = "comics";

  // apabila menggunakan fitur created_at dan updated_at
  protected $useTimestamps = true;

  // rule utk memberitahu ci data mana saja yang akan kita tambahkan ke dalam database
  protected $allowedFields = ["judul", "slug", "penulis", "penerbit", "sampul"];

  // method buatan sendiri utk menangani pengambilan data dari database
  public function getComic($slug = false)
  {
    if ($slug == false) {
      return $this->findAll();
    }
    // ambil data pertama dengan slug === $slug
    return $this->where(["slug" => $slug])->first();
  }
}
