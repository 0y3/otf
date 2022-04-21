<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BizMenusMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => ['type' => 'int', 'auto_increment' => true],
            'biz_id'                => ['type' => 'int', 'constraint' => 11],
            'biz_menu_category_id'  => ['type' => 'int', 'constraint' => 11],
            'slug'                  => ['type' => 'varchar', 'constraint' => 255],
            'name'   		        => ['type' => 'varchar', 'constraint' => 255],
            'description'           => ['type' => 'longtext', 'null' => true],
            'price'                 => ['type' => 'float'],
            'image'                 => ['type' => 'varchar', 'constraint' => 225, 'null' => true],
            'menu_parent_id'        => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'sort'                  => ['type' => 'int', 'constraint' => 11, 'default' => 100],
            'status'                => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 1],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'            => ['type' => 'datetime', 'null' => true],
            'isdeleted'             => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addForeignKey('biz_id', 'biz', 'id', false, 'CASCADE');
        $this->forge->addForeignKey('biz_menu_category_id', 'biz_menu_categories', 'id', false, 'CASCADE');
        $this->forge->createTable('biz_menus', true);
    }

    public function down()
    {
        $this->forge->dropTable('biz_menus', true);
    }
}
