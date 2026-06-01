<?php

namespace app\repositories;

use app\common\components\SeasonHelpers;
use app\models\PlayerStatistics;
use yii\db\ActiveQueryInterface;
use yii\db\Expression;

class PlayerStatRepository
{
    public function __construct(
        private readonly PlayerStatistics $playerStatistics,
        private readonly SeasonHelpers    $seasonHelpers
    )
    {
    }

    public function getTopPlayersOfTheSeason(int $limit): array
    {
        return $this->getTopPlayersOfTheSeasonQuery($limit)->all();
    }

    public function getTopPlayersOfTheSeasonQuery(int $limit): ActiveQueryInterface
    {
        $regularSeason = $this->seasonHelpers::getActualRegularSeason();
        return $this->playerStatistics::find()
            ->select(
                [
                    'personId',
                    new Expression('CONCAT(firstName, " ", lastName) AS fullName'),
                    new Expression('ROUND(SUM(nbaFantasyScore)) AS sumNbaFantasyScore'),
                    new Expression('SUM(points) AS sumPoints'),
                    new Expression('SUM(reboundsTotal) AS sumReboundsTotal'),
                    new Expression('SUM(assists) AS sumAssist'),
                    new Expression('SUM(steals) AS sumSteals'),
                    new Expression('SUM(blocks) AS sumBlocks'),
                    new Expression('SUM(turnovers) AS sumTurnovers'),
                    new Expression('ROUND(AVG(numMinutes)) AS avgNumMinutes'),
                    new Expression('ROUND(SUM(numMinutes)) AS sumMinutes')
                ]
            )
            ->where(['BETWEEN', 'gameDateTimeEst', $regularSeason['start'], $regularSeason['end']])
            ->groupBy(['personId', "CONCAT(firstName, ' ', lastName)"])
            ->orderBy(new Expression("SUM(nbaFantasyScore) DESC"))
            ->limit($limit);
    }

    public function getBestsOfTheLastGames(int $playerLimit, int $gameLimit): array
    {
        return $this->getBestsOfTheLastGamesQuery($playerLimit, $gameLimit)->all();
    }

    public function getBestsOfTheLastGamesQuery(int $playerLimit, int $gameLimit)
    {
        $regularSeason = $this->seasonHelpers::getActualRegularSeason();
        $subQuery = "SELECT COUNT(DISTINCT stat2.gameId)
            FROM player_statistics_extended stat2
            WHERE stat2.personId = stat.personId
            AND stat2.gameId >= stat.gameId
            AND stat2.gameDateTimeEst BETWEEN
                '" . $regularSeason['start'] . "' AND
                '" . $regularSeason['end'] . "'";

        return $this->playerStatistics::find()
            ->select([
                'personId',
                new Expression('CONCAT(firstName, " ", lastName) AS fullName'),
                new Expression('ROUND(SUM(nbaFantasyScore)) AS sumNbaFantasyScore'),
                new Expression('SUM(points) AS sumPoints'),
                new Expression('SUM(reboundsTotal) AS sumReboundsTotal'),
                new Expression('SUM(assists) AS sumAssist'),
                new Expression('SUM(steals) AS sumSteals'),
                new Expression('SUM(blocks) AS sumBlocks'),
                new Expression('SUM(turnovers) AS sumTurnovers'),
                new Expression('ROUND(AVG(numMinutes)) AS avgNumMinutes'),
                new Expression('ROUND(SUM(numMinutes)) AS sumMinutes')
            ])
            ->alias('stat')
            ->where(['BETWEEN', 'stat.gameDateTimeEst', $regularSeason['start'], $regularSeason['end']])
            ->andWhere(new Expression("($subQuery) <= :gameLimit", ['gameLimit' => $gameLimit]))
            ->groupBy([
                'stat.personId',
                new Expression("CONCAT(stat.firstName, ' ', stat.lastName)"),
            ])
            ->orderBy(['ROUND(SUM(nbaFantasyScore))' => SORT_DESC])
            ->limit($playerLimit);
    }

    public function getPlayerSeasonSummary(int $personId): ?array
    {
        $regularSeason = $this->seasonHelpers::getActualRegularSeason();
        $start = $regularSeason['start'];
        $end = $regularSeason['end'];

        return $this->playerStatistics::find()
            ->select([
                'personId',
                new Expression('CONCAT(firstName, " ", lastName) AS fullName'),
                new Expression("(SELECT playerteamCity FROM player_statistics_extended WHERE personId = $personId AND gameDateTimeEst BETWEEN '$start' AND '$end' ORDER BY gameDateTimeEst DESC LIMIT 1) AS playerteamCity"),
                new Expression("(SELECT playerteamName FROM player_statistics_extended WHERE personId = $personId AND gameDateTimeEst BETWEEN '$start' AND '$end' ORDER BY gameDateTimeEst DESC LIMIT 1) AS playerteamName"),
                new Expression('ROUND(SUM(nbaFantasyScore)) AS sumNbaFantasyScore'),
                new Expression('SUM(points) AS sumPoints'),
                new Expression('SUM(reboundsTotal) AS sumReboundsTotal'),
                new Expression('SUM(assists) AS sumAssist'),
                new Expression('SUM(steals) AS sumSteals'),
                new Expression('SUM(blocks) AS sumBlocks'),
                new Expression('SUM(turnovers) AS sumTurnovers'),
                new Expression('ROUND(AVG(numMinutes)) AS avgNumMinutes'),
                new Expression('ROUND(SUM(numMinutes)) AS sumMinutes'),
                new Expression('COUNT(DISTINCT gameId) AS gamesPlayed'),
            ])
            ->where(['personId' => $personId])
            ->andWhere(['BETWEEN', 'gameDateTimeEst', $start, $end])
            ->groupBy(['personId', "CONCAT(firstName, ' ', lastName)"])
            ->asArray()
            ->one();
    }

