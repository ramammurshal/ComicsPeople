<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class OrangSeeder extends Seeder
{
  public function run()
  {
    // menggunakan faker
    // $faker = \Faker\Factory::create();
    // menggunakan data orang jepang
    // $faker = \Faker\Factory::create('ja_JP');
    // menggunakan orang indonesia
    $faker = \Faker\Factory::create("id_ID");
    // utk jenis negaranya tentu saja bisa dilihat di google

    // $data = [
    // apabila pake simple query keynya bisa sembarangan dulu
    // [
    //   'nama'             => 'Rama Muhammad',
    //   'alamat'           => 'Bukit Baruga Makassar',
    //   'created_at'       => Time::now(),
    //   'updated_at'       => Time::now(),
    // ],
    // [
    //   'nama'             => 'Salsabila',
    //   'alamat'           => 'Bukit Baruga Makassar',
    //   'created_at'       => Time::now(),
    //   'updated_at'       => Time::now(),
    // ],
    // [
    //   'nama'             => 'Moezza Bidden',
    //   'alamat'           => 'Entah dimana dia',
    //   'created_at'       => Time::now(),
    //   'updated_at'       => Time::now(),
    // ],

    // apabila pake builder (harus langsung sesuai dengan field di database)
    // [
    //   'nama_orang'             => 'Rama Muhammad',
    //   'alamat_orang'           => 'Bukit Baruga Makassar',
    //   'created_at_orang'       => Time::now(),
    //   'updated_at_orang'       => Time::now(),
    // ],
    // [
    //   'nama_orang'             => 'Salsabila',
    //   'alamat_orang'           => 'Bukit Baruga Makassar',
    //   'created_at_orang'       => Time::now(),
    //   'updated_at_orang'       => Time::now(),
    // ],
    // [
    //   'nama_orang'             => 'Moezza Bidden',
    //   'alamat_orang'           => 'Entah dimana dia',
    //   'created_at_orang'       => Time::now(),
    //   'updated_at_orang'       => Time::now(),
    // ]

    // apabila menggunakan faker
    // 'nama_orang'             => $faker->name,
    // 'alamat_orang'           => $faker->address,
    // 'created_at_orang'       => Time::now(),
    // 'updated_at_orang'       => Time::now(),
    // $faker->datetime() milik faker bentuknya object, expected inputnya berupa string
    // unixTime() adalah jumlah detik yang sudah berlalu sejak 1 januari 1970 (date random), kita konvert itu pke helper ci
    // 'created_at_orang'       => Time::createFromTimestamp($faker->unixTime()),
    // 'updated_at_orang'       => Time::createFromTimestamp($faker->unixTime()),
    // ];

    for ($i = 0; $i < 50; $i++) {
      $data = [
        'nama_orang'             => $faker->name,
        'alamat_orang'           => $faker->address,
        'created_at_orang'       => Time::createFromTimestamp($faker->unixTime()),
        'updated_at_orang'       => Time::createFromTimestamp($faker->unixTime()),
      ];
      $this->db->table('orang')->insert($data);
    }

    // Simple Queries
    // $this->db->query("INSERT INTO Orang (nama_orang, alamat_orang, created_at_orang, updated_at_orang) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)", $data);

    // Using Query Builder
    // $this->db->table('orang')->insert($data);
    // $this->db->table('orang')->insertBatch($data);
  }
}
