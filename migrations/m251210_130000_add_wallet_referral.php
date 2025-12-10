<?php

use yii\db\Migration;

/**
 * Class m251210_130000_add_wallet_referral
 */
class m251210_130000_add_wallet_referral extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Add columns to user table
        $this->addColumn('{{%user}}', 'wallet_balance', $this->decimal(10, 2)->defaultValue(0.00)->after('status'));
        $this->addColumn('{{%user}}', 'referral_code', $this->string(50)->unique()->after('wallet_balance'));
        $this->addColumn('{{%user}}', 'referred_by', $this->integer()->defaultValue(null)->after('referral_code'));
        $this->addColumn('{{%user}}', 'is_referral_rewarded', $this->boolean()->defaultValue(0)->after('referred_by'));

        // Create wallet_transactions table
        $this->createTable('{{%wallet_transactions}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'type' => $this->string(20)->notNull(), // 'credit', 'debit'
            'description' => $this->string(255),
            'created_at' => $this->integer()->notNull(),
        ]);

        // Create settings table
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'key_name' => $this->string(100)->unique()->notNull(),
            'value' => $this->string(255)->notNull(),
        ]);

        // Insert default referral bonus
        $this->insert('{{%settings}}', [
            'key_name' => 'referral_bonus',
            'value' => '10',
        ]);
        
        // Index for user_id in wallet_transactions
        $this->createIndex(
            'idx-wallet_transactions-user_id',
            '{{%wallet_transactions}}',
            'user_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
        $this->dropTable('{{%wallet_transactions}}');
        $this->dropColumn('{{%user}}', 'is_referral_rewarded');
        $this->dropColumn('{{%user}}', 'referred_by');
        $this->dropColumn('{{%user}}', 'referral_code');
        $this->dropColumn('{{%user}}', 'wallet_balance');
    }
}
