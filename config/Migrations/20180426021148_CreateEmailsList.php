<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateEmailsList extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('emails_list');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('image', 'text', [
            'default' => null,
            'limit' => MysqlAdapter::TEXT_LONG,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('deleted_at', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addIndex([
            'email',
        ], [
            'name' => 'UNIQUE_EMAIL',
            'unique' => true,
        ]);
        $table->create();
    }
}
