<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeBizTableNameMigration extends Migration
{
    public function up()
    {
        $this->forge->renameTable('biz', 'bizs');
    }

    public function down()
    {
        //
    }
}
