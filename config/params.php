<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,

    'seasons' =>
        [
            '2025-2026' =>
                [
                    'regular' =>
                        [
                            'start' => '2025-10-21',
                            'end' => '2026-04-12',
                        ],
                    'playin' =>
                        [
                            'start' => '2026-04-14',
                            'end' => '2026-04-17',
                        ],
                    'playoff' =>
                        [
                            'start' => '2026-04-18',
                            'end' => '2026-05-30',
                        ],
                    'final' =>
                        [
                            'start' => '2026-06-03',
                            'end' => '2026-06-19',
                        ],
                ],
            '2024-2025' =>
                [
                    'regular' =>
                        [
                            'start' => '2024-10-22',
                            'end' => '2025-04-13',
                        ],
                    'playin' =>
                        [
                            'start' => '2025-04-15',
                            'end' => '2025-04-18',
                        ],
                    'playoff' =>
                        [
                            'start' => '2025-04-19',
                            'end' => '2025-05-31',
                        ],
                    'final' =>
                        [
                            'start' => '2025-06-05',
                            'end' => '2025-06-22',
                        ],
                ],
            '2023-2024' =>
                [
                    'regular' =>
                        [
                            'start' => '2023-10-24',
                            'end' => '2024-04-14',
                        ],
                    'playin' =>
                        [
                            'start' => '2024-04-16',
                            'end' => '2024-04-19',
                        ],
                    'playoff' =>
                        [
                            'start' => '2024-04-20',
                            'end' => '2024-05-30',
                        ],
                    'final' =>
                        [
                            'start' => '2024-06-06',
                            'end' => '2024-06-17',
                        ],
                ],

        ],

    'playerColumns' =>
        [
            'personId',
            'firstName',
            'lastName',
            'birthDate',
            'school',
            'country',
            'heightInches',
            'bodyWeightLbs',
            'jersey',
            'guard',
            'forward',
            'center',
            'dleagueFlag',
            'nbaFlag',
            'gamesPlayedFlag',
            'draftYear',
            'draftRound',
            'draftNumber',
            'fromYear',
            'toYear'
        ],

    'playerStringColumns' =>
        [
            'firstName',
            'lastName',
            'school',
            'country',
            'jersey'
        ],

    'playerCopyColumns' =>
        [
            'personId' => 'personId',
            'firstName' => 'firstName',
            'lastName' => 'lastName',
            'birthDate' => 'birthDate',
            'school' => 'school',
            'country' => 'country',
            'heightInches' => 'heightInches',
            'bodyWeightLbs' => 'bodyWeightLbs',
            'jersey' => 'jersey',
            'guard' => 'guard',
            'forward' => 'forward',
            'center' => 'center',
            'dleagueFlag' => 'dleagueFlag',
            'nbaFlag' => 'nbaFlag',
            'gamesPlayedFlag' => 'gamesPlayedFlag',
            'draftYear' => 'draftYear',
            'draftRound' => 'draftRound',
            'draftNumber' => 'draftNumber',
            'fromYear' => 'fromYear',
            'toYear' => 'toYear'
        ],

    'playerStatExtColumns' =>
        [
            'firstName',
            'lastName',
            'personId',
            'gameId',
            'gameDateTimeEst',
            'gameType',
            'gameLabel',
            'gameSubLabel',
            'seriesGameNumber',
            'win',
            'home',
            'playerteamId',
            'playerteamCity',
            'playerteamName',
            'opponentteamId',
            'opponentteamCity',
            'opponentteamName',
            'comment',
            'startingPosition',
            'numMinutes',
            'points',
            'assists',
            'reboundsTotal',
            'reboundsOffensive',
            'reboundsDefensive',
            'fieldGoalsMade',
            'fieldGoalsAttempted',
            'fieldGoalsPercentage',
            'threePointersMade',
            'threePointersAttempted',
            'threePointersPercentage',
            'freeThrowsMade',
            'freeThrowsAttempted',
            'freeThrowsPercentage',
            'steals',
            'blocks',
            'blocksAgainst',
            'turnovers',
            'foulsPersonal',
            'foulsAgainst',
            'plusMinusPoints',
            'doubleDouble',
            'tripleDouble',
            'estimatedOffensiveRating',
            'offensiveRating',
            'spWorkOffensiveRating',
            'estimatedDefensiveRating',
            'defensiveRating',
            'spWorkDefensiveRating',
            'estimatedNetRating',
            'netRating',
            'spWorkNetRating',
            'assistPercentage',
            'assistToTurnoverRatio',
            'assistRatio',
            'offensiveReboundPercentage',
            'defensiveReboundPercentage',
            'reboundPercentage',
            'teamTurnoverPercentage',
            'estimatedTurnoverPercentage',
            'effectiveFieldGoalPercentage',
            'trueShootingPercentage',
            'usagePercentage',
            'estimatedUsagePercentage',
            'estimatedPace',
            'pace',
            'pacePer40',
            'spWorkPace',
            'playerImpactEstimate',
            'possessions',
            'pointsOffTurnovers',
            'pointsSecondChance',
            'pointsFastBreak',
            'pointsInPaint',
            'opponentPointsOffTurnovers',
            'opponentPointsSecondChance',
            'opponentPointsFastBreak',
            'opponentPointsInPaint',
            'percentFieldGoalAttempts2Point',
            'percentFieldGoalAttempts3Point',
            'percentPoints2Point',
            'percentPoints2PointMidRange',
            'percentPoints3Point',
            'percentPointsFastBreak',
            'percentPointsFreeThrow',
            'percentPointsOffTurnovers',
            'percentPointsInPaint',
            'percentAssisted2PointMade',
            'percentUnassisted2PointMade',
            'percentAssisted3PointMade',
            'percentUnassisted3PointMade',
            'percentAssistedFieldGoalsMade',
            'percentUnassistedFieldGoalsMade',
            'percentTeamFieldGoalsMade',
            'percentTeamFieldGoalsAttempted',
            'percentTeamThreePointersMade',
            'percentTeamThreePointersAttempted',
            'percentTeamFreeThrowsMade',
            'percentTeamFreeThrowsAttempted',
            'percentTeamOffensiveRebounds',
            'percentTeamDefensiveRebounds',
            'percentTeamRebounds',
            'percentTeamAssists',
            'percentTeamTurnovers',
            'percentTeamSteals',
            'percentTeamBlocks',
            'percentTeamBlocksAgainst',
            'percentTeamFoulsPersonal',
            'percentTeamFoulsDrawn',
            'percentTeamPoints',
        ],

    'playerStatExtStringColumns' =>
        [
            'firstName',
            'lastName',
            'gameType',
            'gameLabel',
            'gameSubLabel',
            'seriesGameNumber',
            'playerteamCity',
            'playerteamName',
            'opponentteamCity',
            'opponentteamName',
            'comment',
            'startingPosition'
        ],

    'playerStatExtCopyColumns' =>
        [
            'firstName' => 'firstName',
            'lastName' => 'lastName',
            'personId' => 'personId',
            'gameId' => 'gameId',
            'gameDateTimeEst' => 'gameDateTimeEst',
            'gameType' => 'gameType',
            'gameLabel' => 'gameLabel',
            'gameSubLabel' => 'gameSubLabel',
            'seriesGameNumber' => 'seriesGameNumber',
            'win' => 'win',
            'home' => 'home',
            'playerteamId' => 'playerteamId',
            'playerteamCity' => 'playerteamCity',
            'playerteamName' => 'playerteamName',
            'opponentteamId' => 'opponentteamId',
            'opponentteamCity' => 'opponentteamCity',
            'opponentteamName' => 'opponentteamName',
            'comment' => 'comment',
            'startingPosition' => 'startingPosition',
            'points' => 'points',
            'reboundsTotal' => 'reboundsTotal',
            'assists' => 'assists',
            'steals' => 'steals',
            'blocks' => 'blocks',
            'turnovers' => 'turnovers',
            'numMinutes' => 'numMinutes',
            'nbaFantasyScore' => '0 as nbaFantasyScore'
        ],
];
