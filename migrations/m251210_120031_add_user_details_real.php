<?php

use yii\db\Migration;

class m251210_120031_add_user_details_real extends Migration
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
        echo "m251210_120031_add_user_details_real cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251210_120031_add_user_details_real cannot be reverted.\n";

        return false;
    }
    */
}
