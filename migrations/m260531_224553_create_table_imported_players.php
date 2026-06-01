<?php

use yii\db\Migration;

class m260531_224553_create_table_imported_players extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%imported_players}}',
            [
                'personId' => $this->primaryKey(),
                'firstName' => $this->string(120),
                'lastName' => $this->string(120),
                'birthDate' => $this->date(),
                'school' => $this->string(120),
                'country' => $this->string(120),
                'heightInches' => $this->integer(),
                'bodyWeightLbs' => $this->integer(),
                'jersey' => $this->string(60),
                'guard' => $this->integer(),
                'forward' => $this->integer(),
                'center' => $this->integer(),
                'dleagueFlag' => $this->integer(),
                'nbaFlag' => $this->integer(),
                'gamesPlayedFlag' => $this->integer(),
                'draftYear' => $this->date(),
                'draftRound' => $this->integer(),
                'draftNumber' => $this->integer(),
                'fromYear' => $this->date(),
                'toYear' => $this->date(),
            ],
            $tableOptions
        );

        $dateToYearSql = "
        ALTER TABLE `imported_players`
            CHANGE COLUMN `draftYear` `draftYear` YEAR NULL DEFAULT NULL AFTER `gamesPlayedFlag`,
            CHANGE COLUMN `fromYear` `fromYear` YEAR NULL DEFAULT NULL AFTER `draftNumber`,
            CHANGE COLUMN `toYear` `toYear` YEAR NULL DEFAULT NULL AFTER `fromYear`;
";

        $this->db->createCommand($dateToYearSql)->execute();
    }

    public function safeDown()
    {
        $this->dropTable('{{%imported_players}}');
    }
}
