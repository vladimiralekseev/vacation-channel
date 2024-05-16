<?php

use yii\db\Migration;

/**
 * Class m240516_100051_add_expiry_date_to_branson_schedule
 */
class m240516_100051_add_expiry_date_to_branson_schedule extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('branson_schedule', 'expiry_date', $this->datetime()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240516_100051_add_expiry_date_to_branson_schedule cannot be reverted.\n";

        return false;
    }
}
