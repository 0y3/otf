<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'int','auto_increment' => true],
            'user_id'          => ['type' => 'int', 'constraint' => 11],
            'reference'        => ['type' => 'varchar', 'constraint' => 255],
            'biz_id'           => ['type' => 'int', 'constraint' => 11],
            'user_address_id'  => ['type' => 'int', 'constraint' => 11],
            'couponcode'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'discount'         => ['type' => 'float', 'null' => true],
            'total_order'      => ['type' => 'float'],
            'delivery_fee'     => ['type' => 'float', 'null' => true],
            'payment_type'     => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'grand_total'      => ['type' => 'float'],
            'order_status'     => ['type' => 'ENUM', 'constraint'=>['Pending', 'Processing', 'Dispatched', 'Delivered', 'Canceled'], 'default' => 'Canceled'],
            'status'           => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'delivered_at'     => ['type' => 'datetime', 'null' => true],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
            'isdeleted'        => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('biz_id', 'bizs', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('user_address_id', 'user_address', 'id', false, 'CASCADE');
        $this->forge->createTable('orders', true);
    }

    public function down()
    {
        $this->forge->dropTable('orders', true);
    }
}
