<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HuySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Huys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="huy-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Huy', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'column1',
            'c2',
            'c3',
            'c4',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
