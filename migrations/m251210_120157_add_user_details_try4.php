<?php

use yii\db\Migration;

class m251210_120157_add_user_details_try4 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'full_name', $this->string(100)->after('phone'));
        $this->addColumn('user', 'email_id', $this->string(150)->after('full_name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'full_name');
        $this->dropColumn('user', 'email_id');
    }
}
