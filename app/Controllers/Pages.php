<?php

namespace App\Controllers;

class Pages extends BaseController
{
  public function index()
  {
    // menggunakan library faker
    // $faker = \Faker\Factory::create();
    // men-generate nama random
    // dd($faker->name);
    // me-generate alamat random
    // dd($faker->address);

    $data = [
      "title" => "Home | Ramz Blog",
      "kucing" => ["moezza", "bidden", "mbul"]
    ];
    return view("pages/home", $data);
  }

  public function about()
  {
    $data = [
      "title" => "About Me"
    ];
    return view("pages/about", $data);
  }

  public function contact()
  {
    $data = [
      "title" => "Contact Me",
      "alamat" => [
        [
          "tipe" => "Rumah",
          "alamat" => "Bukit Baruga",
          "kota" => "Makassar"
        ],
        [
          "tipe" => "Kampus",
          "alamat" => "ITS",
          "kota" => "Surabaya"
        ]
      ]
    ];
    return view("pages/contact", $data);
  }
}
