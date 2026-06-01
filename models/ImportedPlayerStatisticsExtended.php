<?php

namespace app\models;

use yii\base\Model;

class ImportedPlayerStatisticsExtended extends Model
{

    public $firstName;
    public $lastName;
    public $personId;
    public $gameId;
    public $gameDateTimeEst;
    public $gameType;
    public $gameLabel;
    public $gameSubLabel;
    public $seriesGameNumber;
    public $win;
    public $home;
    public $playerteamId;
    public $playerteamCity;
    public $playerteamName;
    public $opponentteamId;
    public $opponentteamCity;
    public $opponentteamName;
    public $comment;
    public $startingPosition;
    public $numMinutes;
    public $points;
    public $assists;
    public $reboundsTotal;
    public $reboundsOffensive;
    public $reboundsDefensive;
    public $fieldGoalsMade;
    public $fieldGoalsAttempted;
    public $fieldGoalsPercentage;
    public $threePointersMade;
    public $threePointersAttempted;
    public $threePointersPercentage;
    public $freeThrowsMade;
    public $freeThrowsAttempted;
    public $freeThrowsPercentage;
    public $steals;
    public $blocks;
    public $blocksAgainst;
    public $turnovers;
    public $foulsPersonal;
    public $foulsAgainst;
    public $plusMinusPoints;
    public $doubleDouble;
    public $tripleDouble;
    public $estimatedOffensiveRating;
    public $offensiveRating;
    public $spWorkOffensiveRating;
    public $estimatedDefensiveRating;
    public $defensiveRating;
    public $spWorkDefensiveRating;
    public $estimatedNetRating;
    public $netRating;
    public $spWorkNetRating;
    public $assistPercentage;
    public $assistToTurnoverRatio;
    public $assistRatio;
    public $offensiveReboundPercentage;
    public $defensiveReboundPercentage;
    public $reboundPercentage;
    public $teamTurnoverPercentage;
    public $estimatedTurnoverPercentage;
    public $effectiveFieldGoalPercentage;
    public $trueShootingPercentage;
    public $usagePercentage;
    public $estimatedUsagePercentage;
    public $estimatedPace;
    public $pace;
    public $pacePer40;
    public $spWorkPace;
    public $playerImpactEstimate;
    public $possessions;
    public $pointsOffTurnovers;
    public $pointsSecondChance;
    public $pointsFastBreak;
    public $pointsInPaint;
    public $opponentPointsOffTurnovers;
    public $opponentPointsSecondChance;
    public $opponentPointsFastBreak;
    public $opponentPointsInPaint;
    public $percentFieldGoalAttempts2Point;
    public $percentFieldGoalAttempts3Point;
    public $percentPoints2Point;
    public $percentPoints2PointMidRange;
    public $percentPoints3Point;
    public $percentPointsFastBreak;
    public $percentPointsFreeThrow;
    public $percentPointsOffTurnovers;
    public $percentPointsInPaint;
    public $percentAssisted2PointMade;
    public $percentUnassisted2PointMade;
    public $percentAssisted3PointMade;
    public $percentUnassisted3PointMade;
    public $percentAssistedFieldGoalsMade;
    public $percentUnassistedFieldGoalsMade;
    public $percentTeamFieldGoalsMade;
    public $percentTeamFieldGoalsAttempted;
    public $percentTeamThreePointersMade;
    public $percentTeamThreePointersAttempted;
    public $percentTeamFreeThrowsMade;
    public $percentTeamFreeThrowsAttempted;
    public $percentTeamOffensiveRebounds;
    public $percentTeamDefensiveRebounds;
    public $percentTeamRebounds;
    public $percentTeamAssists;
    public $percentTeamTurnovers;
    public $percentTeamSteals;
    public $percentTeamBlocks;
    public $percentTeamBlocksAgainst;
    public $percentTeamFoulsPersonal;
    public $percentTeamFoulsDrawn;
    public $percentTeamPoints;

    public static function tableName(): string
    {
        return 'imported_player_statistics_extended';
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
