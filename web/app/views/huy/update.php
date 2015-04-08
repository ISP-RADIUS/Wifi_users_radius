<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Huy */

$this->title = 'Update Huy: ' . ' ' . $model->column1;
$this->params['breadcrumbs'][] = ['label' => 'Huys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->column1, 'url' => ['view', 'id' => $model->column1]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="huy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
