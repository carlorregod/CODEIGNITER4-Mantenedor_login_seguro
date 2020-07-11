<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$now = date('Y-m-d H:i:s');
		$this->forge->addField([
        	'id'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        	'email'					=> ['type' => 'varchar', 'constraint' => 191],
            'username'             => ['type' => 'varchar', 'constraint' => 191],
        	'password'				=> ['type' => 'varchar', 'constraint' => 191],
        	'firstname'					=> ['type' => 'varchar', 'constraint' => 191],
        	'lasstname'			=> ['type' => 'varchar', 'constraint' => 191, 'null' => true],
        	'active'				=> ['type' => 'int', 'constraint' => 1, 'null' => 0, 'default' => 0],
        	'created_at'			=> ['type' => 'timestamps', 'default' => CURRENT_TIMESTAMPS],
            'updated_at'            => ['type' => 'timestamps', 'default' => CURRENT_TIMESTAMPS]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('username');
        $this->forge->createTable('users', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users', true);
	}
}
