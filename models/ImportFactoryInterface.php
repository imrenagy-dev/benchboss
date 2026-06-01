<?php

namespace app\models;

use yii\base\Model;

interface ImportFactoryInterface
{
    public function createImportedClassFromCsvRow(array $csvRow): Model;
}