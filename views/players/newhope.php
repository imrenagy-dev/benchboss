<?php

/** @var yii\web\View $this */
/** @var int $playerlimit */
/** @var int $gamelimit */

$this->title = 'Bench Boss';

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <h2>New Hope — Rising Players</h2>
                <form method="get" action="<?= Url::to(['players/newhope']) ?>"
                      class="d-flex align-items-end gap-3 mb-3">
                    <div>
                        <label for="playerlimit" class="form-label">Players</label>
                        <input type="number" id="playerlimit" name="playerlimit"
                               value="<?= Html::encode($playerlimit) ?>" min="1" max="200" class="form-control"
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
                <?= /** @var ArrayDataProvider $dataProvider */
                GridView::widget([
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
                            'attribute' => 'lastScore',
                            'label' => "Last {$gamelimit} Games",
                        ],
                        [
                            'attribute' => 'prevScore',
                            'label' => "Prev {$gamelimit} Games",
                        ],
                        [
                            'attribute' => 'improvement',
                            'label' => 'Improvement',
                        ],
                        [
                            'attribute' => 'avgLastMinutes',
                            'label' => 'Min/Game (last)',
                        ],
                        [
                            'attribute' => 'avgPrevMinutes',
                            'label' => 'Min/Game (prev)',
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
