<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Huy */

$this->title = 'Create Huy';
$this->params['breadcrumbs'][] = ['label' => 'Huys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="huy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
