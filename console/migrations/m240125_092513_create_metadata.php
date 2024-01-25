<?php

use yii\db\Migration;

/**
 * Class m240125_092513_create_metadata
 */
class m240125_092513_create_metadata extends Migration
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
            'meta_data',
            [
                'id'         => $this->primaryKey(),
                'title'      => $this->string(256)->null(),
                'type'       => $this->string(16)->notNull(),
                'url'        => $this->string(256)->null(),
                'video_id'   => $this->integer()->null(),
                'data'       => $this->string(1024)->notNull(),
                'created_at' => $this->datetime()->null(),
                'updated_at' => $this->datetime()->null(),
            ],
            $tableOptions
        );

        $this->createIndex('idx-meta_data-url', 'meta_data', 'url');
        $this->createIndex('idx-meta_data-video_id', 'meta_data', 'video_id');

        $this->addForeignKey(
            'fk-meta_data-video_id',
            'meta_data',
            'video_id',
            'video',
            'id',
            'SET NULL',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-meta_data-video_id', 'meta_data');
        $this->dropIndex('idx-meta_data-url', 'meta_data');
        $this->dropIndex('idx-meta_data-video_id', 'video');
        $this->dropTable('meta_data');
    }
}
