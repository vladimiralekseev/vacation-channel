<?php

use yii\db\Migration;

/**
 * Class m231220_210045_add_field_to_category
 */
class m231220_210045_add_field_to_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'menu', $this->smallInteger()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231220_210045_add_field_to_category cannot be reverted.\n";

        return false;
    }
}
