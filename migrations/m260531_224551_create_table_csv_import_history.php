<?php

use yii\db\Migration;

class m260531_224551_create_table_csv_import_history extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%csv_import_history}}',
            [
                'id' => $this->bigPrimaryKey()->unsigned(),
                'fileName' => $this->string()->notNull(),
                'md5' => $this->string(32)->notNull(),
                'force' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('0'),
                'timestamp' => $this->dateTime()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%csv_import_history}}');
    }
}
