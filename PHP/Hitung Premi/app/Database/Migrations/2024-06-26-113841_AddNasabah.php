<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNasabah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'agen' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_nasabah' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'periode_dari' => [
                'type' => 'DATE',
            ],
            'periode_sampai' => [
                'type' => 'DATE',
            ],
            'pertanggungan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'harga_pertanggungan' => [
                'type' => 'DECIMAL',
            ],
            'jenis_pertanggungan' => [
                'type' => 'INT',
            ],
            'risiko_pertanggungan_banjir' => [
                'type' => 'BOOLEAN',
            ],
            'risiko_pertanggungan_gempa' => [
                'type' => 'BOOLEAN',
            ],
            'periode_tanggungan' => [
                'type' => 'int',
            ],
            'premi_kendaraan' => [
                'type' => 'decimal',
            ],
            'premi_banjir' => [
                'type' => 'decimal',
            ],
            'premi_gempa' => [
                'type' => 'decimal',
            ],
            'total_premi' => [
                'type' => 'decimal',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('nasabah');
    }

    public function down()
    {
        $this->forge->dropTable('nasabah');
    }
}
