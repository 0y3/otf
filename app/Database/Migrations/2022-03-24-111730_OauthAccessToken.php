<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OauthAccessToken extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'access_token'      => ['type' => 'varchar', 'constraint' => 80],
            'client_id'         => ['type' => 'varchar', 'constraint' => 80],
            'user_id'    	    => ['type' => 'tinyint', 'constraint' => 80],
            'scope'             => ['type' => 'varchar', 'constraint' => 255],
            'expires'           => ['type' => 'datetime'],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('access_token', true);

        $this->forge->createTable('oauth_access_tokens');
    }

    public function down()
    {
        $this->forge->dropTable('oauth_access_tokens');
    }
}
