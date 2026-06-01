<?php

namespace app\models;

use yii\db\ActiveRecord;


/**
 * @property int id
 * @property string fileName
 * @property string md5
 * @property int force
 * @property DateTime timestamp
 */
class CsvImportHistory extends ActiveRecord
{
    public static function tableName()
    {
        return 'csv_import_history';
    }
}
