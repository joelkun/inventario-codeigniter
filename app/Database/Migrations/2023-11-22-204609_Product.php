<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'sku' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'unique' => TRUE,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'descripcion' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'color' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'estado' => [
                'type' => 'INT',
                'constraint' => 1,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' => [
                'type' => 'DATETIME',
                null => TRUE
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('Products');
    }

    public function down()
    {
        $this->forge->dropTable('Products');
    }
}
