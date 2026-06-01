<?php

/** @var yii\web\View $this */
/** @var string $search */

$this->title = 'Bench Boss';

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <h2>All Players</h2>
                <form method="get" action="<?= Url::to(['players/all']) ?>" class="d-flex align-items-end gap-3 mb-3">
                    <div>
                        <label for="search" class="form-label">Search</label>
                        <input type="text" id="search" name="search" value="<?= Html::encode($search) ?>"
                               placeholder="Player name..." class="form-control" style="width:220px">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Search</button>
                        <?php if ($search !== ''): ?>
                            <a href="<?= Url::to(['players/all']) ?>" class="btn btn-outline-secondary">Clear</a>
                        <?php endif ?>
                    </div>
                </form>
                <br>
                <?= /** @var ActiveDataProvider $dataProvider */
                GridView::widget([
                    'pager' => [
                        'options' => ['class' => 'list-unstyled d-flex gap-1 flex-wrap m-0 p-0'],
                        'linkOptions' => ['class' => 'btn btn-outline-secondary btn-sm'],
                        'pageCssClass' => '',
                        'firstPageCssClass' => '',
                        'lastPageCssClass' => '',
                        'prevPageCssClass' => '',
                        'nextPageCssClass' => '',
                        'activePageCssClass' => 'active',
                        'disabledPageCssClass' => '',
                        'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'btn btn-outline-secondary btn-sm disabled'],
                    ],
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
                            'label' => 'NBA Fantasy Score',
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
                            'label' => 'Assists',
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
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
