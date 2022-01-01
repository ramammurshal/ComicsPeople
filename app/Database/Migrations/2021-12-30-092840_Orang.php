<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orang extends Migration
{
  // method up utk membuat skema db, method down utk menghapus
  public function up()
  {
    $this->forge->addField([
      'id_orang' => [
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => true, /* unsigned utk positif semua */
        'auto_increment' => true,
      ],
      'nama_orang' => [
        'type'           => 'VARCHAR',
        'constraint'     => '255',
      ],
      'alamat_orang' => [
        'type'           => 'VARCHAR',
        'constraint'     => '255',
      ],
      'created_at_orang' => [
        'type'           => 'DATETIME',
        'null'           => TRUE,
      ],
      'updated_at_orang' => [
        'type'           => 'DATETIME',
        'null'           => TRUE,
      ],
    ]);
    $this->forge->addKey('id_orang', true);
    $this->forge->createTable('orang');
  }

  public function down()
  {
    $this->forge->dropTable('orang');
  }
}
