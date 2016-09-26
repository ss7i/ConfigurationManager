<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        $this->table('configurations', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('category', 'string', [
                'default' => null,
                'limit' => 15,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('value', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('editable', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 250,
                'null' => true,
            ])
            ->addColumn('type', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('options', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('default_value', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('configurations');
    }
}
