<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model1, 'field1')->textInput() ?>
<?= Html::submitButton('Generate', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model2, 'field2')->textInput() ?>
<?= Html::submitButton('Generate', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

