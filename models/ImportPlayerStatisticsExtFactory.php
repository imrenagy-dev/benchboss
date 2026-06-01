<?php

namespace app\models;

use yii\base\Model;

class ImportPlayerStatisticsExtFactory extends AbstractImportColumnsFilter implements ImportFactoryInterface
{

    public function createImportedClassFromCsvRow(array $csvRow): Model
    {
        $playerStat = new ImportedPlayerStatisticsExtended();

        $csvRow = $this->escapeStringColumns($csvRow);

        $numMinutesIndex = array_search('numMinutes', $this->columns, true);
        if (str_contains($csvRow[$numMinutesIndex], ':')) {
            $minsSecs = explode(":", $csvRow[$numMinutesIndex]);
            $csvRow[$numMinutesIndex] = $minsSecs[0] + round($minsSecs[1] / 60, 2);
        }


        foreach ($csvRow as $index => $csvRecord) {
            $attributeName = $this->columns[$index];

            if (str_contains($attributeName, 'DateTime') && ((int)$csvRecord < 0 || empty($csvRecord))) {
                $csvRecord = '0000-01-01 00:00:00';
            }

            if (empty($csvRecord)) {
                $csvRecord = null;
            }

            $playerStat->{$attributeName} = $csvRecord;
        }

        return $playerStat;
    }

}