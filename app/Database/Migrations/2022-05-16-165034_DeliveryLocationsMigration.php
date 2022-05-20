<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeliveryLocationsMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => ['type' => 'int', 'auto_increment' => true],
            'fee'                   => ['type' => 'float', 'null' => true],
            'city_id'               => ['type' => 'int', 'constraint' => 11],
            'state_id'              => ['type' => 'int', 'constraint' => 11],
            'status'                => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 1],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'            => ['type' => 'datetime', 'null' => true],
            'isdeleted'             => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->addForeignKey('city_id', 'state_cities', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('state_id', 'states', 'id', false, 'CASCADE');
        $this->forge->createTable('delivery_locations', true);
    }

    public function down()
    {
        $this->forge->dropTable('delivery_locations', true);
    }
}
