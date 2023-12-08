<?php

use yii\db\Migration;

/**
 * Class m231207_202010_create_category
 */
class m231207_202010_create_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(
            'category',
            [
                'id'         => $this->primaryKey(),
                'name'       => $this->string(256)->notNull(),
                'code'       => $this->string(256)->notNull(),
                'order'      => $this->integer()->notNull(),
                'created_at' => $this->datetime()->null(),
                'updated_at' => $this->datetime()->null(),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
