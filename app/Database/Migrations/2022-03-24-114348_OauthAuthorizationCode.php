<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OauthAuthorizationCode extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'authorization_code' => ['type' => 'varchar', 'constraint' => 40],
            'id_token'           => ['type' => 'varchar', 'constraint' => 255],
            'client_id'          => ['type' => 'varchar', 'constraint' => 80],
            'user_id'    	     => ['type' => 'tinyint', 'constraint' => 80],
            'redirect_url'       => ['type' => 'varchar', 'constraint' => 255],
            'scope'              => ['type' => 'varchar', 'constraint' => 255],
            'expires'            => ['type' => 'datetime'],
            // 'created_at'         => ['type' => 'datetime', 'default' => 'current_timestamp'],
            // 'updated_at'         => ['type' => 'datetime', 'default' => 'current_timestamp', 'on update' => 'current_timestamp'],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('authorization_code', true);

        $this->forge->createTable('oauth_authorization_codes');
    }

    public function down()
    {
        $this->forge->dropTable('oauth_authorization_codes');
    }
}
