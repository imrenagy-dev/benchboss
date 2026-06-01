<?php

namespace app\common\components;

use Yii;

class SeasonHelpers
{

    public static function getActualSeason(): array
    {
        $seasons = Yii::$app->params['seasons'];
        ksort($seasons);
        return end($seasons);
    }

    public static function getActualRegularSeason(): array
    {
        return self::getActualSeason()['regular'];
    }

}