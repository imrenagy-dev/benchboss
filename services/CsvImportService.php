<?php

namespace app\services;

use app\models\ImportFactoryInterface;
use app\repositories\CsvImportRepository;
use app\common\components\EmptyLogger;
use Yii;

class CsvImportService
{
    public function __construct(private readonly CsvImportRepository $repo)
    {
    }

    public function isImportedCsv(string $fileName): bool
    {
        $md5 = md5_file($fileName);
        return $this->repo->findImportByMd5($md5) !== null;
    }

    public function saveImportedCsvToHistory(string $fileName, int $force): bool
    {
        $md5 = md5_file($fileName);
        return $this->repo->saveImportedCsvToHistory($fileName, $md5, $force);
    }

    public function getFirstRowFromCsv(string $fileName): array|false
    {
        $fpCsv = fopen($fileName, 'r');
        $firstRow = fgetcsv($fpCsv, 0);
        fclose($fpCsv);

        return $firstRow;
    }

    public function importFromCsv(string $fileName, string $tableName, array $columns, ImportFactoryInterface $factory): bool
    {
        $fpCsv = fopen($fileName, 'r');
        $csvRow = fgetcsv($fpCsv, 0);

        if (empty($csvRow)) {
            return false;
        }

        Yii::setLogger(new EmptyLogger());

        Yii::$app->db->createCommand()->truncateTable($tableName)->execute();

        $line = 1;
        $importArray = [];
        $dotInterval = 200;
        $sqlInterval = 1000;
        $sleepInterval = 10000;
        $successCount = 0;
        $failCount = 0;
        $errorMessages = [];

        $this->showUsedMemory("memory importFromCsv - start while loop: ");
        while ($csvRow = fgetcsv($fpCsv, 0)) {
            $line++;

            $importClass = $factory->createImportedClassFromCsvRow($csvRow);
            $isValid = $importClass->validate();
            if (!$isValid) {
                var_dump($importClass->getErrors());
                $errorMessages[] = $importClass->getErrors();
                $failCount++;
                if ($failCount >= 10) {
                    fclose($fpCsv);
                    echo "Too many validation issue - break import\n";
                    var_dump($errorMessages);
                    echo "\n";
                    exit();
                }
                continue;
            }

            if (($line % $dotInterval) === 0) {
                echo ".";
            }

            $importArray[] = $importClass->toArray();

            if (($line % $sqlInterval) === 0) {
                echo "\nProcessed - " . $line . " lines\n";
                $this->showUsedMemory("memory after new 1000 item batch : ");
                echo "\n";
                Yii::$app->db->createCommand()
                    ->batchInsert($tableName, $columns, $importArray)
                    ->execute();

                if (($line % $sleepInterval) === 0) {
                    echo "--\n";
                    sleep(1);
                }

                unset($importArray);
                $importArray = [];
                $this->showUsedMemory("memory after batchInsert : ");

            }

            $successCount++;
        }

        if (count($importArray)) {
            echo "\nProcessed - " . $line . " lines\n";
            Yii::$app->db->createCommand()
                ->batchInsert($tableName, $columns, $importArray)
                ->execute();
        }

        $this->showUsedMemory("Final memory usage: ");

        echo "\n";
        echo "\n--------------------------------------------------------------\n";
        echo "Imported: " . number_format($successCount, 0, "") . " ; Failed: " . $failCount;
        echo "\n--------------------------------------------------------------\n";
        if ($failCount > 0) {
            echo "Check the logs!";
        }

        fclose($fpCsv);

        return $line > 0;
    }

    private function showUsedMemory(string $message): void
    {
        echo $message . round(memory_get_peak_usage(true) / 1000000, 2) . " Mbyte";
    }

}
