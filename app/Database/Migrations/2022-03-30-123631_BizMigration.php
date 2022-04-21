<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BizMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'int','auto_increment' => true],
            'slug'             => ['type' => 'varchar', 'constraint' => 255],
            'name'   		   => ['type' => 'varchar', 'constraint' => 255],
            //'biz_type'         => ['type' => 'varchar', 'constraint' => 12],
            'biz_type'         => ['type' => 'ENUM', 'constraint'=>['restaurant', 'grocery', 'party']],
            'description'      => ['type' => 'longtext', 'null' => true],
            'logo'             => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'image'            => ['type' => 'varchar', 'constraint' => 225, 'null' => true],
            'phone'			   => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'email'            => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'address'          => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'city_id'          => ['type' => 'int', 'constraint' => 11],
            'state_id'         => ['type' => 'int', 'constraint' => 11],
            'latitude'         => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'longitude'        => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status'           => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            // 'created_at'       => ['type' => 'datetime', 'default' => 'current_timestamp'],
            // 'updated_at'       => ['type' => 'datetime', 'default' => 'current_timestamp on update current_timestamp'],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
            'isdeleted'        => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->addUniqueKey(['name','email','slug']);
        $this->forge->addForeignKey('city_id', 'state_cities', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('state_id', 'states', 'id', false, 'CASCADE');
        $this->forge->createTable('biz', true);
    }

    public function down()
    {
        $this->forge->dropTable('biz', true);
    }
}
