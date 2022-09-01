<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vehicle}}`.
 */
class m220901_021202_create_vehicle_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vehicle}}', [
            'id' => $this->primaryKey(),
            'SKU' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'image_id' => $this->bigInteger()->notNull(),
            'image_related' => $this->string()->notNull(),
            'manufacturer' => $this->bigInteger()->notNull(),
            'model' => $this->string()->notNull(),
            'series' => $this->string(),
            'color' => $this->bigInteger()->notNull(),
            'engine_number' => $this->string()->notNull(),
            'fuel_capacity' => $this->double(5)->notNull(),
            'manufacture_date' => $this->string()->notNull(),
            'original_price' => $this->bigInteger()->notNull(),
            'selling_price' => $this->bigInteger()->notNull(),
            'discount' => $this->double()->defaultValue(0),
            'total_quantity' => $this->integer()->notNull(),
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
        $this->dropTable('{{%vehicle}}');
    }
}
