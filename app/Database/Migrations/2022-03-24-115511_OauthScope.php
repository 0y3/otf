<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OauthScope extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'scope'             => ['type' => 'varchar', 'constraint' => 255],
            'is_default'        => ['type' => 'BOOLEAN'],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'        => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('scope', true);
        $this->forge->createTable('oauth_scopes');
    }

    public function down()
    {
        $this->forge->dropTable('oauth_scopes');
    }
}
