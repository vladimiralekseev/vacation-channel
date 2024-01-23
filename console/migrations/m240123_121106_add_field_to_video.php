<?php

use yii\db\Migration;

/**
 * Class m240123_121106_add_field_to_video
 */
class m240123_121106_add_field_to_video extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('video', 'link_name', $this->string(128)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240123_121106_add_field_to_video cannot be reverted.\n";

        return false;
    }
}
