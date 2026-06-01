<?php

use yii\db\Migration;

class m260531_224554_create_table_player_statistics_extended extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%player_statistics_extended}}',
            [
                'firstName' => $this->string(120),
                'lastName' => $this->string(120),
                'personId' => $this->integer()->notNull(),
                'gameId' => $this->integer()->notNull(),
                'gameDateTimeEst' => $this->dateTime(),
                'gameType' => $this->string(120),
                'gameLabel' => $this->string(120),
                'gameSubLabel' => $this->string(120),
                'seriesGameNumber' => $this->string(50),
                'win' => $this->integer(),
                'home' => $this->integer(),
                'playerteamId' => $this->integer(),
                'playerteamCity' => $this->string(120),
                'playerteamName' => $this->string(120),
                'opponentteamId' => $this->integer(),
                'opponentteamCity' => $this->string(120),
                'opponentteamName' => $this->string(120),
                'comment' => $this->text(),
                'startingPosition' => $this->string(120),
                'numMinutes' => $this->float(),
                'points' => $this->float(),
                'assists' => $this->float(),
                'reboundsTotal' => $this->float(),
                'steals' => $this->float(),
                'blocks' => $this->float(),
                'turnovers' => $this->float(),
                'nbaFantasyScore' => $this->float(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%player_statistics_extended}}', ['personId', 'gameId']);

        $this->createIndex('firstName_lastName', '{{%player_statistics_extended}}', ['firstName', 'lastName']);
        $this->createIndex('gameDateTimeEst', '{{%player_statistics_extended}}', ['gameDateTimeEst']);
        $this->createIndex('gameId', '{{%player_statistics_extended}}', ['gameId']);
        $this->createIndex('nbaFantasyScore', '{{%player_statistics_extended}}', ['nbaFantasyScore']);
        $this->createIndex('personId', '{{%player_statistics_extended}}', ['personId']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%player_statistics_extended}}');
    }
}
