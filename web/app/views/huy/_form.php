<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Huy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="huy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'column1')->textInput() ?>

    <?= $form->field($model, 'c2')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'c3')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'c4')->textInput(['maxlength' => 45]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
