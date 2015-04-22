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
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <h2 align="center">WiFi users view and add students</h2>
            </div>
            <div class="col-xs-2">
                <?php if (Yii::$app->user->isGuest): ?>
                    <h3><a class="auth" href="/main/login" data-method="post">Login</a></h3>
                <?php endif; ?>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <h3><a class="auth" href="/main/logout" data-method="post">Logout (<?= Yii::$app->user->identity->username ?>)</a></h3>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6" align="right">
                <a href="<?= Url::to('list') ?>">
                    <button id="list" class="btn btn-default">List students<br><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    </button>
                </a>
            </div>
            <div class="col-xs-6" align="left">
                <a href="<?= Url::to('add') ?>">
                    <button id="add" class="btn btn-default">Add new students<br><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </button>
                </a>
            </div>
        </div>
        <br><br>
    </header>
    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
