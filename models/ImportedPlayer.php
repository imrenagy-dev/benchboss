<?php

namespace app\models;

use yii\base\Model;

class ImportedPlayer extends Model
{

    public $personId;
    public $firstName;
    public $lastName;
    public $birthDate;
    public $school;
    public $country;
    public $heightInches;
    public $bodyWeightLbs;
    public $jersey;
    public $guard;
    public $forward;
    public $center;
    public $dleagueFlag;
    public $nbaFlag;
    public $gamesPlayedFlag;
    public $draftYear;
    public $draftRound;
    public $draftNumber;
    public $fromYear;
    public $toYear;

    public static function tableName(): string
    {
        return 'imported_players';
    }

    public function rules(): array
    {
        return
            [
                ['personId', 'required']
            ];

    }
}