    public function getPlayerChartData(int $personId): array
    {
        $regularSeason = $this->seasonHelpers::getActualRegularSeason();

        return $this->playerStatistics::find()
            ->select(['gameDateTimeEst', 'numMinutes', 'nbaFantasyScore'])
            ->where(['personId' => $personId])
            ->andWhere(['BETWEEN', 'gameDateTimeEst', $regularSeason['start'], $regularSeason['end']])
            ->orderBy(['gameDateTimeEst' => SORT_ASC])
            ->asArray()
            ->all();
    }

    public function getPlayerGameLogQuery(int $personId): ActiveQueryInterface
    {
        $regularSeason = $this->seasonHelpers::getActualRegularSeason();

        return $this->playerStatistics::find()
            ->where(['personId' => $personId])
            ->andWhere(['BETWEEN', 'gameDateTimeEst', $regularSeason['start'], $regularSeason['end']])
            ->orderBy(['gameDateTimeEst' => SORT_DESC]);
    }

    public function getAllPlayersQuery(string $search = ''): ActiveQueryInterface
    {
        $regularSeason = $this->seasonHelpers::getActualRegularSeason();

        $query = $this->playerStatistics::find()
            ->select([
                'personId',
                new Expression('CONCAT(firstName, " ", lastName) AS fullName'),
                new Expression('ROUND(SUM(nbaFantasyScore)) AS sumNbaFantasyScore'),
                new Expression('SUM(points) AS sumPoints'),
                new Expression('SUM(reboundsTotal) AS sumReboundsTotal'),
                new Expression('SUM(assists) AS sumAssist'),
                new Expression('SUM(steals) AS sumSteals'),
                new Expression('SUM(blocks) AS sumBlocks'),
                new Expression('SUM(turnovers) AS sumTurnovers'),
                new Expression('ROUND(AVG(numMinutes)) AS avgNumMinutes'),
                new Expression('ROUND(SUM(numMinutes)) AS sumMinutes'),
            ])
            ->where([
                'BETWEEN',
                'gameDateTimeEst',
                $regularSeason['start'],
                $regularSeason['end'],
            ])
            ->groupBy(['personId', "CONCAT(firstName, ' ', lastName)"]);

        if ($search !== '') {
            $query->andWhere(['LIKE', new Expression("CONCAT(firstName, ' ', lastName)"), $search]);
        }

        return $query;
    }

    public function getNewHopeQuery(int $playerLimit, int $gameLimit)
    {
        $regularSeason = $this->seasonHelpers::getActualRegularSeason();
        $start = $regularSeason['start'];
        $end = $regularSeason['end'];
        $prevStart = $gameLimit + 1;
        $prevEnd = $gameLimit * 2;

        $rank = "SELECT COUNT(DISTINCT stat2.gameId)
            FROM player_statistics_extended stat2
            WHERE stat2.personId = stat.personId
              AND stat2.gameId >= stat.gameId
              AND stat2.gameDateTimeEst BETWEEN '$start' AND '$end'";

        return $this->playerStatistics::find()
            ->select([
                'personId',
                new Expression("CONCAT(firstName, ' ', lastName) AS fullName"),
                new Expression("ROUND(SUM(CASE WHEN ($rank) <= $gameLimit THEN nbaFantasyScore ELSE 0 END)) AS lastScore"),
                new Expression("ROUND(SUM(CASE WHEN ($rank) BETWEEN $prevStart AND $prevEnd THEN nbaFantasyScore ELSE 0 END)) AS prevScore"),
                new Expression("ROUND(SUM(CASE WHEN ($rank) <= $gameLimit THEN nbaFantasyScore ELSE 0 END) - SUM(CASE WHEN ($rank) BETWEEN $prevStart AND $prevEnd THEN nbaFantasyScore ELSE 0 END)) AS improvement"),
                new Expression("ROUND(AVG(CASE WHEN ($rank) <= $gameLimit THEN numMinutes END)) AS avgLastMinutes"),
                new Expression("ROUND(AVG(CASE WHEN ($rank) BETWEEN $prevStart AND $prevEnd THEN numMinutes END)) AS avgPrevMinutes"),
            ])
            ->alias('stat')
            ->where(['BETWEEN', 'stat.gameDateTimeEst', $start, $end])
            ->andWhere(new Expression("($rank) <= $prevEnd"))
            ->groupBy(['stat.personId', new Expression("CONCAT(stat.firstName, ' ', stat.lastName)")])
            ->having('lastScore > prevScore AND prevScore > 0')
            ->orderBy(['improvement' => SORT_DESC])
            ->limit($playerLimit);
    }
}