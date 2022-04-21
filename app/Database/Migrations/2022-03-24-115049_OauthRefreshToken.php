<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OauthRefreshToken extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'refresh_token'      => ['type' => 'varchar', 'constraint' => 40],
            'client_id'          => ['type' => 'varchar', 'constraint' => 80],
            'user_id'    	     => ['type' => 'tinyint', 'constraint' => 80],
            'scope'              => ['type' => 'varchar', 'constraint' => 255],
            'expires'            => ['type' => 'datetime'],
            // 'created_at'         => ['type' => 'datetime', 'default' => 'current_timestamp'],
            // 'updated_at'         => ['type' => 'datetime', 'default' => 'current_timestamp', 'on update' => 'current_timestamp'],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'         => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('refresh_token', true);
        $this->forge->createTable('oauth_refresh_tokens');
    }

    public function down()
    {
        $this->forge->dropTable('oauth_refresh_tokens');
    }
}
