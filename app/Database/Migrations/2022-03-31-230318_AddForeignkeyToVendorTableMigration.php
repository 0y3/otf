<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignkeyToVendorTableMigration extends Migration
{
    public function up()
    {
        $fields= 'CONSTRAINT vendors_biz_id_foreign FOREIGN KEY (biz_id) REFERENCES biz (id) ON DELETE CASCADE ';
        //$fields = ['CONSTRAINT `vendors_biz_id_foreign` FOREIGN KEY (`biz_id`) REFERENCES `biz`(`id`) ON DELETE CASCADE,'];
        
        //$this->forge->addForeignKey('biz_id', 'biz', 'id', false, 'CASCADE');   
        $this->forge->addColumn('vendors',$fields);
    }

    public function down()
    {
        $this->forge->dropForeignKey('vendors','vendors_biz_id_foreign');
    }
}
