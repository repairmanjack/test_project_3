<?php

use yii\db\Migration;

/**
 * Class m181214_204825_add_tables
 */
class m181214_204825_add_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('item', [
            'id' => $this->primaryKey(),
            'branch_id' => $this->integer(),
            'name' => $this->string(255),
            'description' => $this->text(),
            'sold' => $this->boolean()
        ]);
        $this->createIndex('sold', 'item', 'sold');
        $this->createTable('branch', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)
        ]);
        $this->addForeignKey('branch_id', 'item', 'branch_id', 'branch', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('branch_id', 'item');
        $this->dropTable('branch');
        $this->dropTable('item');
    }
}
