<?php

namespace app\controllers;


use app\services\PlayerStatService;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class PlayersController extends Controller
{
    private PlayerStatService $playerService;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->playerService = Yii::$container->get(PlayerStatService::class);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'pageCache' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['bestoflastgame', 'top20', 'newhope'],
                'duration' => 300,
                'variations' => [
                    Yii::$app->request->get('playerlimit', 10),
                    Yii::$app->request->get('gamelimit', 5),
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionTop20(): string
    {
        $query = $this->playerService->getTopPlayersOfTheSeasonQuery(20);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->render('top20', ['dataProvider' => $dataProvider]);
    }

    public function actionBestoflastgame(int $playerlimit = 10, int $gamelimit = 5)
    {
        $query = $this->playerService->getBestsOfTeLastGamesQuery($playerlimit, $gamelimit);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->render('bestoflastgame', [
            'dataProvider' => $dataProvider,
            'playerlimit' => $playerlimit,
            'gamelimit' => $gamelimit,
        ]);
    }

    public function actionPlayer(int $personId): string
    {
        $summary = $this->playerService->getPlayerSeasonSummary($personId);
        $chartData = $this->playerService->getPlayerChartData($personId);
        $query = $this->playerService->getPlayerGameLogQuery($personId);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
            'sort' => false,
        ]);

        return $this->render('player', [
            'summary' => $summary,
            'chartData' => $chartData,
            'dataProvider' => $dataProvider,
            'backUrl' => Yii::$app->request->referrer ?? ['players/all'],
        ]);
    }

    public function actionAll(string $search = ''): string
    {
        $query = $this->playerService->getAllPlayersQuery($search);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 25],
            'sort' => [
                'defaultOrder' => ['sumNbaFantasyScore' => SORT_DESC],
                'attributes' => [
                    'fullName',
                    'sumNbaFantasyScore',
                    'avgNumMinutes',
                    'sumPoints',
                    'sumReboundsTotal',
                    'sumAssist',
                    'sumSteals',
                    'sumBlocks',
                    'sumTurnovers',
                    'sumMinutes',
                ],
            ],
        ]);

        return $this->render('all', [
            'dataProvider' => $dataProvider,
            'search' => $search,
        ]);
    }

    public function actionNewhope(int $playerlimit = 20, int $gamelimit = 10): string
    {
        $query = $this->playerService->getNewHopeQuery($playerlimit, $gamelimit);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->render('newhope', [
            'dataProvider' => $dataProvider,
            'playerlimit' => $playerlimit,
            'gamelimit' => $gamelimit,
        ]);
    }
}
