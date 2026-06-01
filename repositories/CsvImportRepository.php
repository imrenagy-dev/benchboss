<?php

namespace app\repositories;

use app\models\CsvImportHistory;

class CsvImportRepository
{
    public function findImportByMd5(string $md5): static|null
    {
        return CsvImportHistory::findOne(['md5' => $md5]);
    }

    public function saveImportedCsvToHistory(string $fileName, string $md5, int $force): bool
    {
        $historyItem = new CsvImportHistory();
        $historyItem->fileName = $fileName;
        $historyItem->md5 = $md5;
        $historyItem->force = $force;
        $historyItem->timestamp = (new \DateTime())->format('Y-m-d H:i:s');
        return $historyItem->save();
    }
}