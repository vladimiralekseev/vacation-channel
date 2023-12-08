<?php

use yii\db\Migration;

/**
 * Class m231207_210020_create_video
 */
class m231207_210020_create_video extends Migration
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
            'video',
            [
                'id'           => $this->primaryKey(),
                'name'         => $this->string(256)->notNull(),
                'code'         => $this->string(256)->notNull(),
                'status'       => $this->integer()->notNull(),
                'order'        => $this->integer()->notNull(),
                'youtube_code' => $this->string(256)->notNull(),
                'description'  => $this->text()->null(),
                'category_id'  => $this->integer()->null(),
                'created_at'   => $this->datetime()->null(),
                'updated_at'   => $this->datetime()->null(),
            ],
            $tableOptions
        );

        $this->createIndex(
            'idx-video-category_id',
            'video',
            'category_id'
        );

        $this->addForeignKey(
            'fk-video-category_id',
            'video',
            'category_id',
            'category',
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
        $this->dropTable('video');
    }
}
