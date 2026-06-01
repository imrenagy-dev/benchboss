<?php

namespace app\services;


use Yii;

class RefreshTableService
{
    public function copyTableByColumns(
        string $sourceTable,
        string $targetTable,
        array $copyColumns,
        bool $truncateTargetTable = true): int
    {
        if ($truncateTargetTable) {
            Yii::$app->db->createCommand()->truncateTable($targetTable)->execute();
        }

        $targetColumns = implode(',', array_keys($copyColumns));
        $sourceColumns = implode(',', $copyColumns);


        $sql = 'INSERT INTO ' . $targetTable . ' (' . $targetColumns . ')
                SELECT ' . $sourceColumns . '
                FROM ' . $sourceTable;
        return Yii::$app->db->createCommand($sql)->execute();
    }

    public function calculateNbaFantasyScore(): int
    {
        $sql = '
                UPDATE player_statistics_extended
                SET
                nbaFantasyScore =
                    round(
                        ifnull(points, 0)
                        + (ifnull(reboundsTotal, 0) * 1.2)
                        + (ifnull(assists, 0) * 1.5)
                        + (ifnull(steals, 0) * 3)
                        + (ifnull(blocks, 0) * 3)
                        - ifnull(turnovers, 0)
                    )';
        return Yii::$app->db->createCommand($sql)->execute();

    }

    public function fixImportedStatisticNull(): int
    {
        $affectedRows = 0;
        foreach (['points', 'reboundsTotal', 'assists', 'steals', 'blocks', 'turnovers'] as $column) {
            $sql = 'UPDATE imported_player_statistics_extended
                SET
                ' . $column . ' = 0
                    WHERE ' . $column . ' IS NULL';
            $affectedRows += Yii::$app->db->createCommand($sql)->execute();
        }
        return $affectedRows;
    }

}
