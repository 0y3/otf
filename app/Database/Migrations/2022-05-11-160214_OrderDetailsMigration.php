<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderDetailsMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'int','auto_increment' => true],
            'order_code'       => ['type' => 'varchar', 'constraint' => 255],
            'order_id'         => ['type' => 'int', 'constraint' => 11],
            'biz_id'           => ['type' => 'int', 'constraint' => 11],
            'biz_menu_id'      => ['type' => 'int', 'constraint' => 11,  'null' => true],
            'name'   		   => ['type' => 'varchar', 'constraint' => 255],
            'quantity'   	   => ['type' => 'int', 'constraint' => 11],
            'price'   	       => ['type' => 'float'],
            'addup_menu'       => ['type' => 'longtext', 'null' => true],
            'grant_total'      => ['type' => 'float'],
            'order_status'     => ['type' => 'ENUM', 'constraint'=> ['Pending', 'Processing', 'Dispatched', 'Delivered', 'Canceled'], 'default' => 'Pending'],
            'status'           => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 1],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
            'isdeleted'        => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->addForeignKey('order_id', 'orders', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('biz_id', 'bizs', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('biz_menu_id', 'biz_menus', 'id', false, 'CASCADE');
        $this->forge->createTable('order_details', true);
    }

    public function down()
    {
        $this->forge->dropTable('order_details', true);
    }
}
