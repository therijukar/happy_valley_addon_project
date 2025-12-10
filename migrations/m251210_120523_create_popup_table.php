<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%popup}}`.
 */
class m251210_120523_create_popup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%popup}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'image_url' => $this->string()->notNull(),
            'status' => $this->boolean()->defaultValue(1),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%popup}}');
    }
}
