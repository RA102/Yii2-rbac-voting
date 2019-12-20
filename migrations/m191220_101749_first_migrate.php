<?php

use yii\db\Migration;

/**
 * Class m191220_101749_first_migrate
 */
class m191220_101749_first_migrate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191220_101749_first_migrate cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191220_101749_first_migrate cannot be reverted.\n";

        return false;
    }
    */
}
