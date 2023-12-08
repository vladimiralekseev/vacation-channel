<?php

use yii\db\Migration;

/**
 * Class m231208_162154_add_fields_to_video
 */
class m231208_162154_add_fields_to_video extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('video', 'link', $this->string(256)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231208_162154_add_fields_to_video cannot be reverted.\n";

        return false;
    }
}
