<?php

use yii\db\Migration;

/**
 * Class m191018_091630_create_post
 */
class m191018_091630_create_post extends Migration
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
        echo "m191018_091630_create_post cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('post', [
           'id' => $this->primaryKey(),
           'title' => $this->string(),
           'desctiption' => $this->text(),
            'user_id' => $this->integer(),
        ]);
    }

    public function down()
    {
        echo "m191018_091630_create_post cannot be reverted.\n";

        return false;
    }

}
