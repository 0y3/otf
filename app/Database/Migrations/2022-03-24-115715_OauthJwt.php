<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OauthJwt extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'client_id'         => ['type' => 'varchar', 'constraint' => 80],
            'subject'           => ['type' => 'varchar', 'constraint' => 80],
            'public_key'        => ['type' => 'varchar', 'constraint' => 255],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'        => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->createTable('oauth_jwt');
    }

    public function down()
    {
        $this->forge->dropTable('oauth_jwt');
    }
}
