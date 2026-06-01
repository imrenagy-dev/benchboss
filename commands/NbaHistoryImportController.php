<?php

namespace app\commands;

use app\models\ImportedPlayer;
use app\models\ImportedPlayerStatisticsExtended;
use app\models\ImportFactoryInterface;
use app\models\ImportPlayerFactory;
use app\models\ImportPlayerStatisticsExtFactory;
use app\models\Player;
use app\models\PlayerStatistics;
use app\services\RefreshTableService;
use yii\console\Controller;
use yii\console\ExitCode;
use Yii;

/**
 * Thist command import historical nba csv files from https://www.kaggle.com/datasets/eoinamoore/historical-nba-data-and-player-box-scores
 */
class NbaHistoryImportController extends Controller
{
    private readonly RefreshTableService $refreshTableService;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->refreshTableService = Yii::$container->get(\app\services\RefreshTableService::class);
    }

    /**
     * First parameter - filename (dont import if md5 is in import history), Second parameter - ignore md5 check
     * ~ 60+ Mbyte
     * @return int Exit code
     */
    public function actionPlayers(string $fileName, int $force = 0): int
    {
        $playerColumns = Yii::$app->params['playerColumns'];
        $playerStringColumns = Yii::$app->params['playerStringColumns'];
        $copyColumns = Yii::$app->params['playerCopyColumns'];

        $factory = new ImportPlayerFactory($playerColumns, $playerStringColumns);
        $importTable = ImportedPlayer::tableName();
        $playerTable = Player::tableName();
        $isImported = $this->importStatistics($fileName, $force, $playerColumns, $importTable, $factory);
        if ($isImported !== ExitCode::OK) {
            return $isImported;
        }

        return $this->refreshTable($importTable, $playerTable, $copyColumns);
    }

    /**
     * First parameter - filename (dont import if md5 is in import history), Second parameter - ignore md5 check
     * ~ 450+ Mbyte
     * @return int Exit code
     */
    public function actionPlayerStatisticsExtended(string $fileName, int $force = 0): int
    {
        $playerStatExtColumns = Yii::$app->params['playerStatExtColumns'];
        $playerStatExtStringColumns = Yii::$app->params['playerStatExtStringColumns'];
        $copyColumns = Yii::$app->params['playerStatExtCopyColumns'];

        $factory = new ImportPlayerStatisticsExtFactory($playerStatExtColumns, $playerStatExtStringColumns);
        $importTable = ImportedPlayerStatisticsExtended::tableName();
        $statTable = PlayerStatistics::tableName();
        $isImported = $this->importStatistics($fileName, $force, $playerStatExtColumns, $importTable, $factory);
        if ($isImported !== ExitCode::OK) {
            return $isImported;
        }

        $resultOfFixes = $this->refreshTableService->fixImportedStatisticNull();
        if ($resultOfFixes === 0) {
            echo "Nothing to fixed\n";
        } else {
            echo "Fixed " . number_format($resultOfFixes, 0, "") . " items\n";
        }

        $resultOfRefresh = $this->refreshTable($importTable, $statTable, $copyColumns);
        if ($resultOfRefresh !== ExitCode::OK) {
            return $resultOfRefresh;
        }

        if ($this->refreshTableService->calculateNbaFantasyScore() < 1) {
            echo "Calculating NBA Fantasy score failed\n";
            return ExitCode::UNSPECIFIED_ERROR;
        }

        return ExitCode::OK;
    }

    private function importStatistics(
        string $fileName,
        int $force,
        array $colNames,
        string $tableName,
        ImportFactoryInterface $factory
    ): int
    {
        if (!file_exists($fileName)) {
            echo "File does not exists! [" . $fileName . "]";
            return ExitCode::IOERR;
        }

        $service = Yii::$container->get(\app\services\CsvImportService::class);
        if ($force === 0 && $service->isImportedCsv($fileName)) {
            echo "File is already imported!";
            return ExitCode::IOERR;
        }

        $firstCsvRow = $service->getFirstRowFromCsv($fileName);

        if ($firstCsvRow !== $colNames) {
            echo "File header is not the same as the config!";
            echo implode(",", array_diff($colNames, $firstCsvRow));
            return ExitCode::IOERR;
        }

        if (!$service->importFromCsv($fileName, $tableName, $colNames, $factory)) {
            echo "Import failed!";
            return ExitCode::IOERR;
        }

        $service->saveImportedCsvToHistory($fileName, $force);
        return ExitCode::OK;
    }

    public function refreshTable(string $importTable, string $targetTable, mixed $copyColumns): int
    {
        $countOfCopied = $this->refreshTableService->copyTableByColumns($importTable, $targetTable, $copyColumns);
        if ($countOfCopied) {
            echo "Copied items: " . number_format($countOfCopied, 0, "") . "\n";
            return ExitCode::OK;
        }

        echo "Nothing copied\n";
        return ExitCode::UNSPECIFIED_ERROR;
    }
}
