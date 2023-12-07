<?php

use yii\db\Migration;
use yii\db\Query;

class m130524_201442_init extends Migration
{
    public function up()
    {
        try {
            $rows = (new Query())
                ->select(['id'])
                ->from('user')
                ->limit(1)
                ->all();
        } catch (Exception $e) {
            var_export($e->getMessage());
            throw new RuntimeException(
                $e->getMessage() . "\n\n" .
                "May be should run `php yii migrate --migrationPath=vendor/webvimark/module-user-management/migrations/`"
            );
        }
    }

    public function down()
    {
        return false;
    }
}
