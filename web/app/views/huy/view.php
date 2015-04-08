<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Huy */

$this->title = $model->column1;
$this->params['breadcrumbs'][] = ['label' => 'Huys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="huy-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->column1], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->column1], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'column1',
            'c2',
            'c3',
            'c4',
        ],
    ]) ?>

</div>
