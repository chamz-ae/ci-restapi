<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Murid extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'absen' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50'
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null' => 'true',
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => 'true',
            ],
            
        ]);
        $this->forge->addKey('id', true); //primary key
        $this->forge->createTable('murid');
    }

    public function down()
    {
        $this->forge->dropTable('murid');
    }
}

