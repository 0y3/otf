<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VendorMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => ['type' => 'int', 'auto_increment' => true],
            'biz_id'                => ['type' => 'int', 'constraint' => 11],
            'firstname'             => ['type' => 'varchar', 'constraint' => 255],
            'surname'   		    => ['type' => 'varchar', 'constraint' => 255],
            'gender'                => ['type' => 'varchar', 'constraint' => 255],
            'email'                 => ['type' => 'varchar', 'constraint' => 255],
            'phone'                 => ['type' => 'varchar', 'constraint' => 255],
            'password'              => ['type' => 'varchar', 'constraint' => 255],
            'confirm_email'         => ['type' => 'varchar', 'constraint' => 255],
            'status'                => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'            => ['type' => 'datetime', 'null' => true],
            'isdeleted'             => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
        ]);

        $this->forge->addPrimaryKey('id', true);      
        $this->forge->createTable('vendors', true);
    }

    public function down()
    {
        $this->forge->dropTable('vendors', true);
    }
}
