<?php

/** @var yii\web\View $this */
/** @var int $playerlimit */
/** @var int $gamelimit */

$this->title = 'Bench Boss';

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-lg- q mb-3">
                <h2>Bests of the lasts games</h2>
                <form method="get" action="<?= Url::to(['players/bestoflastgame']) ?>"
                      class="d-flex align-items-end gap-3 mb-3">
                    <div>
                        <label for="playerlimit" class="form-label">Players</label>
                        <input type="number" id="playerlimit" name="playerlimit"
                               value="<?= Html::encode($playerlimit) ?>" min="1" max="100" class="form-control"
                               style="width:80px">
                    </div>
                    <div>
                        <label for="gamelimit" class="form-label">Games</label>
                        <input type="number" id="gamelimit" name="gamelimit" value="<?= Html::encode($gamelimit) ?>"
                               min="1" max="50" class="form-control" style="width:80px">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                </form>
                <br>
                <?= /** @var ActiveDataProvider $dataProvider */
                $grid = GridView::widget([
                    'dataProvider' => $dataProvider,
                    'showFooter' => false,
                    'summary' => '',
                    'tableOptions' => ['class' => 'table table-striped-columns table-hover'],
                    'columns' => [
                        'personId',
                        [
                            'attribute' => 'fullNameLink',
                            'label' => 'Full Name',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'sumNbaFantasyScore',
                            'label' => 'Sum Nba Fantasy Score',
                        ],
                        [
                            'attribute' => 'avgNumMinutes',
                            'label' => 'Min/Game',
                        ],
                        [
                            'attribute' => 'sumPoints',
                            'label' => 'Points',
                        ],
                        [
                            'attribute' => 'sumReboundsTotal',
                            'label' => 'Rebounds',
                        ],
                        [
                            'attribute' => 'sumAssist',
                            'label' => 'Assits',
                        ],
                        [
                            'attribute' => 'sumSteals',
                            'label' => 'Steals',
                        ],
                        [
                            'attribute' => 'sumBlocks',
                            'label' => 'Blocks',
                        ],
                        [
                            'attribute' => 'sumTurnovers',
                            'label' => 'Turnovers',
                        ],
                        [
                            'attribute' => 'sumMinutes',
                            'label' => 'Minutes',
                        ]
                    ],
                ]); ?>
            </div>
        </div>

    </div>
</div>
