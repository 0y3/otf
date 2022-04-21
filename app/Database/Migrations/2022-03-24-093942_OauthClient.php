<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OauthClient extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'client_id'        => ['type' => 'varchar', 'constraint' => 80],
            'client_secret'    => ['type' => 'varchar', 'constraint' => 80],
            'redirect_url'     => ['type' => 'varchar', 'constraint' => 255],
            'grant_types'      => ['type' => 'varchar', 'constraint' => 80],
            'scope'            => ['type' => 'varchar', 'constraint' => 255],
            'user_id'    	   => ['type' => 'tinyint', 'constraint' => 80],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('client_id', true);

        $this->forge->createTable('oauth_clients');
    }

    public function down()
    {
        $this->forge->dropTable('oauth_clients');
    }
}
