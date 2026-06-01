<?php

/** @var yii\web\View $this */
/** @var string|array $backUrl */
/** @var array|null $summary */
/** @var array $chartData */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bench Boss';

use yii\grid\GridView;
use yii\helpers\Html;

?>
<div class="site-index">
    <div class="body-content">

        <?php if ($summary === null): ?>
            <p class="text-muted">Player not found.</p>
        <?php else: ?>

            <div class="mb-4">
                <?= Html::a('&larr; Back', $backUrl, ['class' => 'btn btn-outline-secondary btn-sm mb-2', 'encode' => false]) ?>
                <h2><?= Html::encode($summary['fullName']) ?></h2>
                <p class="text-muted mb-3"><?= Html::encode($summary['playerteamCity'] . ' ' . $summary['playerteamName']) ?>
                    &mdash; <?= Html::encode($summary['gamesPlayed']) ?> games played</p>

            </div>

            <div class="mb-4">
                <canvas id="playerChart" height="100"></canvas>
            </div>

            <h4>Game Log</h4>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'showFooter' => false,
                'summary' => '',
                'tableOptions' => ['class' => 'table table-striped-columns table-hover table-sm'],
                'pager' => [
                    'options' => ['class' => 'list-unstyled d-flex gap-1 flex-wrap m-0 p-0 mt-2'],
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
                'columns' => [
                    [
                        'attribute' => 'gameDateTimeEst',
                        'label' => 'Date',
                        'value' => fn($m) => (new \DateTime($m->gameDateTimeEst))->format('Y-m-d'),
                    ],
                    [
                        'label' => 'Opponent',
                        'value' => fn($m) => ($m->home ? 'vs' : '@') . ' ' . $m->opponentteamCity . ' ' . $m->opponentteamName,
                    ],
                    [
                        'attribute' => 'win',
                        'label' => 'W/L',
                        'value' => fn($m) => $m->win ? 'W' : 'L',
                    ],
                    [
                        'attribute' => 'startingPosition',
                        'label' => 'Pos',
                    ],
                    [
                        'attribute' => 'numMinutes',
                        'label' => 'Min',
                        'value' => fn($m) => round($m->numMinutes),
                    ],
                    'points',
                    'reboundsTotal',
                    'assists',
                    'steals',
                    'blocks',
                    'turnovers',
                    [
                        'attribute' => 'nbaFantasyScore',
                        'label' => 'Fantasy',
                        'value' => fn($m) => round($m->nbaFantasyScore),
                    ],
                ],
            ]); ?>

        <?php endif ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (function () {
        var labels = <?= json_encode($chartData['labels']) ?>;
        var minutes = <?= json_encode($chartData['minutes']) ?>;
        var fantasy = <?= json_encode($chartData['fantasy']) ?>;

        new Chart(document.getElementById('playerChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'NBA Fantasy Score',
                        data: fantasy,
                        borderColor: '#60a5fa',
                        backgroundColor: 'rgba(96,165,250,.08)',
                        borderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        tension: .3,
                        yAxisID: 'yScore',
                    },
                    {
                        label: 'Minutes',
                        data: minutes,
                        borderColor: '#34d399',
                        backgroundColor: 'rgba(52,211,153,.08)',
                        borderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        tension: .3,
                        yAxisID: 'yMin',
                    },
                ]
            },
            options: {
                responsive: true,
                interaction: {mode: 'index', intersect: false},
                plugins: {
                    legend: {labels: {color: '#dde4f0'}}
                },
                scales: {
                    x: {
                        ticks: {color: '#7e9abf', maxTicksLimit: 12},
                        grid: {color: 'rgba(30,58,95,.5)'}
                    },
                    yScore: {
                        position: 'left',
                        ticks: {color: '#60a5fa'},
                        grid: {color: 'rgba(30,58,95,.5)'},
                        title: {display: true, text: 'Fantasy Score', color: '#60a5fa'}
                    },
                    yMin: {
                        position: 'right',
                        ticks: {color: '#34d399'},
                        grid: {drawOnChartArea: false},
                        title: {display: true, text: 'Minutes', color: '#34d399'}
                    }
                }
            }
        });
    }());
</script>

