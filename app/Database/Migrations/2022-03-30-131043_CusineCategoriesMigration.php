<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CusineCategoriesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => ['type' => 'int', 'auto_increment' => true],
            'slug'                  => ['type' => 'varchar', 'constraint' => 255],
            'name'   		        => ['type' => 'varchar', 'constraint' => 255],
            'sort'                  => ['type' => 'int', 'constraint' => 11, 'default' => 100],
            'status'                => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 1],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'            => ['type' => 'datetime', 'null' => true],
            'isdeleted'             => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->addUniqueKey(['name','slug']);
        $this->forge->createTable('cusine_categories', true);
    }

    public function down()
    {
        $this->forge->dropTable('cusine_categories', true);
    }
    
}
