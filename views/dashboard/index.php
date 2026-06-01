<?php

/** @var yii\web\View $this */

$this->title = 'Bench Boss';

use yii\helpers\Url;

?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Welcome!</h1>
        <p class="lead">Here's the Official NBA Fantasy Scoring used on NBA.com</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <h2>Official NBA Fantasy Scoring</h2>
                <p class="lead">Here's the Official NBA Fantasy Scoring used on NBA.com</p>

                <div class="row">
                    <div class="col-lg-12 mb-3">

                        Point = 1;
                        Rebound = 1.2;
                        Assist = 1.5;
                        Steal = 3;
                        Block = 3;
                        Turnover = -1;
                        <br>
                        <br>
                        <!--                    </div>-->
                        <!--                    <div class="col-lg-10">-->

                        Formula:<br>
                        <code>Fantasy Score = PTS + (REB * 1.2) + (AST * 1.5) + (STL * 3) + (BLK * 3) - TO</code>

                    </div>
                </div>

                <p>
                    <a class="btn btn-outline-secondary" href="<?php echo Url::toRoute(['players/top20']); ?>">
                        Top 20 of the Season &raquo;
                    </a>
                </p>
            </div>
            <div class="col-lg-3 mb-3">
                <h2>Coming soon...</h2>
                My Team<br>
                Falling (players)<br>
                Injury report<br>
                More charts - last 10 games, etc...
            </div>
            <div class="col-lg-3 mb-3">
                <h2>NBA Fantasy</h2>

                <p class="lead">Sign and drop players</p>
                <p>Sign and waive players through the season to improve your team then follow along to see your team
                    score points.</p>
                <p class="lead">Set your line-up</p>
                <p>Choose your line-up for the next gameday and watch your starting 5 score points as they take to the
                    court.</p>

                <p><a class="btn btn-outline-secondary" href="https://nbafantasy.nba.com">NBA fantasy game &raquo;</a>
                </p>
            </div>
        </div>

    </div>
</div>
