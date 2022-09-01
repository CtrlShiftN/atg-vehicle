<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m220901_105744_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string()->unique(),
            'customer_id' => $this->bigInteger()->notNull(),
            'vehicle_id' => $this->bigInteger()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'ship_method' => $this->smallInteger(3)->notNull()->defaultValue(1)->comment('1 for RORO, 2 for container shipping, 3 for get it directly'),
            'ship_date' => $this->datetime(),
            'ship_fee'=>$this->bigInteger()->notNull()->defaultValue(0)->comment('0 for free ship'),
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
        $this->dropTable('{{%order}}');
    }
}
