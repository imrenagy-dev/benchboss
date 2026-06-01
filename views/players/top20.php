<?php

/** @var yii\web\View $this */

$this->title = 'Bench Boss';

use yii\data\ActiveDataProvider;
use yii\grid\GridView;

?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-lg- q mb-3">
                <h2>Top 20 of the Season</h2>
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
