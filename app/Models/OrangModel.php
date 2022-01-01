<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangModel extends Model
{
  protected $table = "orang";
  protected $useTimestamps = true;
  protected $allowedFields = ["nama_orang", "alamat_orang"];

  public function search($keyword)
  {
    // $builder = $this->table("orang");
    // $builder->like("nama_orang", $keyword);
    // return $builder;

    // return $this->table("orang")->like("nama_orang", $keyword);
    return $this->table("orang")->like("nama_orang", $keyword)->orLike("alamat_orang", $keyword);
  }
}
