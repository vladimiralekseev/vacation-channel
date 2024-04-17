<?php

use yii\db\Migration;

/**
 * Class m240417_132715_create_branson_schedule
 */
class m240417_132715_create_branson_schedule extends Migration
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
            'branson_schedule',
            [
                'id'          => $this->primaryKey(),
                'title'       => $this->string(256)->notNull(),
                'type'        => $this->string(16)->notNull(),
                'external_id' => $this->integer()->notNull(),
                'order'       => $this->integer()->notNull()->defaultValue(500),
                'url'         => $this->string(1024)->null(),
                'created_at'  => $this->datetime()->null(),
                'updated_at'  => $this->datetime()->null(),
            ],
            $tableOptions
        );

        $this->createIndex('idx-branson_schedule-external_id', 'branson_schedule', 'external_id');
    }

    public function safeDown()
    {
        echo "m240417_132715_create_branson_schedule cannot be reverted.\n";

        return false;
    }
}
