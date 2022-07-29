<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBizMenuIdAndForeignKeyToBizMenuAddupsMigration extends Migration
{
    public function up()
    {
        $fields = ['biz_menu_id' => ['type' => 'int', 'constraint' => 11],];
        $fields2 = 'CONSTRAINT biz_menu_addups_biz_menu_id_foreign FOREIGN KEY (biz_menu_id) REFERENCES biz_menus (id) ON DELETE CASCADE ';
        //$fields = ['CONSTRAINT `vendors_biz_id_foreign` FOREIGN KEY (`biz_id`) REFERENCES `biz`(`id`) ON DELETE CASCADE,'];
        
        //$this->forge->addForeignKey('biz_id', 'biz', 'id', false, 'CASCADE');  
        $this->forge->addColumn('biz_menu_addups', $fields); 
        $this->forge->addColumn('biz_menu_addups', $fields2);
    }

    public function down()
    {
        $this->forge->dropColumn('biz_menu_addups', 'biz_menu_id');
        $this->forge->dropForeignKey('biz_menu_addups','biz_menu_addups_biz_menu_id_foreign');
    }
}
