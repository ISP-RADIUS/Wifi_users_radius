<div class="site-error">

    <h1><?= $this->title ?></h1>

    <div align="center">
        <img style="width: 200px; height:200px" src="<?= Yii::getAlias('@web') . '/uploads/error.jpg' ?>">
    <div class="alert alert-danger">
        <?= nl2br($message) ?>
    </div>

</div>