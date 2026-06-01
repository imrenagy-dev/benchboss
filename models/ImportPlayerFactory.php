<?php

namespace app\models;

use yii\base\Model;

class ImportPlayerFactory extends AbstractImportColumnsFilter implements ImportFactoryInterface
{

    public function createImportedClassFromCsvRow(array $csvRow): Model
    {
        $player = new ImportedPlayer();

        $csvRow = $this->escapeStringColumns($csvRow);

        foreach ($csvRow as $index => $csvRecord) {
            $attributeName = $this->columns[$index];

            if (str_contains($attributeName, 'Year') && ((int)$csvRecord < 0 || empty($csvRecord))) {
                $csvRecord = 1901;
            }

            if (str_contains($attributeName, 'Date') && empty($csvRecord)) {
                $csvRecord = '0000-01-01';
            }


            if (empty($csvRecord)) {
                $csvRecord = null;
            }

            $player->{$attributeName} = $csvRecord;
        }

        return $player;
    }
}