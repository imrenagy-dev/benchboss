<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int personId;
 * @property string firstName;
 * @property string lastName;
 * @property string birthDate;
 * @property string school;
 * @property string country;
 * @property int heightInches;
 * @property int bodyWeightLbs;
 * @property string jersey;
 * @property string guard;
 * @property string forward;
 * @property string center;
 * @property int dleagueFlag;
 * @property int nbaFlag;
 * @property int gamesPlayedFlag;
 * @property int draftYear;
 * @property int draftRound;
 * @property int draftNumber;
 * @property int fromYear;
 * @property int toYear;
 */
class Player extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'players';
    }

    public function rules(): array
    {
        return
            [
                ['personId', 'required']
            ];

    }
}
