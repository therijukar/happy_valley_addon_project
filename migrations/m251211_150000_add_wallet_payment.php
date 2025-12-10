<?php

use yii\db\Migration;

/**
 * Class m251211_150000_add_wallet_payment
 */
class m251211_150000_add_wallet_payment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Fix for "Invalid default value for 'modified_date'" error
        $this->alterColumn('{{%payments}}', 'modified_date', $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->addColumn('{{%payments}}', 'wallet_amount', $this->decimal(10, 2)->defaultValue(0.00)->after('amount'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%payments}}', 'wallet_amount');
    }
}
