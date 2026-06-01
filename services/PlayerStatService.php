<?php

namespace app\services;


use app\repositories\PlayerStatRepository;
use yii\db\ActiveQueryInterface;

class PlayerStatService
{
    public function __construct(private readonly PlayerStatRepository $playerRepo)
    {
    }

    public function getTopPlayersOfTheSeasonQuery(int $limit): ActiveQueryInterface
    {
        return $this->playerRepo->getTopPlayersOfTheSeasonQuery($limit);
    }

    public function getBestsOfTeLastGamesQuery(int $playerLimit, int $gameLimit): ActiveQueryInterface
    {
        return $this->playerRepo->getBestsOfTheLastGamesQuery($playerLimit, $gameLimit);;

    }

    public function getPlayerSeasonSummary(int $personId): ?array
    {
        return $this->playerRepo->getPlayerSeasonSummary($personId);
    }

    public function getPlayerChartData(int $personId): array
    {
        $rows = $this->playerRepo->getPlayerChartData($personId);

        $labels = [];
        $minutes = [];
        $fantasy = [];

        foreach ($rows as $row) {
            $labels[] = (new \DateTime($row['gameDateTimeEst']))->format('Y-m-d');
            $minutes[] = round((float)$row['numMinutes'], 1);
            $fantasy[] = round((float)$row['nbaFantasyScore'], 1);
        }

        return compact('labels', 'minutes', 'fantasy');
    }

    public function getPlayerGameLogQuery(int $personId): ActiveQueryInterface
    {
        return $this->playerRepo->getPlayerGameLogQuery($personId);
    }

    public function getAllPlayersQuery(string $search = ''): ActiveQueryInterface
    {
        return $this->playerRepo->getAllPlayersQuery($search);
    }

    public function getNewHopeQuery(int $playerLimit, int $gameLimit)
    {
        return $this->playerRepo->getNewHopeQuery($playerLimit, $gameLimit);
    }

}
