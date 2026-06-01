<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @property string firstName;
 * @property string lastName;
 * @property int personId;
 * @property int gameId;
 * @property string gameDateTimeEst;
 * @property string gameType;
 * @property string gameLabel;
 * @property string gameSubLabel;
 * @property string seriesGameNumber;
 * @property int win;
 * @property int home;
 * @property int playerteamId;
 * @property string playerteamCity;
 * @property string playerteamName;
 * @property int opponentteamId;
 * @property string opponentteamCity;
 * @property string opponentteamName;
 * @property string comment;
 * @property string startingPosition;
 * @property float numMinutes;
 * @property int points;
 * @property int assists;
 * @property int reboundsTotal;
 * @property int steals;
 * @property int blocks;
 * @property int turnovers;
 */
class PlayerStatistics extends ActiveRecord
{

    public $fullName;
    public $sumNbaFantasyScore;
    public $avgNumMinutes;
    public $sumPoints;
    public $sumReboundsTotal;
    public $sumAssist;
    public $sumSteals;
    public $sumBlocks;
    public $sumTurnovers;
    public $sumMinutes;
    public $lastScore;
    public $prevScore;
    public $improvement;
    public $avgLastMinutes;
    public $avgPrevMinutes;

    public function getFullNameLink(): string
    {
        return Html::a(Html::encode($this->fullName), Url::to(['/players/player', 'personId' => $this->personId]), ['class' => 'player-link']);
    }

    public static function tableName(): string
    {
        return 'player_statistics_extended';
    }

    public function rules(): array
    {
        $required =
            [
                'personId',
            ];

        return
            [
                [$required, 'required'],
            ];

    }
}
