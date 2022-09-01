<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%media}}`.
 */
class m220901_115006_create_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%media}}', [
            'id' => $this->primaryKey(),
            'link' => $this->string()->notNull()->unique(),
            'extension' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('0 for inactive, 1 for active'),
            'note' => $this->text(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%media}}');
    }
}
