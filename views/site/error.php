<?php
use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div align="center">
        <img src="<?= Yii::getAlias('@web') . '/uploads/error.jpg' ?>">

        <div class="alert alert-danger">
            <?= Html::encode(nl2br($message)) ?>
        </div>

    </div>