<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="container">
    <header>
        <h2 align="center">WiFi users view and add students</h2>

        <div class="row">
            <div class="col-xs-1 col-xs-offset-5">
                <a href="<?= Url::to('list') ?>">
                    <button class="btn btn-default"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    </button>
                </a>
            </div>
            <div class="col-xs-3">
                <a href="<?= Url::to('add') ?>">
                    <button class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </button>
                </a>
            </div>
        </div>
        <br><br>
    </header>
    <hr>
    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
