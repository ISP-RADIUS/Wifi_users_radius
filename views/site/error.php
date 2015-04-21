<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div align="center">
        <img style="width: 200px; height:200px" src="<?= Yii::getAlias('@web') . '/uploads/sryface.png' ?>">
    </div>


</div>
